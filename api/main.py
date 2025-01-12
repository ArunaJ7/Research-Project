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

Path(UPLOADS_DIR).mkdir(parents=True, exist_ok=True)

# Setting up logging
logging.basicConfig(level=logging.DEBUG)
logger = logging.getLogger(__name__)

# DB Configurations
MONGODB_CONNECTION_URL = "mongodb+srv://dbuser:111222333@cluster0.frzat.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0"
client = AsyncIOMotorClient(MONGODB_CONNECTION_URL)
db = client["elearning_db"]
user_collection = db["users"]

MODEL_PATH = 'hand_sign_numbers.h5'

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
    prediction = model.predict(np.expand_dims(img, axis=0))  
    predicted_class_index = np.argmax(prediction)  
    
    class_names = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']  
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