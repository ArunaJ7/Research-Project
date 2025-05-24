import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Notiflix from 'notiflix';
import Footer from '../components/footer/Footer';
import { FaTrashAlt, FaPlus } from 'react-icons/fa'; // Importing React Icons
import env from '../data/env';
import PersonaInfosService from '../services/PersonaInfos.service';

const Survey = () => {
  const navigate = useNavigate();
  const [studyHours, setStudyHours] = useState(0);
  const [sleepHours, setSleepHours] = useState(0);
  const [subjects, setSubjects] = useState([]);
  const [unavailableSubjects, setUnavailableSubjects] = useState([]);
  const [favoriteSubjects, setFavoriteSubjects] = useState([]);
  const [otherSubjects, setOtherSubjects] = useState([]);
  const [selectedSubject, setSelectedSubject] = useState('');
  const [favoriteSubject, setFavoriteSubject] = useState('');
  const [gender, setGender] = useState('Male');
  const [age, setAge] = useState(18);

  const handleAddSubject = () => {
    if (!selectedSubject) return;
    if (!subjects.includes(selectedSubject)) {
      setSubjects([...subjects, selectedSubject]);
    }
    setSelectedSubject('');
  };

  const handleAddUnavailableSubject = () => {
    if (!selectedSubject) return;
    if (!unavailableSubjects.includes(selectedSubject)) {
      setUnavailableSubjects([...unavailableSubjects, selectedSubject]);
    }
    setSelectedSubject('');
  };

  const handleRemoveSubject = (index) => {
    const updatedSubjects = [...subjects];
    updatedSubjects.splice(index, 1);
    setSubjects(updatedSubjects);
  };

  const handleRemoveUnavailableSubject = (index) => {
    const updatedUnavailableSubjects = [...unavailableSubjects];
    updatedUnavailableSubjects.splice(index, 1);
    setUnavailableSubjects(updatedUnavailableSubjects);
  };

  const handleAddFavoriteSubject = () => {
    if (!favoriteSubject) return;
    if (!favoriteSubjects.includes(favoriteSubject)) {
      setFavoriteSubjects([...favoriteSubjects, favoriteSubject]);
    }
    setFavoriteSubject('');
  };

  const handleRemoveFaveSubject = (index) => {
    const updatedUnavailableSubjects = [...unavailableSubjects];
    updatedUnavailableSubjects.splice(index, 1);
    setFavoriteSubject(updatedUnavailableSubjects);
  };

  const handleSubmit = async () => {
    let obj = {
        username: localStorage.getItem('username'),
        studyHours: studyHours,
        sleepHours: sleepHours, 
        subjects: subjects,
        favorite: unavailableSubjects,
        gender,
        age
    }
    await PersonaInfosService.createPersonalInfo(obj).then(() => {
        Notiflix.Notify.success('Survey submitted successfully!');
        navigate('/');
    })
  };

  return (
    <>
      <div className="form-body">
        <div className="max-w-md mx-auto mt-8 p-6 rounded-md shadow-md container form-container">
          <h1 className="text-3xl font-semibold mb-6">Survey</h1>

          {/* Study Hours */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Study Hours</label>
            <input
              type="range"
              min={0}
              max={16}
              value={studyHours}
              onChange={(e) => setStudyHours(e.target.value)}
              className="w-full "
            />
            <span className="text-primary custom-form-button">{studyHours} hours</span>
          </div>
            <hr/>
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Sleep Hours</label>
            <input
              type="range"
              min={0}
              max={16}
              value={sleepHours}
              onChange={(e) => setSleepHours(e.target.value)}
              className="w-full "
            />
            <span className="text-primary custom-form-button">{sleepHours} hours</span>
          </div>
            <hr/>
            <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Gender</label>
            <select
              value={gender}
              onChange={(e) => setGender(e.target.value)}
              className="w-full px-4 py-2 border rounded-md mr-2 focus:outline-none focus:border-blue-500"
            >
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          {/* Age Range */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Age</label>
            <input
              type="range"
              min={10}
              max={100}
              value={age}
              onChange={(e) => setAge(e.target.value)}
              className="w-full "
            />
            <span className="text-primary custom-form-button">{age} years</span>
          </div>
          {/* Major Subjects */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Subjects</label>
            <div className="flex items-center">
              <select
                value={selectedSubject}
                onChange={(e) => setSelectedSubject(e.target.value)}
                className="w-full px-4 py-2 border rounded-md mr-2 focus:outline-none focus:border-blue-500"
              >
                <option value="">Select subject</option>
                {env.SUBJECTS.map((item) => <option value={item}>{item}</option>)}
              </select>
              <button
                onClick={handleAddSubject}
                className="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded custom-form-button"
              >
                <FaPlus /> {/* React Icon */}
              </button>
            </div>
            <div className="flex flex-wrap mt-2">
              {subjects.map((subject, index) => (
                <div key={index} className="bg-gray-200 px-2 py-1 rounded-md mr-2 mb-2 custom-token">
                  <span>{subject}</span>
                  <FaTrashAlt className="ml-1 cursor-pointer" onClick={() => handleRemoveSubject(index)} /> {/* React Icon */}
                </div>
              ))}
            </div>
          </div>

          

          {/* Favorite Subjects */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Add Subjects (Not available in List)</label>
            <div className="flex items-center">
              <input
                type="text"
                value={favoriteSubject}
                onChange={(e) => setFavoriteSubject(e.target.value)}
                className="w-full px-4 py-2 border rounded-md mr-2 focus:outline-none focus:border-blue-500"
                placeholder="Enter favorite subject"
              />
              <button
                onClick={handleAddFavoriteSubject}
                className="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded custom-form-button"
              >
                <FaPlus /> {/* React Icon */}
              </button>
            </div>
            <div className="flex flex-wrap mt-2">
              {favoriteSubjects.map((subject, index) => (
                <div key={index} className="bg-gray-200 px-2 py-1 rounded-md mr-2 mb-2 custom-token">
                    <span>{subject}</span>
                    <FaTrashAlt className="ml-1 cursor-pointer" onClick={() => handleRemoveFaveSubject(index)} /> {/* React Icon */}
                </div>
              ))}
            </div>
          </div>

          {/* Unavailable Subjects */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2">Favorite Subjects</label>
            <div className="flex items-center">
              <select
                value={selectedSubject}
                onChange={(e) => setSelectedSubject(e.target.value)}
                className="w-full px-4 py-2 border rounded-md mr-2 focus:outline-none focus:border-blue-500"
              >
                <option value="">Select subject</option>
                {subjects.map((item) => <option value={item}>{item}</option>)}
                {favoriteSubjects.map((item) => <option value={item}>{item}</option>)}
              </select>
              <button
                onClick={handleAddUnavailableSubject}
                className="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded custom-form-button"
              >
                <FaPlus /> {/* React Icon */}
              </button>
            </div>
            <div className="flex flex-wrap mt-2">
              {unavailableSubjects.map((subject, index) => (
                <div key={index} className="bg-gray-200 px-2 py-1 rounded-md mr-2 mb-2 custom-token">
                  {subject}
                  <FaTrashAlt className="ml-1 cursor-pointer" onClick={() => handleRemoveUnavailableSubject(index)} /> {/* React Icon */}
                </div>
              ))}
            </div>
          </div>

          {/* Submit Button */}
          <div className='text-center'>
            <button
            className="custom-button"
            onClick={handleSubmit}
            >
            Submit Survey
            </button>
        </div>

          <p className="mt-4 text-center text-gray-600">
            Already have an account?{' '}
            <Link to="/" className="text-blue-500 hover:underline">
              Skip this Step
            </Link>
          </p>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Survey;
