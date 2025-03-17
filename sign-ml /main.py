from fastapi import FastAPI, File, UploadFile
from fastapi.middleware.cors import CORSMiddleware
from keras.models import load_model
from PIL import Image, ImageOps
import numpy as np
import io
from pathlib import Path
import os

app = FastAPI()

# Enable CORS for localhost:3000
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost:3000"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

UPLOADS_DIR = "./uploads"

Path(UPLOADS_DIR).mkdir(parents=True, exist_ok=True)

# Load the Keras model
model = load_model("keras_model.h5", compile=False)

# Load class labels
with open("labels.txt", "r", encoding="utf-8") as f:
    class_names = [line.strip() for line in f.readlines()]

# Image processing function
def preprocess_image(image: Image.Image) -> np.ndarray:
    size = (224, 224)
    image = ImageOps.fit(image, size, Image.Resampling.LANCZOS)
    image_array = np.asarray(image, dtype=np.float32)
    normalized_image_array = (image_array / 127.5) - 1  # Normalize
    return np.expand_dims(normalized_image_array, axis=0)  # Add batch dimension

@app.post("/predict-emotion")
async def predict(file: UploadFile = File(...)):
    try:
        # Read image file
        image = Image.open(io.BytesIO(await file.read())).convert("RGB")
        # Preprocess image
        data = preprocess_image(image)
        # Predict using model
        prediction = model.predict(data)
        index = np.argmax(prediction)
        class_name = class_names[index]
        confidence_score = float(prediction[0][index])
        return {"class": class_name, "confidence": confidence_score}
    except Exception as e:
        return {"error": str(e)}

@app.post("/predict-handsign-batch")
async def upload_images(files: list[UploadFile] = File(...)):
    try:
        predictions = []
        
        for file in files:
            image = Image.open(io.BytesIO(await file.read())).convert("RGB")
            # Preprocess image
            data = preprocess_image(image)
            # Predict using model
            prediction = model.predict(data)
            index = np.argmax(prediction)
            class_name = class_names[index]  # This should now properly map to Sinhala characters
            predictions.append(class_name)
        
        # result = "".join(predictions)  # Concatenate properly encoded Sinhala characters
        print(predictions)
        return {"predicted_classes": predictions}
    except Exception as e:
        print(f"Error: {e}\nTraceback:\n")
        return {"error": str(e)}