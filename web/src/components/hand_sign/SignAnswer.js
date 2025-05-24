import React, { useState, useRef, useEffect } from 'react';
import { FaCamera, FaSnapchat, FaCheckCircle, FaTimes } from 'react-icons/fa';
import * as tmImage from '@teachablemachine/image';
import * as tf from '@tensorflow/tfjs';

const MODEL_URL = "https://teachablemachine.withgoogle.com/models/JgL5ndO1F/";
const vowelLabels = ["අ", "අං", "ආ", "ඇ", "ඈ", "ඉ", "ඊ", "උ", "ඌ", "එ", "ඒ", "ඔ", "ඕ"];
const consonantLabels = ["ක්", "ග්", "ච්", "ජ්", "ට්", "ඩ්", "ණ්", "ඬ", "ත්", "ද්", "න්", "ඳ", "ප්", "බ්", "ම්", "ඹ", "යි", "ර්", "ල්", "ව්", "ස්", "හ්", "ළ"];

const vowelMap = {
  "ක්": { "අ": "ක", "ආ": "කා", "ඇ": "කැ", "ඈ": "කෑ", "ඉ": "කි", "ඊ": "කී", "උ": "කු", "ඌ": "කූ", "එ": "කෙ", "ඒ": "කේ", "ඔ": "කො", "ඕ": "කෝ" },
  "ග්": { "අ": "ග", "ආ": "ගා", "ඇ": "ගැ", "ඈ": "ගෑ", "ඉ": "ගි", "ඊ": "ගී", "උ": "ගු", "ඌ": "ගූ", "එ": "ගෙ", "ඒ": "ගේ", "ඔ": "ගො", "ඕ": "ගෝ" },
  "ච්": { "අ": "ච", "ආ": "චා", "ඇ": "චැ", "ඈ": "චෑ", "ඉ": "චි", "ඊ": "චී", "උ": "චු", "ඌ": "චූ", "එ": "චෙ", "ඒ": "චේ", "ඔ": "චො", "ඕ": "චෝ" },
  "ජ්": { "අ": "ජ", "ආ": "ජා", "ඇ": "ජැ", "ඈ": "ජෑ", "ඉ": "ජි", "ඊ": "ජී", "උ": "ජු", "ඌ": "ජූ", "එ": "ජෙ", "ඒ": "ජේ", "ඔ": "ජො", "ඕ": "ජෝ" },
  "ට්": { "අ": "ට", "ආ": "ටා", "ඇ": "ටැ", "ඈ": "ටෑ", "ඉ": "ටි", "ඊ": "ටී", "උ": "ටු", "ඌ": "ටූ", "එ": "ටෙ", "ඒ": "ටේ", "ඔ": "ටො", "ඕ": "ටෝ" },
  "ඩ්": { "අ": "ඩ", "ආ": "ඩා", "ඇ": "ඩැ", "ඈ": "ඩෑ", "ඉ": "ඩි", "ඊ": "ඩී", "උ": "ඩු", "ඌ": "ඩූ", "එ": "ඩෙ", "ඒ": "ඩේ", "ඔ": "ඩො", "ඕ": "ඩෝ" },
  "ණ්": { "අ": "ණ", "ආ": "ණා", "ඇ": "ණැ", "ඈ": "ණෑ", "ඉ": "ණි", "ඊ": "ණී", "උ": "ණු", "ඌ": "ණූ", "එ": "ණෙ", "ඒ": "ණේ", "ඔ": "ණො", "ඕ": "ණෝ" },
  "ඬ": { "අ": "ඬ", "ආ": "ඬා", "ඇ": "ඬැ", "ඈ": "ඬෑ", "ඉ": "ඬි", "ඊ": "ඬී", "උ": "ඬු", "ඌ": "ඬූ", "එ": "ඬෙ", "ඒ": "ඬේ", "ඔ": "ඬො", "ඕ": "ඬෝ" },
  "ත්": { "අ": "ත", "ආ": "තා", "ඇ": "තැ", "ඈ": "තෑ", "ඉ": "ති", "ඊ": "තී", "උ": "තු", "ඌ": "තූ", "එ": "තෙ", "ඒ": "තේ", "ඔ": "තො", "ඕ": "තෝ" },
  "ද්": { "අ": "ද", "ආ": "දා", "ඇ": "දැ", "ඈ": "දෑ", "ඉ": "දි", "ඊ": "දී", "උ": "දු", "ඌ": "දූ", "එ": "දෙ", "ඒ": "දේ", "ඔ": "දො", "ඕ": "දෝ" },
  "න්": { "අ": "න", "ආ": "නා", "ඇ": "නැ", "ඈ": "නෑ", "ඉ": "නි", "ඊ": "නී", "උ": "නු", "ඌ": "නූ", "එ": "නෙ", "ඒ": "නේ", "ඔ": "නො", "ඕ": "නෝ" },
  "ඳ": { "අ": "ඳ", "ආ": "ඳා", "ඇ": "ඳැ", "ඈ": "ඳෑ", "ඉ": "ඳි", "ඊ": "ඳී", "උ": "ඳු", "ඌ": "ඳූ", "එ": "ඳෙ", "ඒ": "ඳේ", "ඔ": "ඳො", "ඕ": "ඳෝ" },
  "ප්": { "අ": "ප", "ආ": "පා", "ඇ": "පැ", "ඈ": "පා", "ඉ": "පි", "ඊ": "පී", "උ": "පු", "ඌ": "පූ", "එ": "පෙ", "ඒ": "පේ", "ඔ": "පො", "ඕ": "පෝ" },
  "බ්": { "අ": "බ", "ආ": "බා", "ඇ": "බැ", "ඈ": "බෑ", "ඉ": "බි", "ඊ": "බී", "උ": "බු", "ඌ": "බූ", "එ": "බෙ", "ඒ": "බේ", "ඔ": "බො", "ඕ": "බෝ" },
  "ම්": { "අ": "ම", "ආ": "මා", "ඇ": "මැ", "ඈ": "මෑ", "ඉ": "මි", "ඊ": "මී", "උ": "මු", "ඌ": "මූ", "එ": "මෙ", "ඒ": "මේ", "ඔ": "මො", "ඕ": "මෝ" },
  "ඹ": { "අ": "ඹ", "ආ": "ඹා", "ඇ": "ඹැ", "ඈ": "ඹෑ", "ඉ": "ඹි", "ඊ": "ඹී", "උ": "ඹු", "ඌ": "ඹූ", "එ": "ඹෙ", "ඒ": "ඹේ", "ඔ": "ඹො", "ඕ": "ඹෝ" }
};

function transformResult(resultArray) {
  let transformed = [];
  for (let i = 0; i < resultArray.length; i++) {
    const current = resultArray[i];
    const previous = transformed.length > 0 ? transformed[transformed.length - 1] : null;

    if (previous && consonantLabels.includes(previous) && vowelLabels.includes(current)) {
      if (vowelMap[previous] && vowelMap[previous][current]) {
        transformed[transformed.length - 1] = vowelMap[previous][current];
      } else {
        transformed.push(current);
      }
    } else {
      transformed.push(current);
    }
  }
  return transformed.join('');
}

function SignAnswer({ selectedLesson }) {
  const [isWebcamActive, setIsWebcamActive] = useState(false);
  const [snapshots, setSnapshots] = useState([]);
  const [isSnapping, setIsSnapping] = useState(false);
  const [predictions, setPredictions] = useState([]);
  const [finalResult, setFinalResult] = useState('');
  const snapIntervalRef = useRef(null);
  const videoRef = useRef(null);
  const modelRef = useRef(null);
  const maxPredictionsRef = useRef(null);
  const labelContainerRef = useRef(null);
  
  useEffect(() => {
    loadModel();
  }, []);

  if (!selectedLesson) return null;

  const loadModel = async () => {
    const modelURL = MODEL_URL + "model.json";
    const metadataURL = MODEL_URL + "metadata.json";
    modelRef.current = await tmImage.load(modelURL, metadataURL);
    maxPredictionsRef.current = modelRef.current.getTotalClasses();
  };
  

  const handleStartWebcam = async () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
          videoRef.current.srcObject = stream;
          videoRef.current.play();
          videoRef.current.oncanplay = () => {
            setIsWebcamActive(true);
          };
        })
        .catch((err) => {
          console.error('Error accessing webcam: ', err);
        });
    }
  };

  const handleSnapFrames = () => {
    if (isSnapping) {
      clearInterval(snapIntervalRef.current);
      setIsSnapping(false);
    } else {
      if (videoRef.current && isWebcamActive) {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = videoRef.current.videoWidth;
        canvas.height = videoRef.current.videoHeight;
  
        snapIntervalRef.current = setInterval(async () => {
          
          if (videoRef.current && videoRef.current.readyState >= 2) { // READY_STATE_HAVE_ENOUGH_DATA
            const imageBitmap = await createImageBitmap(videoRef.current);
              context.drawImage(imageBitmap, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
          setSnapshots((prevSnapshots) => [...prevSnapshots, imageData]);
          predict(canvas);
          }
          // context.drawImage(videoRef.current, 0, 0, canvas.width, canvas.height);
          
        }, 2000);
  
        setIsSnapping(true);
      }
    }
  };

  const predict = async (canvas) => {
    if (!modelRef.current) return;
  
    const imageTensor = tf.browser.fromPixels(canvas).resizeNearestNeighbor([224, 224]).toFloat().expandDims();
    const prediction = await modelRef.current.predict(imageTensor);
    
    imageTensor.dispose(); // Clean up memory
  
    const highestPrediction = prediction.reduce((prev, current) => (prev.probability > current.probability ? prev : current));
    const result = `${highestPrediction.className} (${highestPrediction.probability.toFixed(2)})`;
  
    setPredictions((prevPredictions) => [...prevPredictions, highestPrediction.className]);
    setFinalResult((prevResult) => transformResult([...prevResult, highestPrediction.className]));
  };

  const handleDeleteSnapshot = (index) => {
    setSnapshots(snapshots.filter((_, i) => i !== index));
  };

  return (
    <div>
      <h3>{selectedLesson.title}</h3>
      <div className="video-container my-4">
        <video ref={videoRef} src={selectedLesson.videoUrl} type="video/mp4" width="100%" controls autoPlay />
      </div>

      <div className="row my-4">
        <div className="col-4 text-center">
          <button className="btn btn-primary" onClick={handleStartWebcam} disabled={isWebcamActive}>
            <FaCamera size={30} />
            <br />
            <small>Start Webcam</small>
          </button>
        </div>
        <div className="col-4 text-center">
          <button className={`btn ${isSnapping ? 'btn-danger' : 'btn-warning'}`} onClick={handleSnapFrames} disabled={!isWebcamActive}>
            <FaSnapchat size={30} />
            <br />
            <small>{isSnapping ? 'Stop Snapping' : 'Start Snapping'}</small>
          </button>
        </div>
      </div>

      {snapshots.length > 0 && (
        <div className="my-4">
          <h4>Captured Frames:</h4>
          <div className="row">
            {snapshots.map((snapshot, index) => (
              <div key={index} className="col-4 mb-3">
                <div style={{ position: 'relative' }}>
                  <FaTimes 
                    style={{
                      position: 'absolute',
                      top: 0,
                      right: 0,
                      color: 'red',
                      cursor: 'pointer',
                      zIndex: 1
                    }} 
                    onClick={() => handleDeleteSnapshot(index)} 
                  />
                  <img src={snapshot} alt={`Snapshot ${index + 1}`} className="img-fluid rounded" />
                </div>
              </div>
            ))}
          </div>
        </div>
      )}

      {predictions.length > 0 && (
        <div>
          <h4>Predictions:</h4>
          <ul>
            {predictions.map((pred, index) => (
              <li key={index}>{pred}</li>
            ))}
          </ul>
        </div>
      )}

      {finalResult && (
        <div>
          <h4>Final Result:</h4>
          <p>{finalResult}</p>
        </div>
      )}
    </div>
  );
}

export default SignAnswer;
