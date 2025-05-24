import React, { useState, useRef } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Notiflix from 'notiflix';
import EventEmitter from '../utils/EventEmitter';
import Footer from '../components/footer/Footer';
import axios from 'axios';
import Webcam from 'react-webcam';

const Signup = () => {
  const navigate = useNavigate();
  const [username, setUsername] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [avatar, setAvatar] = useState(null);
  const [avatarPreview, setAvatarPreview] = useState(null);
  const [showUploadOptions, setShowUploadOptions] = useState(false);
  const [showWebcam, setShowWebcam] = useState(false);
  const webcamRef = useRef(null);
  const fileInputRef = useRef(null);

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setAvatar(file);
      const reader = new FileReader();
      reader.onloadend = () => {
        setAvatarPreview(reader.result);
      };
      reader.readAsDataURL(file);
    }
    setShowUploadOptions(false);
  };

  const capturePhoto = () => {
    const imageSrc = webcamRef.current.getScreenshot();
    if (imageSrc) {
      fetch(imageSrc)
        .then(res => res.blob())
        .then(blob => {
          const file = new File([blob], 'webcam-photo.jpg', { type: 'image/jpeg' });
          setAvatar(file);
          setAvatarPreview(imageSrc);
          setShowWebcam(false);
          setShowUploadOptions(false);
        });
    }
  };

  const handleSignUp = async () => {
    if (!username || !email || !password || !confirmPassword) {
      Notiflix.Report.failure(
        'Registration Failed',
        'All fields are required',
        'Okay'
      );
      return;
    }

    if (password !== confirmPassword) {
      Notiflix.Report.failure(
        'Registration Failed',
        'Passwords do not match',
        'Okay'
      );
      return;
    }

    try {
      let avatarUrl = null;
      if (avatar) {
        const fileExtension = avatar.name.split('.').pop();
        const renamedFile = new File(
          [avatar],
          `${username}.${fileExtension}`,
          { type: avatar.type }
        );

        const formData = new FormData();
        formData.append('file', renamedFile);

        const uploadResponse = await axios.post(
          'http://localhost:8000/face-identification/upload',
          formData
        );

        avatarUrl = uploadResponse.data.file_path;
      }

      const userPayload = {
        username,
        email,
        password,
        role: 'Student',
        avatar: avatarUrl || 'default_avatar_url_here',
      };

      await axios.post('http://localhost:8000/users', userPayload);

      Notiflix.Report.success(
        'Success',
        'Registration Successful',
        'Okay',
        () => {
          localStorage.setItem('username', username);
          localStorage.setItem('role', 'Student');
          EventEmitter.emit('loginCompleted', { logged: true });
          navigate('/sign-in');
        }
      );
    } catch (error) {
      console.error('Registration Error:', error);
      Notiflix.Report.failure(
        'Registration Failed',
        error.response?.data?.detail || 'An error occurred. Please try again.',
        'Okay'
      );
    }
  };

  return (
    <>
      <div className="form-body" style={{
        minHeight: '100vh',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#f5f5f5'
      }}>
        <div className="max-w-md mx-auto mt-8 p-6 rounded-md shadow-md container form-container">
          <div style={{ textAlign: 'center', marginBottom: '2rem' }}>
            <img
              src={process.env.PUBLIC_URL + '/images/logo-em.png'}
              height={60}
              alt="background"
              style={{ marginBottom: '1rem' }}
            />
            <span style={{
              display: 'block',
              fontSize: '1.5rem',
              fontWeight: '600',
              color: '#ffffff'
            }}>E-Learning</span>
          </div>
          
          <h1 style={{
            fontSize: '2rem',
            fontWeight: '600',
            marginBottom: '1.5rem',
            color: '#ffffff',
            textAlign: 'center'
          }}>Sign Up</h1>
          
          <p style={{
            marginBottom: '2rem',
            color: '#cbd5e0',
            textAlign: 'center'
          }}>Create Your Free Account</p>

          {/* Avatar Upload Section */}
          <div style={{
            display: 'flex',
            justifyContent: 'center',
            marginBottom: '2rem',
            position: 'relative'
          }}>
            <div 
              style={{
                width: '120px',
                height: '120px',
                borderRadius: '50%',
                backgroundColor: '#4a5568',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                cursor: 'pointer',
                overflow: 'hidden',
                border: '3px solid #718096'
              }}
              onClick={() => setShowUploadOptions(true)}
            >
              {avatarPreview ? (
                <img 
                  src={avatarPreview} 
                  alt="Avatar Preview" 
                  style={{
                    width: '100%',
                    height: '100%',
                    objectFit: 'cover'
                  }}
                />
              ) : (
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  style={{
                    width: '3rem',
                    height: '3rem'
                  }} 
                  fill="none" 
                  viewBox="0 0 24 24" 
                  stroke="#e2e8f0"
                >
                  <path 
                    strokeLinecap="round" 
                    strokeLinejoin="round" 
                    strokeWidth={2} 
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" 
                  />
                </svg>
              )}
            </div>
            
            {/* Upload Options Modal */}
            {showUploadOptions && !showWebcam && (
              <div style={{
                position: 'absolute',
                zIndex: 10,
                top: '100%',
                left: '50%',
                transform: 'translateX(-50%)',
                width: '200px',
                backgroundColor: '#4a5568',
                borderRadius: '8px',
                boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
                padding: '0.5rem 0',
                marginTop: '0.5rem'
              }}>
                <div style={{
                  padding: '0.75rem 1rem',
                  fontSize: '0.9rem',
                  color: '#e2e8f0',
                  cursor: 'pointer',
                  transition: 'background-color 0.2s',
                  ':hover': {
                    backgroundColor: '#718096'
                  }
                }}
                  onClick={() => fileInputRef.current.click()}
                >
                  Upload from computer
                </div>
                <div style={{
                  padding: '0.75rem 1rem',
                  fontSize: '0.9rem',
                  color: '#e2e8f0',
                  cursor: 'pointer',
                  transition: 'background-color 0.2s',
                  ':hover': {
                    backgroundColor: '#718096'
                  }
                }}
                  onClick={() => setShowWebcam(true)}
                >
                  Take photo with webcam
                </div>
                <div style={{
                  padding: '0.75rem 1rem',
                  fontSize: '0.9rem',
                  color: '#e2e8f0',
                  cursor: 'pointer',
                  transition: 'background-color 0.2s',
                  ':hover': {
                    backgroundColor: '#718096'
                  }
                }}
                  onClick={() => setShowUploadOptions(false)}
                >
                  Cancel
                </div>
              </div>
            )}

            {/* Webcam Modal */}
            {showWebcam && (
              <div style={{
                position: 'fixed',
                top: 0,
                left: 0,
                right: 0,
                bottom: 0,
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                zIndex: 1000
              }}>
                <div style={{
                  backgroundColor: '#2d3748',
                  padding: '1.5rem',
                  borderRadius: '12px',
                  width: '90%',
                  maxWidth: '500px'
                }}>
                  <Webcam
                    audio={false}
                    ref={webcamRef}
                    screenshotFormat="image/jpeg"
                    style={{
                      width: '100%',
                      borderRadius: '8px',
                      marginBottom: '1.5rem'
                    }}
                  />
                  <div style={{
                    display: 'flex',
                    justifyContent: 'center',
                    gap: '1rem'
                  }}>
                    <button 
                      style={{
                        padding: '0.75rem 1.5rem',
                        backgroundColor: '#4299e1',
                        color: 'white',
                        border: 'none',
                        borderRadius: '6px',
                        cursor: 'pointer',
                        fontWeight: '600',
                        transition: 'background-color 0.2s',
                        ':hover': {
                          backgroundColor: '#3182ce'
                        }
                      }}
                      onClick={capturePhoto}
                    >
                      Capture Photo
                    </button>
                    <button 
                      style={{
                        padding: '0.75rem 1.5rem',
                        backgroundColor: '#718096',
                        color: 'white',
                        border: 'none',
                        borderRadius: '6px',
                        cursor: 'pointer',
                        fontWeight: '600',
                        transition: 'background-color 0.2s',
                        ':hover': {
                          backgroundColor: '#4a5568'
                        }
                      }}
                      onClick={() => {
                        setShowWebcam(false);
                        setShowUploadOptions(false);
                      }}
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </div>
            )}

            <input
              type="file"
              ref={fileInputRef}
              style={{ display: 'none' }}
              accept="image/*"
              onChange={handleFileChange}
            />
          </div>

          <div style={{ marginBottom: '1.5rem' }}>
            <input
              type="text"
              style={{
                width: '100%',
                padding: '0.75rem 1rem',
                border: '1px solid #4a5568',
                borderRadius: '6px',
                backgroundColor: '#4a5568',
                color: '#e2e8f0',
                outline: 'none',
                transition: 'border-color 0.2s',
                ':focus': {
                  borderColor: '#4299e1'
                }
              }}
              value={username}
              placeholder="Username"
              onChange={(e) => setUsername(e.target.value)}
            />
          </div>

          <div style={{ marginBottom: '1.5rem' }}>
            <input
              type="email"
              style={{
                width: '100%',
                padding: '0.75rem 1rem',
                border: '1px solid #4a5568',
                borderRadius: '6px',
                backgroundColor: '#4a5568',
                color: '#e2e8f0',
                outline: 'none',
                transition: 'border-color 0.2s',
                ':focus': {
                  borderColor: '#4299e1'
                }
              }}
              value={email}
              placeholder="Email"
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div style={{ marginBottom: '1.5rem' }}>
            <input
              type="password"
              style={{
                width: '100%',
                padding: '0.75rem 1rem',
                border: '1px solid #4a5568',
                borderRadius: '6px',
                backgroundColor: '#4a5568',
                color: '#e2e8f0',
                outline: 'none',
                transition: 'border-color 0.2s',
                ':focus': {
                  borderColor: '#4299e1'
                }
              }}
              value={password}
              placeholder="Password"
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <div style={{ marginBottom: '2rem' }}>
            <input
              type="password"
              style={{
                width: '100%',
                padding: '0.75rem 1rem',
                border: '1px solid #4a5568',
                borderRadius: '6px',
                backgroundColor: '#4a5568',
                color: '#e2e8f0',
                outline: 'none',
                transition: 'border-color 0.2s',
                ':focus': {
                  borderColor: '#4299e1'
                }
              }}
              value={confirmPassword}
              placeholder="Retype Password"
              onChange={(e) => setConfirmPassword(e.target.value)}
            />
          </div>

          <div style={{ textAlign: 'center', marginBottom: '1.5rem' }}>
            <button 
              style={{
                padding: '0.75rem 2rem',
                backgroundColor: '#4299e1',
                color: 'white',
                border: 'none',
                borderRadius: '6px',
                cursor: 'pointer',
                fontWeight: '600',
                fontSize: '1rem',
                transition: 'background-color 0.2s',
                ':hover': {
                  backgroundColor: '#3182ce'
                }
              }}
              onClick={handleSignUp}
            >
              Sign Up
            </button>
          </div>

          <p style={{
            textAlign: 'center',
            color: '#a0aec0',
            marginTop: '1.5rem'
          }}>
            Already have an account?{' '}
            <Link to="/sign-in" style={{
              color: '#4299e1',
              textDecoration: 'none',
              fontWeight: '600',
              ':hover': {
                textDecoration: 'underline'
              }
            }}>
              Sign In
            </Link>
          </p>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Signup;