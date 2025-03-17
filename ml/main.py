from fastapi import FastAPI, File, UploadFile, HTTPException, Depends
from fastapi.responses import JSONResponse
from fastapi.middleware.cors import CORSMiddleware
from fastapi.encoders import jsonable_encoder
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from pathlib import Path
import uvicorn
from PIL import Image
import numpy as np
import tensorflow as tf
from motor.motor_asyncio import AsyncIOMotorClient
from pydantic import BaseModel, Field, EmailStr
from typing import Optional
from bson import ObjectId
import bcrypt
import logging
import os
import shutil
from face_identification import FaceRecognition
import io
import cv2
import tempfile
import traceback


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
MODEL_PATH = 'hand_sign_numbers.h5'
MODEL_SIGN = 'model_ssl_v5.h5'

# Load model with handling for potential custom objects
def load_model_with_custom_objects(model_path, custom_objects=None):
    model = tf.keras.models.load_model(model_path, custom_objects=custom_objects)
    return model

# Function to preprocess the uploaded image and make predictions
def predict_hand_sign(model, image_path):
    # Open the image and preprocess it
    img = Image.open(image_path)
    img = img.resize((48, 48))  # Resize the image to match the model input size (48x48)
    img = np.array(img)  # Convert image to numpy array
    img = img / 255.0  # Normalize pixel values to be between 0 and 1
    
    # Make prediction
    prediction = model.predict(np.expand_dims(img, axis=0))  # Add batch dimension
    predicted_class_index = np.argmax(prediction)  # Get the index of the highest probability
    
    class_names = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']  # Class labels for hand signs (digits 0-9)
    predicted_class = class_names[predicted_class_index]
    
    return predicted_class

@app.post("/predict-handsign")
async def upload_image(file: UploadFile = File(...)):
    try:
        # Save the uploaded file
        file_path = os.path.join(UPLOADS_DIR, file.filename)
        os.makedirs(UPLOADS_DIR, exist_ok=True)  # Ensure the upload directory exists
        with open(file_path, "wb") as buffer:
            buffer.write(await file.read())
        
        # Load the model
        model = load_model_with_custom_objects(MODEL_PATH, custom_objects=None)

        # Make prediction
        predicted_class = predict_hand_sign(model, file_path)
        
        return {"predicted_class": predicted_class}
    
    except Exception as e:
        return JSONResponse(content={"error": str(e)}, status_code=500)

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


# Child Faces Identification =====================================================================================================
class FaceID(BaseModel):
    username: str

@app.post("/face-identification/upload")
async def upload_face(file: UploadFile = File(...)):
    file_location = os.path.join(FACES_DIR, file.filename)
    with open(file_location, "wb+") as file_object:
        shutil.copyfileobj(file.file, file_object)
    return {"info": "File uploaded successfully"}

@app.post("/face-identification/recognize")
async def recognize_face(user: FaceID):
    name = user.username
    face_rec = FaceRecognition()
    detected = face_rec.run_recognition(name)  
    print(detected)
    return {"detected": detected}

class UserModel(BaseModel):
    username: str
    email: EmailStr
    password: str
    role: str
    avatar: str

class UserResponseModel(BaseModel):
    id: str
    username: str
    email: EmailStr
    role: str
    avatar: str

async def get_user_by_email(email: str):
    return await user_collection.find_one({"email": email})

async def get_user_by_id(user_id: ObjectId):
    return await user_collection.find_one({"_id": user_id})


async def get_user_by_username(username: str):
    return await user_collection.find_one({"username": username})

@app.post("/users", response_model=UserResponseModel)
async def create_user(user: UserModel):
    # Check if user already exists
    user_exists = await get_user_by_email(user.email)
    if user_exists:
        raise HTTPException(status_code=400, detail="User already exists")
    
    # Hash the user's password
    hashed_password = bcrypt.hashpw(user.password.encode('utf-8'), bcrypt.gensalt())
    user.password = hashed_password.decode('utf-8')
    
    # Insert the user into the database
    user_dict = jsonable_encoder(user)
    result = await user_collection.insert_one(user_dict)
    
    # Retrieve the inserted user
    new_user = await get_user_by_id(result.inserted_id)
    
    # Map _id to id for the response model
    new_user_response = {
        "id": str(new_user["_id"]),  # Convert ObjectId to string and map to id
        "username": new_user["username"],
        "email": new_user["email"],
        "role": new_user["role"],
        "avatar": new_user["avatar"]
    }
    
    return UserResponseModel(**new_user_response)


@app.get("/users/{username}", response_model=UserResponseModel)
async def get_user(username: str):
    user = await get_user_by_username(username)
    if not user:
        raise HTTPException(status_code=404, detail="User not found")

    return UserResponseModel(
        id=str(user["_id"]),
        username=user["username"],
        email=user["email"],
        role=user["role"],
        avatar=user["avatar"]
    )

@app.get("/users", response_model=list[UserResponseModel])
async def get_all_users():
    users_cursor = user_collection.find({})
    users = await users_cursor.to_list(None)  # Fetch all users

    return [
        UserResponseModel(
            id=str(user["_id"]),
            username=user["username"],
            email=user["email"],
            role=user["role"],
            avatar=user["avatar"]
        ) for user in users
    ]

# Sign Language Classification
class_names = ['අ', 'අං', 'ආ', 'ඇ', 'ඈ', 'ඉ', 'ඊ', 'උ', 'ඌ', 'එ-', 'ඒ', 'ඔ', 'ඕ', 'ක=ක්+අ', 
               'ග=ග්+අ', 'ඟ', 'ච=ච්+අ', 'ජ=ජ්+අ', 'ට', 'ට=ට්+අ', 'ඩ=ඩ්+අ', 'ණ=ණ්+අ', 'ඬ', 
               'ත=ත්+අ', 'ද=ද්+අ', 'න=න්+අ-', 'ඳ', 'ප=ප්+අ-p', 'බ=බ්+අ', 'ම=ම්+අ', 'ඹ', 
               'ය= ය්+අ', 'ර = ර්+අ', 'ල = ල් + අ', 'ව=ව්+අ', 'ස=ස්+අ', 'හ=හ්+අ', 'ළ=ළ්+ අ']


def predict_image(image_array):
    predictions = np.random.rand(len(class_names))
    predicted_class_index = np.argmax(predictions)
    return predicted_class_index, predictions

@app.post("/predict-sinhala-sign-letter")
async def predict(file: UploadFile = File(...)):
    try:
        # Read the uploaded file and process it
        contents = await file.read()
        image = Image.open(io.BytesIO(contents)).convert("RGB")
        image = image.resize((48, 48))  # Resize to match the model's input size
        image_array = np.array(image) / 255.0  # Normalize the image
        
        # Predict the class
        predicted_class_index, probabilities = predict_image(image_array)
        predicted_class = class_names[predicted_class_index]
        
        return JSONResponse(content={
            "predicted_class": predicted_class,
            "probabilities": probabilities.tolist()
        })
    except Exception as e:
        return JSONResponse(content={"error": str(e)}, status_code=500)

# 2nd Model



# My Color Model
model = tf.keras.models.load_model('color_classification_model.keras')  

# Colours labels
color_labels = {
    0: 'pink', 1: 'orange', 2: 'black', 3: 'blue', 4: 'green',
    5: 'purple', 6: 'red', 7: 'yellow', 8: 'white', 9: 'brown',
    10: 'gray', 11: 'beige', 12: 'cyan'
}

@app.post("/predict-colors")
async def predict_colors(video: UploadFile = File(...)):
    with tempfile.NamedTemporaryFile(delete=False, suffix=".mp4") as temp_video:
        temp_video.write(await video.read())
        temp_video_path = temp_video.name

    cap = None  # Declare cap here to ensure proper cleanup
    try:
        # Open the video file
        cap = cv2.VideoCapture(temp_video_path)
        if not cap.isOpened():
            return JSONResponse({"error": "Could not process video file"}, status_code=400)

        predictions = []
        frame_count = 0

        while True:
            ret, frame = cap.read()
            if not ret:
                break  # End of video
            
            # Process every nth frame to save time
            frame_count += 1
            if frame_count % 30 != 0:  # Process every 30th frame
                continue

            # Preprocess the frame (resize, normalize, etc.)
            resized_frame = cv2.resize(frame, (126, 126))  # Adjust based on your model input size
            normalized_frame = resized_frame / 255.0
            input_frame = np.expand_dims(normalized_frame, axis=0)

            # Perform prediction using the model
            prediction = model.predict(input_frame)
            predicted_class = np.argmax(prediction, axis=1)[0]

            # Map to color label
            predictions.append(color_labels.get(predicted_class, "unknown"))

        return {"predicted_colors": predictions}

    except Exception as e:
        # Log traceback and return error
        error_trace = traceback.format_exc()
        print(f"Error: {e}\nTraceback:\n{error_trace}")
        return JSONResponse({"error": "An error occurred while processing the video", "details": str(e)}, status_code=500)

    finally:
        # Release resources and clean up
        if cap:
            cap.release()
        if os.path.exists(temp_video_path):
            os.remove(temp_video_path)


# @app.post("/token")
# async def login(form_data: UserLoginModel):
#     user = await get_user_by_email(form_data.email)
#     if not user or not bcrypt.checkpw(form_data.password.encode('utf-8'), user['password'].encode('utf-8')):
#         raise HTTPException(status_code=400, detail="Incorrect email or password")
    
#     user['_id'] = str(user['_id'])
#     response_data = {"access_token": user['_id'], "token_type": "bearer", "user": user}
#     logger.debug(f"User logged in: {response_data}")
#     return response_data

# @app.get("/users/{user_id}", response_model=UserResponseModel)
# async def get_user(user_id: str):
#     user = await get_user_by_id(user_id)
#     if not user:
#         raise HTTPException(status_code=404, detail="User not found")
#     return user

# @app.get("/users/email/{email}", response_model=UserResponseModel)
# async def get_user_by_email_endpoint(email: str):
#     user = await get_user_by_email(email)
#     if not user:
#         raise HTTPException(status_code=404, detail="User not found")
#     return user  

# Lip Reading Model ==============================================================================================================
# model = tf.keras.models.load_model('lip_models/checkpoint')

# # Utility function to convert numbers to characters
# def num_to_char(num):
#     # Replace with your character mapping logic
#     char_map = {
#         0: '',
#         1: 'a',
#         2: 'b',
#         3: 'c',
#         4: 'd',
#         5: 'e',
#         6: 'f',
#         7: 'g',
#         8: 'h',
#         9: 'i',
#         10: 'j',
#         11: 'k',
#         12: 'l',
#         13: 'm',
#         14: 'n',
#         15: 'o',
#         16: 'p',
#         17: 'q',
#         18: 'r',
#         19: 's',
#         20: 't',
#         21: 'u',
#         22: 'v',
#         23: 'w',
#         24: 'x',
#         25: 'y',
#         26: 'z',
#         27: "'",
#         28: '?',
#         29: '!',
#         30: '1',
#         31: '2',
#         32: '3',
#         33: '4',
#         34: '5',
#         35: '6',
#         36: '7',
#         37: '8',
#         38: '9',
#         39: ' '
#     }
#     return char_map.get(num, '')

# # Function to process video file and extract features
# def load_data(video_path):
#     # Replace with your video processing logic
#     # The function should return the input features and corresponding labels
#     features = np.random.rand(75, 100)  # Example placeholder
#     labels = [0, 1, 2, 3, 4]  # Example placeholder
#     return features, labels

# @app.post("/upload-video/")
# async def upload_video(file: UploadFile = File(...)):
#     # Save the uploaded file temporarily
#     try:
#         file_location = f"temp/{file.filename}"
#         with open(file_location, "wb") as f:
#             f.write(await file.read())

#         # Load and process the video
#         sample = load_data(file_location)
#         real_text = [tf.strings.reduce_join([num_to_char(word) for word in sentence]) for sentence in [sample[1]]]

#         # Make predictions using the model
#         yhat = model.predict(tf.expand_dims(sample[0], axis=0))
#         decoded = tf.keras.backend.ctc_decode(yhat, input_length=[75], greedy=True)[0][0].numpy()
#         predictions = [tf.strings.reduce_join([num_to_char(word) for word in sentence]) for sentence in decoded]

#         # Clean up the temporary file
#         os.remove(file_location)

#         # Return the real text and predictions as JSON
#         return JSONResponse(content={
#             "real_text": [text.numpy().decode('utf-8') for text in real_text],
#             "predictions": [text.numpy().decode('utf-8') for text in predictions]
#         })
#     except Exception as e:
#         # Handle errors gracefully
#         raise HTTPException(status_code=500, detail=str(e))



if __name__ == "__main__":
    uvicorn.run(app, host="localhost", port=8000)
