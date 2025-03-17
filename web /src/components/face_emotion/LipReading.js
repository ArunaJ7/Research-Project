import { useRef, useEffect, useState } from 'react';
import './face.css';
import * as faceapi from 'face-api.js';

function LipReading({ selectedLesson }) {
    const videoRef = useRef(null);
    const canvasRef = useRef(null);
    const [modelsLoaded, setModelsLoaded] = useState(false);

    useEffect(() => {
        const loadModels = async () => {
            await Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
                faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
                faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
                faceapi.nets.faceExpressionNet.loadFromUri('/models')
            ]);
            setModelsLoaded(true);
        };

        loadModels();
    }, []);

    useEffect(() => {
        if (modelsLoaded && videoRef.current) {
            detectFace();
        }
    }, [modelsLoaded, selectedLesson]);

    const detectFace = async () => {
        if (!videoRef.current || !canvasRef.current) return;

        const canvas = canvasRef.current;
        const videoElement = videoRef.current;

        faceapi.matchDimensions(canvas, { width: 940, height: 650 });

        const processFace = async () => {
            if (!videoElement || videoElement.paused || videoElement.ended) return;

            const detections = await faceapi
                .detectAllFaces(videoElement, new faceapi.TinyFaceDetectorOptions())
                .withFaceLandmarks()
                .withFaceExpressions();

            const resizedDetections = faceapi.resizeResults(detections, { width: 940, height: 650 });

            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);
            faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
            faceapi.draw.drawFaceExpressions(canvas, resizedDetections);

            requestAnimationFrame(processFace);
        };

        videoElement.addEventListener('play', processFace);
    };

    return (
        <div>
            <h1>{selectedLesson?.title}</h1>
            <p>{selectedLesson?.content}</p>
            <div>
                <video
                loop
                muted
                // autoPlay
                    ref={videoRef}
                    width="100%"
                    height="400"
                    controls
                    autoPlay
                    playsInline
                    src={'/'+selectedLesson?.videoId} 
                    type="video/mp4"
                />
            </div>
            <canvas ref={canvasRef} className="appcanvas"></canvas>
        </div>
    );
}

export default LipReading;
