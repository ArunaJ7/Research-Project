import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import Notiflix from 'notiflix';
import './form.css';
import Footer from '../components/footer/Footer';
import env from '../data/env';

const IdentificationScreen = () => {
  const [username, setUsername] = useState('');
  const navigate = useNavigate();

  const handleFaceIdentification = async () => {
    if (!username) {
      Notiflix.Report.failure(
        'Identification Failed',
        'Username is required',
        'Okay'
      );
      return;
    }

    try {
      const response = await axios.post(env.ML_URL+'/face-identification/recognize', {
        username,
      });

      const { detected } = response.data;

      console.log(detected)

      if (detected) {
        try {
          const userResponse = await axios.get(`${env.ML_URL}/users/${username}`);
          const userData = userResponse.data;
  
          // Step 3: Store user data in localStorage
          localStorage.setItem('user', JSON.stringify(userData));
  
          Notiflix.Report.success(
            'Success',
            'Face Identification Successful',
            'Okay',
            () => navigate('/emotion-suggetion')
          );
        } catch (userError) {
          console.error('Error fetching user details:', userError);
          Notiflix.Report.failure('User Fetch Failed', 'Could not retrieve user details.', 'Okay');
        }


      } else {
        Notiflix.Report.failure(
          'Identification Failed',
          'Face not detected. Please try again.',
          'Okay'
        );
      }
    } catch (error) {
      console.error('Error during face identification:', error);
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
          <h1 className="text-3xl font-semibold mb-6">Face Identification</h1>
          <form>
            <div className="mb-6">
              <label
                htmlFor="username"
                className="block text-sm font-medium text-gray-700"
              >
                Enter Your Username
              </label>
              <br />
              <br />
              <div className="mt-1">
                <input
                  type="text"
                  id="username"
                  name="username"
                  className="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                  placeholder="Enter your username"
                  onChange={(e) => setUsername(e.target.value)}
                />
              </div>
            </div>

            <div className="text-center">
              <button
                type="button"
                onClick={handleFaceIdentification}
                className="custom-button"
              >
                Face Identification
              </button>
            </div>
          </form>
          <p className="mt-4 text-center text-gray-600">
                  Don't have an account?{' '}
                  <Link to="/sign-up" className="custom-link">
                    Sign Up
                  </Link>
          </p>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default IdentificationScreen;
