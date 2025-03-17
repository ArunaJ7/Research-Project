import React, { useState, useEffect } from 'react';
import './form.css';
import Footer from '../components/footer/Footer';
import FaceEmotion from "../components/face_emotion/FaceEmotion";
import { Link, useNavigate } from 'react-router-dom';

const EmotionSuggestion = () => {
    const navigate = useNavigate()
  const [currentEmotion, setCurrentEmotion] = useState(null);
  const [stableEmotion, setStableEmotion] = useState(null);
  const [shorts, setShorts] = useState([]);

  const emotionEmojis = {
    happy: "😃",
    sad: "😢",
    angry: "😡",
    surprised: "😲",
    neutral: "😐",
    fearful: "😨",
    disgusted: "🤢",
  };

  const gameList = [
    { title: "Snake Game", image: "https://cdn.content.play123.com/game-images/snake_xl.jpg" },
    { title: "Minecarft Game", image: "https://www.minecraft.net/content/dam/games/minecraft/game-characters/Free-Trial_Featured-Image-0_570x321.jpg" },
  ];

  useEffect(() => {
    const interval = setInterval(() => {
      if (currentEmotion && currentEmotion !== stableEmotion) {
        setStableEmotion(currentEmotion);
        fetchYouTubeShorts(currentEmotion);
      }
    }, 10000);

    return () => clearInterval(interval);
  }, [currentEmotion]);

  const handleEmotionDetection = (emotions) => {
    const highestEmotion = Object.keys(emotions).reduce((a, b) => emotions[a] > emotions[b] ? a : b);
    setCurrentEmotion(highestEmotion);
  };

  const fetchYouTubeShorts = async (emotion) => {
    const API_KEY = "AIzaSyAONkW6zKR9yfPCFX8WX0vWQr8Ir31JTd8";  
    const query = getQueryForEmotion(emotion);
    const url = `https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=5&q=${query}&type=video&videoDuration=short&videoCategoryId=24&key=${API_KEY}`;

    try {
      const response = await fetch(url);
      const data = await response.json();
      if (data.items) {
        setShorts(data.items);
      }
    } catch (error) {
      console.error("Error fetching YouTube Shorts:", error);
    }
  };

  const getQueryForEmotion = (emotion) => {
    const queries = {
      happy: "funny kids videos",
      sad: "uplifting kids shorts",
      angry: "relaxing kids animations",
      surprised: "exciting discovery videos",
      neutral: "calming bedtime stories",
    };
    return queries[emotion] || "kids shorts";
  };

  return (
    <>
      <div className='form-body'>
        <div className="max-w-screen-lg mx-auto mt-8 p-6 rounded-md shadow-md container form-container" style={{ width: '90vw', display: 'flex', backgroundColor: 'white' }}>
        <div style={{ width: '30%', padding: '20px', textAlign: 'center' }}>
            <FaceEmotion onDetectEmotion={handleEmotionDetection} />
            
            {/* Display Emotion Emoji */}
            <div className="mt-4 flex flex-col items-center">
                <br></br>
                <br></br>
                <span style={{ fontSize: '10rem' }}>
                {emotionEmojis[currentEmotion] || "🤔"}
                </span>
                <p className="mt-2 text-lg font-semibold">
                Detected Emotion: <strong>{currentEmotion || 'Detecting...'}</strong>
                </p>
            </div>
            {currentEmotion=='neutral'&&<center>
                <Link to={'/dashboard'}>To Dashboard</Link>
            </center>}
        </div>

          <div style={{ width: '70%', padding: '20px' }}>
            <h5 className='text-2xl font-semibold mb-4'>Emotion-Based Content Suggestions</h5>
            <div className="mb-6">
                <h5 className='text-xl font-semibold mb-2'>Play Game</h5>
                <div className="flex gap-4 overflow-x-auto" style={{display: 'flex'}}>
                    {gameList.map((game, index) => (
                    <div key={index} className="bg-white rounded-lg shadow-md p-3 w-40 flex flex-col items-center" onClick={() => {
                        navigate('/dashboard/snake-game')
                    }}>
                        {/* Game Image */}
                        <img 
                        src={game.image} 
                        alt={game.title} 
                        height={80}
                        className="w-full h-24 object-cover rounded-md"
                        style={{borderRadius: '10px'}}
                        />
                        
                        {/* Game Title */}
                        <p className="mt-2 text-center font-medium text-gray-700" style={{color:'black'}}>{game.title}</p>
                    </div>
                    ))}
                </div>
            </div>

            {stableEmotion && (
                <>
                <div className="mb-6">
                    <h5 className='text-xl font-semibold mb-2'>YouTube Shorts</h5>
                    {shorts.length > 0 ? (
                    <ul className='space-y-4'>
                    {shorts.map((video) => (
                        <li 
                        key={video.id.videoId} 
                        className='flex items-center bg-white p-4 rounded-lg shadow-md border border-gray-200'
                        style={{display: 'flex'}}
                        >
                        {/* Thumbnail (25% width) */}
                        <div className='w-1/4'>
                            <img 
                            src={video.snippet.thumbnails.default.url} 
                            alt={video.snippet.title} 
                            className='w-full h-auto rounded-md'
                            />
                        </div>
                    
                        {/* Video Details (75% width) */}
                        <div className='w-3/4 pl-4' style={{textAlign: 'left', marginLeft: '15px'}}>
                            <a 
                            href={`https://www.youtube.com/watch?v=${video.id.videoId}`} 
                            className='text-blue-600 font-semibold hover:underline block'
                            target="_blank" 
                            rel="noopener noreferrer"
                            >
                            {video.snippet.title}
                            </a>
                            <p className='text-gray-500 text-sm mt-1'>
                            {video.snippet.channelTitle}
                            </p>
                        </div>
                        </li>
                    ))}
                    </ul>
                    ) : (
                    <p>Loading recommendations...</p>
                    )}
                </div>
                </>
            )}
            </div>

        </div>
      </div>
      <Footer />
    </>
  );
};

export default EmotionSuggestion;
