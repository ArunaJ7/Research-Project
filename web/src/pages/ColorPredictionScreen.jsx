import React, { useState } from 'react';
import axios from 'axios';
import Notiflix from 'notiflix';
import './form.css';
import Footer from '../components/footer/Footer';

const ColorPredictionScreen = () => {
  const [videoFile, setVideoFile] = useState(null);
  const [predictions, setPredictions] = useState([]);

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file && file.type.includes('video')) {
      setVideoFile(file);
    } else {
      Notiflix.Report.failure('Invalid File', 'Please select a valid video file.', 'Okay');
    }
  };

  const handlePredictionRequest = async () => {
    if (!videoFile) {
      Notiflix.Report.failure('Upload Failed', 'Please upload a video file.', 'Okay');
      return;
    }

    const formData = new FormData();
    formData.append('video', videoFile);

    try {
      const response = await axios.post('http://localhost:8000/predict-colors', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      const { predicted_colors } = response.data;
      if (predicted_colors) {
        setPredictions(predicted_colors);
        Notiflix.Report.success('Success', 'Predictions received successfully!', 'Okay');
      } else {
        Notiflix.Report.failure('Failed', 'No predictions were returned. Try again.', 'Okay');
      }
    } catch (error) {
      console.error('Error during prediction:', error);
      Notiflix.Report.failure(
        'Prediction Failed',
        error.response?.data?.detail || 'An error occurred. Please try again.',
        'Okay'
      );
    }
  };

  return (
    <>
      <div className="form-body">
        <div className="max-w-md mx-auto mt-8 p-6 rounded-md shadow-md container form-container">
          <div className="image-container text-center">
            <img
              src={process.env.PUBLIC_URL + '/images/logo-em.png'}
              height={60}
              alt="background"
            />
            <span className="custom-title">Color Predictor</span>
          </div>
          <h1 className="text-3xl font-semibold mb-6">Color Prediction Form</h1>
          <form>
            <div className="mb-6">
              <label
                htmlFor="video"
                className="block text-sm font-medium text-gray-700"
              >
                Upload Video for Color Prediction
              </label>
              <div className="mt-1">
                <input
                  type="file"
                  id="video"
                  name="video"
                  accept="video/*"
                  className="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                  onChange={handleFileChange}
                />
              </div>
            </div>
            <div className="text-center">
              <button
                type="button"
                onClick={handlePredictionRequest}
                className="custom-button"
              >
                Start Prediction
              </button>
            </div>
          </form>
          <div className="mt-6">
            <h2 className="text-xl font-semibold">Predicted Colors:</h2>
            <ul>
              {predictions.map((color, index) => (
                <li key={index}>{color}</li>
              ))}
            </ul>
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default ColorPredictionScreen;
