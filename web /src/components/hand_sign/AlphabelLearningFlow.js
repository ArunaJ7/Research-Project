import React, { useState, useRef, useEffect } from 'react';
import { FaCamera, FaSnapchat, FaCheckCircle, FaArrowLeft, FaArrowRight, FaTimes } from 'react-icons/fa';
import env from '../../data/env';

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

function transformResult(resultString) {
  let transformed = [];
  let i = 0;

  while (i < resultString.length) {
    const current = resultString[i];
    const next = i + 1 < resultString.length ? resultString[i + 1] : null;
    
    if (consonantLabels.includes(current) && next && vowelLabels.includes(next)) {
      // If current is a consonant and next is a vowel, map them
      if (vowelMap[current] && vowelMap[current][next]) {
        transformed.push(vowelMap[current][next]);
        i += 2; // Skip next letter as it's already processed
        continue;
      }
    }
    
    // Otherwise, just add the current letter
    transformed.push(current);
    i++;
  }
  console.log(transformed)

  return transformed.join('');
}

function AlphabetLearningFlow({ selectedLesson }) {
  const [isLoading, setIsLoading] = useState(false);
  const [step, setStep] = useState(1);
  const [isWebcamActive, setIsWebcamActive] = useState(false);
  const [snapshots, setSnapshots] = useState([]);
  const [isSnapping, setIsSnapping] = useState(false);
  const [result, setResult] = useState(null);
  const snapIntervalRef = useRef(null);
  const videoRef = useRef(null);

  useEffect(() => {
    setStep(1);
    setSnapshots([]); // Optionally clear previous snapshots
    setResult(null); // Reset previous result
    setIsWebcamActive(false); // Reset webcam state
    setIsSnapping(false);
  }, [selectedLesson]);

  useEffect(() => {
    return () => {
      stopWebcam();
    };
  }, []);

  if (!selectedLesson) return null;

  const handleStartWebcam = () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
          if (videoRef.current) {  
            videoRef.current.srcObject = stream;
            setIsWebcamActive(true);
          }
        })
        .catch((err) => {
          console.error('Error accessing webcam:', err);
        });
    }
  };

  const stopWebcam = () => {
    if (videoRef.current && videoRef.current.srcObject) {
      const stream = videoRef.current.srcObject;
      const tracks = stream.getTracks();
      tracks.forEach(track => track.stop()); // Stop each track
      videoRef.current.srcObject = null; // Clear the video source
    }
    setIsWebcamActive(false);
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

        snapIntervalRef.current = setInterval(() => {
          context.drawImage(videoRef.current, 0, 0, canvas.width, canvas.height);
          const imageData = canvas.toDataURL('image/png');
          setSnapshots((prevSnapshots) => [...prevSnapshots, imageData]);
        }, 2000);

        setIsSnapping(true);
      }
    }
  };

  const handleSubmit = async () => {
    if (snapshots.length === 0) return;
    setIsLoading(true);

    const formData = new FormData();
    
    snapshots.forEach((snapshot, index) => {
      const byteCharacters = atob(snapshot.split(',')[1]);
      const byteNumbers = new Array(byteCharacters.length);
      for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
      }
      const byteArray = new Uint8Array(byteNumbers);
      const blob = new Blob([byteArray], { type: 'image/png' });
      formData.append('files', blob, `snapshot_${index}.png`);
    });

    try {
      const response = await fetch(env.ML2_URL+'/predict-handsigns-alphabet', {
        method: 'POST',
        body: formData,
      });

      const result = await response.json();
      // console.log('Upload successful:', result);
      setResult(transformResult(result.predicted_classes))
      // console.log(transformResult(result.predicted_classes))
    } catch (error) {
      console.error('Error uploading snapshots:', error);
    } finally {
      setIsLoading(false); 
    }
  };

  const handleDeleteSnapshot = (index) => {
    setSnapshots(snapshots.filter((_, i) => i !== index));
  };

  const handleDragStart = (e, index) => {
    e.dataTransfer.setData('index', index);
  };

  const handleDrop = (e, index) => {
    const draggedIndex = e.dataTransfer.getData('index');
    const newSnapshots = [...snapshots];
    const [draggedSnapshot] = newSnapshots.splice(draggedIndex, 1);
    newSnapshots.splice(index, 0, draggedSnapshot);
    setSnapshots(newSnapshots);
  };

  const handleDragOver = (e) => {
    e.preventDefault();
  };

  const handleNext = () => {
    if (step < 4) setStep(step + 1);
    // transformResult('උක්අග්අග්')
    stopWebcam()
  };

  const handlePrevious = () => {
    if (step > 1) setStep(step - 1);
    stopWebcam()
  };

  return (
    <div>
      <h3>{selectedLesson.title}</h3>

      {/* Step 1: Load Image with Caption */}
      {step === 1 && (
        <div className="text-center">
          <h4>Step 1: Observe the Letter</h4>
          <div className="row justify-content-center">
            {selectedLesson.images.map((image, index) => (
              <div key={index} className="col-md-4">
                <img src={image} alt={`Letter ${selectedLesson.title}`} className="img-fluid rounded" />
                <p className="text-muted">Guide Image "{selectedLesson.title}" in Sinhala.</p>
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Step 2: Load YouTube Video */}
      {step === 2 && (
        <div className="text-center">
          <h4>Step 2: Watch the Video</h4>
          <div className="embed-responsive embed-responsive-16by9">
            <iframe
              className="embed-responsive-item"
              width="100%"
              height="400"
              src={selectedLesson.videoUrl}
              title={selectedLesson.title}
              allowFullScreen
            ></iframe>
          </div>
        </div>
      )}

      {/* Step 3: Activate Camera for Practice */}
      {step === 3 && (
  <div className="text-center">
    <h4>Step 3: Practice with Webcam</h4>

    {/* Ensure video element always exists */}
    <div className="video-container my-4">
      <video ref={videoRef} width="100%" autoPlay playsInline />
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
      <div className="col-4 text-center">
        <button className="btn btn-success" onClick={handleSubmit} disabled={snapshots.length === 0}>
          <FaCheckCircle size={30} />
          <br />
          <small>Submit</small>
        </button>
      </div>
      {snapshots.length > 0 && (
              <div className="my-4">
                <h4>Captured Frames:</h4>
                <div className="row">
                  {snapshots.map((snapshot, index) => (
                    <div 
                      key={index} 
                      className="col-4 mb-3" 
                      onDragOver={handleDragOver}
                      onDrop={(e) => handleDrop(e, index)}
                      draggable
                      onDragStart={(e) => handleDragStart(e, index)}
                    >
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
                        <img
                          src={snapshot}
                          alt={`Snapshot ${index + 1}`}
                          className="img-fluid rounded"
                        />
                      </div>
                    </div>
                  ))}
                </div>
                {isLoading ? (
                  <img src={"/gifs/loading.gif"} alt="Loading..." style={{ width: 30, height: 30 }} />
                ) : (
                  <>
                    <FaCheckCircle size={30} />
                    <br />
                    <small>Submit</small>
                  </>
                )}
                {result && (
                  <div style={{
                    backgroundColor: result === selectedLesson.title ? '#4CAF50' : '#f0f0f0',
                    padding: '20px',
                    borderRadius: '12px',
                    fontSize: '24px',
                    textAlign: 'center',
                    margin: '20px auto',
                    width: '50%',
                    color: result === selectedLesson.title ? 'white' : 'black'
                  }}>
                    {result}
                  </div>
                )}
              </div>
            )}
    </div>
  </div>
)}

      {/* Step 4: Show Result and Summary */}
      {step === 4 && (
        <div className="text-center">
          <h4>Step 4: Summary & Result</h4>
          {snapshots.length > 0 ? (
            <div>
              <h5>Your Snapshots:</h5>
              <div className="row">
                {snapshots.map((snapshot, index) => (
                  <div key={index} className="col-4">
                    <img src={snapshot} alt={`Snapshot ${index + 1}`} className="img-fluid rounded" />
                  </div>
                ))}
              </div>
              <p className={result && result.predicted_classes === selectedLesson.title ? "text-success" : "text-danger"}>
                {result && result === selectedLesson.title 
                  ? `Great job! You correctly identified the letter "${selectedLesson.title}".`
                  : `Oops! The predicted letter was "${result}". Try again!`}
              </p>
            </div>
          ) : (
            <p className="text-danger">No snapshots were taken. Please try again.</p>
          )}
        </div>
      )}

      {/* Navigation Buttons */}
      <div className="d-flex justify-content-between mt-4">
        <button className="btn btn-secondary" onClick={handlePrevious} disabled={step === 1}>
          <FaArrowLeft /> Previous
        </button>
        <button className="btn btn-primary" onClick={handleNext} disabled={step === 4}>
          Next <FaArrowRight />
        </button>
      </div>
    </div>
  );
}

export default AlphabetLearningFlow;
