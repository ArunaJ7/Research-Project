from fastapi import FastAPI, File, UploadFile, HTTPException, Depends
from fastapi.responses import JSONResponse
from fastapi.middleware.cors import CORSMiddleware
from fastapi.encoders import jsonable_encoder
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from pathlib import Path
import uvicorn
from PIL import Image
from motor.motor_asyncio import AsyncIOMotorClient
from pydantic import BaseModel, Field, EmailStr
import logging
import numpy as np
import traceback
import os


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

UPLOADS_DIR = "./uploads"
FACES_DIR = "./faces"

Path(UPLOADS_DIR).mkdir(parents=True, exist_ok=True)


# Setting up logging
logging.basicConfig(level=logging.DEBUG)
logger = logging.getLogger(__name__)

# DB Configurations
MONGODB_CONNECTION_URL = "mongodb+srv://dbuser:111222333@cluster0.frzat.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0"
client = AsyncIOMotorClient(MONGODB_CONNECTION_URL)
db = client["elearning_db"]
user_collection = db["users"]

# Hand Sign Detect ===============================================================================================================
MODEL_SIGN = 'model_ssl_v5.h5'

# Load model with handling for potential custom objects
def load_model_with_custom_objects(model_path, custom_objects=None):
    model = tf.keras.models.load_model(model_path, custom_objects=custom_objects)
    return model

# Sign Alpabet Sinhala
def predict_hand_sign_alpabet(model, image_path):
    # Open the image and convert it to RGB
    img = Image.open(image_path).convert("RGB")  # Convert image to RGB to remove the alpha channel
    img = img.resize((48, 48))  # Resize to match model input size
    img = np.array(img)  # Convert image to numpy array
    img = img / 255.0  # Normalize pixel values to be between 0 and 1

    # Ensure the input has the correct shape for the model
    img = np.expand_dims(img, axis=0)  # Add batch dimension

    # Make prediction
    prediction = model.predict(img)  
    predicted_class_index = np.argmax(prediction)  # Get the index of the highest probability
    
    class_names = ['අ', 'අං', 'ආ', 'ඇ', 'ඈ', 'ඉ', 'ඊ', 'උ', 'ඌ', 'එ', 'ඒ', 'ඔ', 'ඕ', 'ක්', 'ග්', 'ඟ', 'ච්', 'ජ්', 'ට්', 'ඩ්', 'ණ්', 'ඬ', 'ත්', 'ද්', 'න්', 'ඳ', 'ප', 'ප්', 'බ්', 'ම්', 'ඹ', 'ය්', 'ර්', 'ල්', 'ව්', 'ස්', 'හ්', 'ළ්']
    predicted_class = class_names[predicted_class_index]
    
    return predicted_class


@app.post("/predict-handsigns-alpabet")
async def upload_images(files: list[UploadFile] = File(...)):
    try:
        # Load the model
        model = load_model_with_custom_objects(MODEL_SIGN, custom_objects=None)

        predictions = []
        for file in files:
            # Save the uploaded file
            file_path = os.path.join(UPLOADS_DIR, file.filename)
            os.makedirs(UPLOADS_DIR, exist_ok=True)  # Ensure the upload directory exists
            with open(file_path, "wb") as buffer:
                buffer.write(await file.read())
            
            # Make prediction for the image
            predicted_class = predict_hand_sign_alpabet(model, file_path)
            predictions.append(predicted_class)  # Add the prediction to the list

        # Concatenate all predictions into a single string
        result = ''.join(predictions)

        return {"predicted_classes": result}
    
    except Exception as e:
        error_trace = traceback.format_exc()
        print(f"Error: {e}\nTraceback:\n{error_trace}")
        return JSONResponse(content={"error": str(e)}, status_code=500)
