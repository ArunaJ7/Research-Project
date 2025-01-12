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