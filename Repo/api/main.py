# main.py
from fastapi import FastAPI, HTTPException, File, UploadFile
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import JSONResponse
from pydantic import BaseModel
import bcrypt
import os
import shutil
from firestore_db import get_firestore_client
import joblib
from tensorflow.keras.models import load_model
import numpy as np
from PIL import Image
import pandas as pd
import traceback
from geopy.distance import geodesic
import requests

app = FastAPI()
origins = [
    "http://localhost:3000",
    "http://localhost:3001"
]
app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

UPLOAD_DIR = "uploads"
os.makedirs(UPLOAD_DIR, exist_ok=True)

# Db connection
db = get_firestore_client()

# Google Maps Configs
GOOGLE_API_KEY = 'AIzaSyDAsJYZSQ92_NQAz9kiSpW1XpyuCxRl_uI'
GOOGLE_PLACES_URL = "https://maps.googleapis.com/maps/api/place/nearbysearch/json"


# Load MOdels Health
MODEL_HEALTH = joblib.load('model_health_random_f_classifier.joblib')
LABEL_ENCODER =  joblib.load('label_encoder_health_status.joblib')

# Load Milk Quality Checker
try:
    MODEL_ML_QUALITY = joblib.load("milk_model_dt.joblib")  
    MODEL_ML_FORECAST = joblib.load("arima_milk_production_model.joblib")
except FileNotFoundError:
    raise Exception("Model file not found. Ensure the decision_tree_model.joblib file is in the same directory.")


# Load Pest detection Models
# Load Pest detection Models
MODEL_PESTS = load_model("model_pests_detect.h5")
CLASS_PESTS = ['Mastitis', ' Tick Infestation', 'Dermatophytosis (RINGWORM)', 'Fly Strike (MYIASIS)', 'Foot and Mouth disease', 'Lumpy Skin', 'Black Quarter (BQ)', 'Parasitic Mange']



class User(BaseModel):
    username: str
    full_name: str
    email:str
    contact: str
    password: str
    nic: str

class LoginUser(BaseModel):
    username: str
    password: str

class FaceID(BaseModel):
    username: str

users_db = {}

@app.post("/register")
async def register_user(user: User):
    user_ref = db.collection("users").document(user.username)
    if user_ref.get().exists:
        raise HTTPException(status_code=400, detail="Username already registered")

    # Hash the password before storing it
    hashed_password = bcrypt.hashpw(user.password.encode('utf-8'), bcrypt.gensalt())
    user_data = user.dict()
    user_data["password"] = hashed_password.decode('utf-8')

    user_ref.set(user_data)
    return {"message": "User registered successfully", "user": user_data}

@app.post("/login")
async def login_user(user: LoginUser):
    user_ref = db.collection("users").document(user.username)
    user_doc = user_ref.get()

    if not user_doc.exists:
        raise HTTPException(status_code=400, detail="Invalid username or password")

    user_data = user_doc.to_dict()
    
    # Check the hashed password
    if not bcrypt.checkpw(user.password.encode('utf-8'), user_data["password"].encode('utf-8')):
        raise HTTPException(status_code=400, detail="Invalid username or password")

    user_data.pop("password")  # Remove the password field from the response

    return {"message": "Login successful", "user": user_data}

# Predict Pests and Diseases
@app.post("/predict-pest")
async def predict_pest(file: UploadFile = File(...)):
    """
    Endpoint to classify an uploaded image for pest attack detection.
    """
    # Save the uploaded file temporarily
    file_path = os.path.join(UPLOAD_DIR, file.filename)
    with open(file_path, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)
    
    try:
        # Preprocess the image
        image = Image.open(file_path).convert("RGB")  # Ensure RGB format
        image = image.resize((48, 48))  # Resize to model's input size
        image_array = np.array(image) / 255.0  # Normalize to [0, 1]
        image_array = np.expand_dims(image_array, axis=0)  # Add batch dimension

        # Predict the pest attack label
        predictions = MODEL_PESTS.predict(image_array)
        predicted_index = np.argmax(predictions, axis=1)[0]
        confidence = float(np.max(predictions))  # Highest probability

        # Map the predicted index to the pest attack label
        predicted_label = CLASS_PESTS[predicted_index]

        # Clean up the uploaded file
        os.remove(file_path)

        return {
            "predicted_label": predicted_label,
            "confidence": confidence
        }
    except Exception as e:
        os.remove(file_path)  # Clean up the uploaded file in case of error
        raise HTTPException(status_code=500, detail=f"Prediction failed: {e}")

# Predict Cow Health
class HealthStatusInput(BaseModel):
    body_temperature: float
    milk_production: float
    respiratory_rate: int
    walking_capacity: int
    sleeping_duration: float
    body_condition_score: int
    heart_rate: int
    eating_duration: float
    lying_down_duration: float
    ruminating: float
    rumen_fill: int

@app.post("/predict-health-status")
async def predict_health_status(input_data: HealthStatusInput):
    """
    Predict the health status of cattle based on input parameters.

    Request Body:
        - body_temperature (float)
        - milk_production (float)
        - respiratory_rate (int)
        - walking_capacity (int)
        - sleeping_duration (float)
        - body_condition_score (int)
        - heart_rate (int)
        - eating_duration (float)
        - lying_down_duration (float)
        - ruminating (float)
        - rumen_fill (int)

    Returns:
        - health_status: "Healthy" or "Unhealthy"
    """
    try:
        # Convert input to DataFrame
        input_df = pd.DataFrame([input_data.dict()])

        # Predict using the loaded model
        predicted_class = MODEL_HEALTH.predict(input_df)[0]

        # Decode the predicted class
        health_status = LABEL_ENCODER.inverse_transform([predicted_class])[0]

        return {"health_status": health_status}

    except Exception as e:
        raise HTTPException(status_code=500, detail=f"An error occurred during prediction: {str(e)}")
    


# Milk Quality Monitor
class MilkQualityInput(BaseModel):
    pH: float
    Temperature: float
    Taste: int
    Odor: int
    Fat: float
    Turbidity: int
    Colour: int

# Define grade mapping
grade_mapping = {0: "high", 1: "low", 2: "medium"}

@app.post("/predict-milk-grade")
async def predict_milk_grade(input_data: MilkQualityInput):
    """
    Predict the milk grade based on quality parameters.

    Input:
        - pH: float
        - Temperature: float
        - Taste: int (categorical, e.g., 0 for normal, 1 for abnormal)
        - Odor: int (categorical, e.g., 0 for normal, 1 for abnormal)
        - Fat: float
        - Turbidity: int (categorical, e.g., 0 for clear, 1 for turbid)
        - Colour: int (categorical, e.g., 0 for white, 1 for other colors)

    Returns:
        - Predicted Grade: "high", "medium", or "low"
    """
    try:
        # Prepare the input for prediction
        input_array = np.array([
            [
                input_data.pH,
                input_data.Temperature,
                input_data.Taste,
                input_data.Odor,
                input_data.Fat,
                input_data.Turbidity,
                input_data.Colour,
            ]
        ])

        # Perform the prediction
        predicted_grade = MODEL_ML_QUALITY.predict(input_array)

        # Map the predicted grade to a category
        predicted_grade_category = grade_mapping.get(predicted_grade[0])

        if predicted_grade_category is None:
            raise ValueError("Invalid prediction received from the model.")

        return {"predicted_grade": predicted_grade_category}

    except Exception as e:
        raise HTTPException(status_code=500, detail=f"An error occurred: {str(e)}")


# Milk Production Forecast
class MilkProductionRequest(BaseModel):
    year: int
    month: int

@app.post("/predict-milk-production")
async def predict_milk_production(request: MilkProductionRequest):
    """
    Predicts milk production for a given year and month.

    Input:
    - year: int, the year for which to predict milk production.
    - month: int, the month for which to predict milk production.

    Returns:
    - predicted_value: float, predicted milk production value for the given month.
    """
    try:
        # Extract year and month from the request
        year = request.year
        month = request.month

        # Validate month input
        if month < 1 or month > 12:
            raise HTTPException(status_code=400, detail="Invalid month. Must be between 1 and 12.")

        # Convert input year and month into a datetime object
        prediction_date = pd.Timestamp(year=year, month=month, day=1)

        # Get the last available date in the model data (assumed to be the last training date)
        last_date = MODEL_ML_FORECAST.data.dates[-1]

        # Calculate the number of months between the last training date and the requested prediction date
        months_ahead = (prediction_date.year - last_date.year) * 12 + (prediction_date.month - last_date.month)

        if months_ahead < 0:
            raise HTTPException(
                status_code=400,
                detail="The requested date is within the training data range. Please provide a future date for prediction."
            )

        # Forecast the milk production for the given number of months ahead
        forecast = MODEL_ML_FORECAST.forecast(steps=months_ahead)
        print(year)
        print(month)

        # Return the predicted value for the requested month
        predicted_value = forecast[-1]
        print(forecast)
        return {"predicted_milk_production": predicted_value}

    except Exception as e:
        raise HTTPException(status_code=500, detail=f"An error occurred: {str(e)}")
    

# Locate Vets   
class Location(BaseModel):
    latitude: float
    longitude: float

def get_nearby_locations(latitude: float, longitude: float, radius: int = 5000):
    location = f"{latitude},{longitude}"
    params = {
        "location": location,
        "radius": radius,
        "type": "veterinary_care",  # You can change this to other types such as 'hospital', etc.
        "key": GOOGLE_API_KEY
    }
    response = requests.get(GOOGLE_PLACES_URL, params=params)
    
    if response.status_code == 200:
        data = response.json()
        locations = []
        for result in data.get('results', []):
            locations.append({
                'name': result['name'],
                'address': result['vicinity'],
                'location': result['geometry']['location']
            })
        return locations
    else:
        return {"error": "Failed to retrieve data from Google Places API"}

@app.post("/nearby_locations")
async def nearby_locations(location: Location):
    locations = get_nearby_locations(location.latitude, location.longitude)
    return {"locations": locations}