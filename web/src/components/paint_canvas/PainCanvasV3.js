import React, { useEffect, useRef, useState } from "react";
import { FaVideo, FaStop, FaPaperPlane, FaCamera, FaPaintBrush, FaPlus, FaEraser } from "react-icons/fa";
import env from "../../data/env";
import axios from "axios";

function PaintCanvasV3({ level }) {
  const canvasRef = useRef(null);
  const backgroundCanvasRef = useRef(null);
  const [isDrawing, setIsDrawing] = useState(false);
  const [selectedColor, setSelectedColor] = useState("black");
  const [brushSize, setBrushSize] = useState(5);
  const [showColorPalette, setShowColorPalette] = useState(false);
  const [showBrushSize, setShowBrushSize] = useState(false);
  const [isEraserActive, setIsEraserActive] = useState(false)
  const [currentGuideIndex, setCurrentGuideIndex] = useState(0)
  const ctxRef = useRef(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    const context = canvas.getContext("2d");
    ctxRef.current = context;

    context.lineWidth = brushSize;
    context.lineCap = "round";
    context.strokeStyle = selectedColor;
  }, [brushSize, selectedColor]);

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

  const changeBrushSize = (size) => {
    setBrushSize(size);
    ctxRef.current.lineWidth = size;
  };

  const toggleColorPalette = () => {
    setShowBrushSize(false)
    setShowColorPalette((prev) => !prev);
  };

  const toggleBrushSize = () => {
    setShowColorPalette(false)
    setShowBrushSize((prev) => !prev);
  };

  const activateEraser = () => {
    setIsEraserActive((prev) => !prev);
    if (isEraserActive) {
      ctxRef.current.strokeStyle = selectedColor; // Restore the selected color if eraser is deactivated
    } else {
      ctxRef.current.strokeStyle = "#00b894"; // Set to background color when eraser is active
    }
  };

  const handlePrevious = () => {
    if (currentGuideIndex > 0) {
      setCurrentGuideIndex(currentGuideIndex - 1);
    }
  };

  const handleNext = () => {
    if (currentGuideIndex < level.guide.length - 1) {
      setCurrentGuideIndex(currentGuideIndex + 1);
    }
  };

  const colors = [
    "pink", "orange", "black", "blue", "green", "purple", "red", "yellow", "white", "brown", "gray", "beige", "cyan"
  ];
  const brushSizes = [5, 10, 15, 20, 25];

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
      {/* Canvas Section (2/3 width) */}
      <div style={{ flex: 7, position: "relative", height: "100%" }}>

        {/* Canvas */}
        <div style={{ position: "relative", width: "100%", height: '100%' }}>
          <canvas ref={backgroundCanvasRef} width={600} height={600} style={{ position: "absolute", zIndex: 0, width: "100%", height: "100%" }} />
          <canvas ref={canvasRef} width={600} height={600} style={{ position: "absolute", border: "1px solid #ddd", zIndex: 1 }} onMouseDown={startDrawing} onMouseMove={draw} onMouseUp={stopDrawing} onMouseLeave={stopDrawing} />
        </div>
      </div>

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
          <img src={process.env.PUBLIC_URL + level.guide[currentGuideIndex]?.resource} alt="Guide" style={{ maxWidth: "100%", maxHeight: "100%", borderRadius: "5px", objectFit: "contain" }} />
        </div>

        {/* {process.env.PUBLIC_URL + sign.gif} */}

        {/* Guide Text */}
        <div style={{ flex: 2, overflowY: "auto" }}>
          {/* <h5>{level.title}</h5> */}
          {/* <p>{level.description}</p> */}
          <div>
          <div>{level.guide[currentGuideIndex]?.guideText}</div>
          </div>
        </div>

        <div style={{ display: "flex", justifyContent: "space-between", padding: "10px" }}>
          <button
            onClick={handlePrevious}
            disabled={currentGuideIndex === 0}
            style={{
              padding: "10px 20px",
              fontSize: "16px",
              backgroundColor: currentGuideIndex === 0 ? "#b2bec3" : "#0984e3",
              color: "white",
              border: "none",
              borderRadius: "5px",
              cursor: currentGuideIndex === 0 ? "not-allowed" : "pointer",
              transition: "background 0.3s ease",
            }}
          >
            Previous
          </button>

          <button
            onClick={handleNext}
            disabled={currentGuideIndex === level.guide.length - 1}
            style={{
              padding: "10px 20px",
              fontSize: "16px",
              backgroundColor: currentGuideIndex === level.guide.length - 1 ? "#b2bec3" : "#00b894",
              color: "white",
              border: "none",
              borderRadius: "5px",
              cursor: currentGuideIndex === level.guide.length - 1 ? "not-allowed" : "pointer",
              transition: "background 0.3s ease",
            }}
          >
            Next
          </button>
        </div>


        <div style={{ display: "flex", flexDirection: "column", alignItems: "center", gap: "10px" }}>

          {/* Columns of Icon Boxes */}
          <div style={{ display: "flex", flexDirection: "column", gap: "15px", alignItems: "center" }}>
            
            {/* Color Palette Icon Box */}
            <div
              onClick={toggleColorPalette}
              style={{
                backgroundColor: "#ddd",
                width: 80,
                height: 80,
                borderRadius: "10px",
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                cursor: "pointer",
                textAlign: "center",
                flexDirection: "column",
              }}
            >
              <FaPaintBrush size={30} />
              <span style={{ fontSize: "12px" }}>Colors</span>
            </div>

            {/* Show Color Palette */}
            {showColorPalette && (
            <div style={{
              position: "absolute",
              zIndex: '999',
              top: '300px',
              right: '200px',
              borderRadius: "10px",
              padding: "10px",
              backgroundColor: "#fff",
              boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)",
              marginTop: "10px",
              width: "auto",
            }}>
              <div style={{
                display: "flex",
                gap: "10px",
                flexWrap: "wrap",
                justifyContent: "start",
                marginLeft: "10px",
              }}>
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
          )}

            {/* Other Icon Blocks */}
            <div onClick={toggleBrushSize} style={{
              backgroundColor: "#ddd",
              width: 80,
              height: 80,
              borderRadius: "10px",
              display: "flex",
              justifyContent: "center",
              alignItems: "center",
              cursor: "pointer",
              textAlign: "center",
              flexDirection: "column",
            }}>
              <FaPlus size={30} />
              <span style={{ fontSize: "12px" }}>Brush Size</span>
            </div>

            {showBrushSize && (
              <div style={{
                position: "absolute",
                zIndex: '999',
                top: '300px',
                right: '200px',
                borderRadius: "10px",
                padding: "10px",
                backgroundColor: "#fff",
                boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)",
                marginTop: "10px",
                width: "auto",
              }}>
                <div style={{
                  display: "flex",
                  flexDirection: "column",
                  gap: "10px",
                  marginLeft: "10px",
                }}>
                  {brushSizes.map((size) => (
                    <button
                      key={size}
                      onClick={() => changeBrushSize(size)}
                      style={{
                        padding: "5px 10px",
                        backgroundColor: "#ddd",
                        borderRadius: "5px",
                        cursor: "pointer",
                        border: brushSize === size ? "2px solid #000" : "1px solid #ddd",
                      }}
                    >
                      {size}px
                    </button>
                  ))}
                </div>
              </div>
            )}
            <div onClick={activateEraser} style={{
              backgroundColor: "#ddd",
              width: 80,
              height: 80,
              borderRadius: "10px",
              display: "flex",
              justifyContent: "center",
              alignItems: "center",
              cursor: "pointer",
              textAlign: "center",
              flexDirection: "column",
            }}>
              <FaEraser size={30} />
              <span style={{ fontSize: "12px" }}>Eraser</span>
            </div>
            <div style={{
              backgroundColor: "#ddd",
              width: 80,
              height: 80,
              borderRadius: "10px",
              display: "flex",
              justifyContent: "center",
              alignItems: "center",
              cursor: "pointer",
              textAlign: "center",
              flexDirection: "column",
            }}>
              <FaPaperPlane size={30} />
              <span style={{ fontSize: "12px" }}>Send</span>
            </div>
          </div>
        </div>

        {/* Navigation Buttons */}
        
      </div>
    </div>
  );
}

export default PaintCanvasV3;
