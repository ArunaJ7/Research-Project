import React, { useEffect, useRef, useState } from "react";
import { FaVideo, FaStop, FaPaperPlane, FaCamera } from "react-icons/fa";
import env from "../../data/env";
import axios from "axios";

function PaintCanvas({ level }) {
  const canvasRef = useRef(null);
  const backgroundCanvasRef = useRef(null);
  const [isDrawing, setIsDrawing] = useState(false);
  const [selectedColor, setSelectedColor] = useState("black");
  const [brushSize, setBrushSize] = useState(5);
  const ctxRef = useRef(null);

  const videoRef = useRef(null);
  const mediaRecorderRef = useRef(null);
  const [isCameraOn, setIsCameraOn] = useState(false);
  const [isRecording, setIsRecording] = useState(false);
  const [recordedChunks, setRecordedChunks] = useState([]);
  const [timer, setTimer] = useState(0);

  useEffect(() => {
    const canvas = canvasRef.current;
    const context = canvas.getContext("2d");
    ctxRef.current = context;

    context.lineWidth = brushSize;
    context.lineCap = "round";
    context.strokeStyle = selectedColor;
  }, []);

  useEffect(() => {
    if (level.image) {
      const backgroundCanvas = backgroundCanvasRef.current;
      const backgroundCtx = backgroundCanvas.getContext("2d");
      const img = new Image();
      img.src = level.image;
      img.onload = () => {
        backgroundCtx.clearRect(0, 0, backgroundCanvas.width, backgroundCanvas.height);
        backgroundCtx.globalAlpha = 0.5;
        backgroundCtx.drawImage(img, 0, 0, backgroundCanvas.width, backgroundCanvas.height);
      };
    }
  }, [level]);

  const startDrawing = (e) => {
    setIsDrawing(true);
    const { offsetX, offsetY } = e.nativeEvent;
    ctxRef.current.beginPath();
    ctxRef.current.moveTo(offsetX, offsetY);
  };

  const draw = (e) => {
    if (!isDrawing) return;
    const { offsetX, offsetY } = e.nativeEvent;
    ctxRef.current.lineTo(offsetX, offsetY);
    ctxRef.current.stroke();
  };

  const stopDrawing = () => {
    setIsDrawing(false);
    ctxRef.current.closePath();
  };

  const changeColor = (color) => {
    setSelectedColor(color);
    ctxRef.current.strokeStyle = color;
  };

  const changeBrushSize = (e) => {
    setBrushSize(e.target.value);
    ctxRef.current.lineWidth = e.target.value;
  };

  const toggleCamera = async () => {
    if (isCameraOn) {
      let stream = videoRef.current.srcObject;
      let tracks = stream.getTracks();
      tracks.forEach((track) => track.stop());
      videoRef.current.srcObject = null;
    } else {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        videoRef.current.srcObject = stream;
      } catch (error) {
        console.error("Error accessing camera:", error);
      }
    }
    setIsCameraOn(!isCameraOn);
  };

  const startRecording = () => {
    if (videoRef.current.srcObject) {
      setIsRecording(true);
      setTimer(0);
      setRecordedChunks([]);
      const stream = videoRef.current.srcObject;
      const mediaRecorder = new MediaRecorder(stream);
      mediaRecorderRef.current = mediaRecorder;

      mediaRecorder.ondataavailable = (event) => {
        if (event.data.size > 0) {
          setRecordedChunks((prev) => [...prev, event.data]);
        }
      };

      mediaRecorder.start();
      const interval = setInterval(() => {
        setTimer((prev) => prev + 1);
      }, 1000);

      mediaRecorder.onstop = () => {
        clearInterval(interval);
      };
    }
  };

  const stopRecording = () => {
    if (mediaRecorderRef.current) {
      mediaRecorderRef.current.stop();
      setIsRecording(false);
    }
  };

  const sendVideo = async () => {
    if (recordedChunks.length === 0) {
      alert("No recorded video to send.");
      return;
    }

    console.log("Hii")

    const blob = new Blob(recordedChunks, { type: "video/mp4" });
    const formData = new FormData();
    formData.append("video", blob, "recorded-video.mp4");

    try {
      const response = await axios.post(env.ML_URL + "/predict-colors", formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      
      const predictedColors = response.data.predicted_colors;
      const colorFrequency = {};

      predictedColors.forEach(color => {
        colorFrequency[color] = (colorFrequency[color] || 0) + 1;
      });

      const majorColor = Object.keys(colorFrequency).reduce((a, b) => 
        colorFrequency[a] >= colorFrequency[b] ? a : b
      );

      setSelectedColor(majorColor);
      changeColor(majorColor)
    } catch (error) {
      console.error("Error sending video:", error);
    }
  };


  const colors = ["pink", "orange", "black", "blue", "green", "purple", "red", "yellow", "white", "brown", "gray", "beige", "cyan"];

  return (
    <div style={{ display: "flex", width: "100%", gap: "20px", backgroundColor: '#00b894', borderRadius: '20px', padding: '10px' }}>
      {/* Canvas Section (2/3 width) */}
      <div style={{ flex: 2 }}>
        <h5>{level.title}</h5>
        <p>{level.description}</p>
        <div>
          <strong>Guide:</strong> Draw on the <span style={{ color: level.guide.color }}>{level.guide.part}</span>.
        </div>

        {/* Color Palette */}
        <div style={{ display: "flex", flexDirection: "column", alignItems: "center", gap: "10px" }}>
  

          {/* Rectangle Color Boxes */}
          <div style={{ display: "flex", gap: "10px", flexWrap: "wrap", justifyContent: "start" }}>
            {colors.map((color) => (
              <div
                key={color}
                onClick={() => changeColor(color)}
                style={{
                  backgroundColor: color,
                  width: 60,
                  height: 30,
                  borderRadius: "5px",
                  border: selectedColor === color ? "3px solid #000" : "1px solid #ddd",
                  cursor: "pointer",
                }}
              />
            ))}
          </div>
        </div>


        {/* Brush Size */}
        <div>
          <label>Brush Size: </label>
          <input type="range" min="1" max="20" value={brushSize} onChange={changeBrushSize} />
          <span> {brushSize}px</span>
        </div>

        {/* Canvas */}
        <div style={{ position: "relative", width: "100%", height: 400 }}>
          <canvas ref={backgroundCanvasRef} width={600} height={400} style={{ position: "absolute", zIndex: 0 }} />
          <canvas ref={canvasRef} width={600} height={400} style={{ position: "absolute", border: "1px solid #ddd", zIndex: 1 }} onMouseDown={startDrawing} onMouseMove={draw} onMouseUp={stopDrawing} onMouseLeave={stopDrawing} />
        </div>
      </div>

      {/* Camera Section (1/3 width) */}
      <div style={{ flex: 1, display: "flex", flexDirection: "column", gap: "10px", backgroundColor: '#00cec9', padding: '5px' }}>
        <video ref={videoRef} width="100%" height="auto" autoPlay muted style={{ display: isCameraOn ? "block" : "none" }} />

        <button onClick={toggleCamera} style={{ padding: "10px", display: "flex", alignItems: "center", gap: "5px" }}>
          <FaCamera /> {isCameraOn ? "Turn Off Camera" : "Turn On Camera"}
        </button>

        {isCameraOn && (
          <>
            <button onClick={isRecording ? stopRecording : startRecording} style={{ padding: "10px", display: "flex", alignItems: "center", gap: "5px" }}>
              {isRecording ? <FaStop /> : <FaVideo />} {isRecording ? `Stop Recording (${timer}s)` : "Start Recording"}
            </button>

            <button onClick={sendVideo} disabled={!recordedChunks.length} style={{ padding: "10px", display: "flex", alignItems: "center", gap: "5px" }}>
              <FaPaperPlane /> Send Video
            </button>
          </>
        )}
      </div>
    </div>
  );
}

export default PaintCanvas;
