import React, { useState } from 'react';
import axios from 'axios';
import Notiflix from 'notiflix';
import './form.css';
import Footer from '../components/footer/Footer';

const IdentifySignScreen = () => {
  const [file, setFile] = useState(null);
  const [prediction, setPrediction] = useState(null);

  const handleFileChange = (event) => {
    setFile(event.target.files[0]);
  };

  const handleSignIdentification = async () => {
    if (!file) {
      Notiflix.Report.failure(
        'Identification Failed',
        'Please upload an image of a sign.',
        'Okay'
      );
      return;
    }

    const formData = new FormData();
    formData.append('file', file);

    try {
      const response = await axios.post('http://localhost:8000/predict-sinhala-sign-letter', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      const { predicted_class, probabilities } = response.data;

      setPrediction({
        predicted_class,
        probabilities,
      });

      Notiflix.Report.success(
        'Success',
        `Sign identified as: ${predicted_class}`,
        'Okay'
      );
    } catch (error) {
      console.error('Error during sign identification:', error);
      Notiflix.Report.failure(
        'Identification Failed',
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
            <span className="custom-title">E-Learning</span>
          </div>
          <br />
          <br />
          <h1 className="text-3xl font-semibold mb-6">Identify Sinhala Sign</h1>
          <form>
            <div className="mb-6">
              <label
                htmlFor="sign-image"
                className="block text-sm font-medium text-gray-700"
              >
                Upload Image of Sinhala Sign
              </label>
              <br />
              <br />
              <div className="mt-1">
                <input
                  type="file"
                  id="sign-image"
                  name="sign-image"
                  accept="image/*"
                  className="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                  onChange={handleFileChange}
                />
              </div>
            </div>

            <div className="text-center">
              <button
                type="button"
                onClick={handleSignIdentification}
                className="custom-button"
              >
                Identify Sign
              </button>
            </div>
          </form>
          {prediction && (
            <div className="mt-6">
              <h3 className="text-lg font-semibold">Prediction Result:</h3>
              <p>
                <strong>Sign:</strong> {prediction.predicted_class}
              </p>
              {/* <p>
                <strong>Probabilities:</strong> {prediction.probabilities.join(', ')}
              </p> */}
            </div>
          )}
        </div>
      </div>
      <Footer />
    </>
  );
};

export default IdentifySignScreen;
