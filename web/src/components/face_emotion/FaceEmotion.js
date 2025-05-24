import { useRef, useEffect, useState } from 'react';
import './face.css';
import * as faceapi from 'face-api.js';

function FaceEmotion({ onDetectEmotion }) {
  const videoRef = useRef();
  const canvasRef = useRef();
  
  useEffect(() => {
    startVideo();
    loadModels();
  }, []);

  const startVideo = () => {
    navigator.mediaDevices.getUserMedia({ video: true })
      .then((currentStream) => {
        videoRef.current.srcObject = currentStream;
      })
      .catch((err) => {
        console.log(err);
      });
  };

  const loadModels = async () => {
    await Promise.all([
      faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
      faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
      faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
      faceapi.nets.faceExpressionNet.loadFromUri('/models')
    ]);
    detectFace();
  };

  const detectFace = () => {
    setInterval(async () => {
      if (!videoRef.current) return;
      const detections = await faceapi.detectAllFaces(videoRef.current,
        new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions();
      
      const emotions = detections.map(detection => detection.expressions);
      if (emotions.length > 0) {
        onDetectEmotion(emotions[0]);
      }

      const canvas = faceapi.createCanvasFromMedia(videoRef.current);
      canvasRef.current.innerHTML = ''; // Clear previous drawings
      canvasRef.current.appendChild(canvas);
      faceapi.matchDimensions(canvas, { width: 940, height: 650 });
      const resized = faceapi.resizeResults(detections, { width: 940, height: 650 });
      faceapi.draw.drawDetections(canvas, resized);
      faceapi.draw.drawFaceLandmarks(canvas, resized);
      faceapi.draw.drawFaceExpressions(canvas, resized);
    }, 1000);
  };

  return (
    <div className="face-canvas">
      <div className="appvideo">
        <video ref={videoRef} autoPlay crossOrigin="anonymous" width="0" height="0" ></video>
      </div>
      <div ref={canvasRef} className="appcanvas"></div>
    </div>
  );
}

export default FaceEmotion;
