import React, { useEffect, useRef, useState } from "react";

function PaintCanvas2({ level }) {
  const canvasRef = useRef(null);
  const backgroundCanvasRef = useRef(null);
  const [isDrawing, setIsDrawing] = useState(false);
  const [selectedColor, setSelectedColor] = useState("black");
  const [brushSize, setBrushSize] = useState(5);
  const ctxRef = useRef(null);

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
        backgroundCtx.drawImage(img, 0, 0, backgroundCanvas.width, backgroundCanvas.height);
      };
    }
  }, [level]);

  const startDrawing = (e) => {
    setIsDrawing(true);
    const { offsetX, offsetY } = e.nativeEvent;
    
    // Get the canvas position relative to the window
    const canvas = canvasRef.current;
    const rect = canvas.getBoundingClientRect(); // Get the bounding rect of the canvas
    const x = e.clientX - rect.left; // Correct the offset based on the canvas position
    const y = e.clientY - rect.left; // Correct the offset based on the canvas position
    
    ctxRef.current.beginPath();
    ctxRef.current.moveTo(x, y);
  };
  
  const draw = (e) => {
    if (!isDrawing) return;
    
    const canvas = canvasRef.current;
    const rect = canvas.getBoundingClientRect(); // Get the bounding rect of the canvas
    const x = e.clientX - rect.left; // Correct the offset based on the canvas position
    const y = e.clientY - rect.top; // Correct the offset based on the canvas position
    
    ctxRef.current.lineTo(x, y);
    ctxRef.current.stroke();
  };

  const stopDrawing = () => {
    setIsDrawing(false);
    ctxRef.current.closePath();
  };

  return (
    <div style={{
      display: "flex",
      width: "100%",
      height: "100vh",
      gap: "20px",
      backgroundColor: "#00b894",
      borderRadius: "20px",
      padding: "10px",
    }}>
      {/* Main Drawing Area (70%) */}
      <div style={{ flex: 7, position: "relative", height: "100%" }}>
        <canvas ref={backgroundCanvasRef} width={600} height={400}
          style={{ position: "absolute", zIndex: 0, width: "100%", height: "100%" }} 
        />
        <canvas ref={canvasRef} width={600} height={400}
          style={{ position: "absolute", border: "1px solid #ddd", zIndex: 1, }}
          onMouseDown={startDrawing}
          onMouseMove={draw}
          onMouseUp={stopDrawing}
          onMouseLeave={stopDrawing}
        />
      </div>

      {/* Guide Section (30%) */}
      <div style={{
        flex: 3,
        display: "flex",
        flexDirection: "column",
        gap: "10px",
        backgroundColor: "#00cec9",
        padding: "5px",
        height: "100%",
        overflowY: "auto",
      }}>
        {/* Preview Window */}
        <div style={{ flex: 1, backgroundColor: "white", padding: "10px", borderRadius: "10px", textAlign: "center" }}>
          <img src={level.previewImage} alt="Guide" style={{ maxWidth: "100%", maxHeight: "100%", borderRadius: "5px", objectFit: "contain" }} />
        </div>

        {/* Guide Text */}
        <div style={{ flex: 2, overflowY: "auto" }}>
          <h5>{level.title}</h5>
          <p>{level.description}</p>
          <div>
            <strong>Guide:</strong> Draw on the <span style={{ color: level.guide.color }}>{level.guide.part}</span>.
          </div>
        </div>

        {/* Navigation Buttons */}
        <div style={{ display: "flex", justifyContent: "space-between", padding: "10px" }}>
          <button>Previous</button>
          <button>Next</button>
        </div>
      </div>
    </div>
  );
}

export default PaintCanvas2;
