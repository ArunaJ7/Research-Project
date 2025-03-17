import React, { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';

const SnakeGame = () => {
  const navigate = useNavigate();
  const canvasRef = useRef(null);
  const [snake, setSnake] = useState([{ x: 10, y: 10 }]);
  const [food, setFood] = useState({ x: 15, y: 15 });
  const [direction, setDirection] = useState({ x: 0, y: -1 });
  const [score, setScore] = useState(0);
  const [time, setTime] = useState(0);
  const [gameOver, setGameOver] = useState(false);

  const canvasSize = 400;
  const cellSize = 20;

  // Game loop timing
  useEffect(() => {
    const interval = setInterval(() => {
      if (!gameOver) moveSnake();
    }, 200);

    const timer = setInterval(() => {
      if (!gameOver) setTime((prevTime) => prevTime + 1);
    }, 1000);

    return () => {
      clearInterval(interval);
      clearInterval(timer);
    };
  }, [snake, direction, gameOver]);

  // Handle arrow key input
  useEffect(() => {
    const handleKeyDown = (e) => {
      switch (e.key) {
        case 'ArrowUp':
          if (direction.y !== 1) setDirection({ x: 0, y: -1 });
          break;
        case 'ArrowDown':
          if (direction.y !== -1) setDirection({ x: 0, y: 1 });
          break;
        case 'ArrowLeft':
          if (direction.x !== 1) setDirection({ x: -1, y: 0 });
          break;
        case 'ArrowRight':
          if (direction.x !== -1) setDirection({ x: 1, y: 0 });
          break;
        default:
          break;
      }
    };

    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [direction]);

  const moveSnake = () => {
    const newSnake = [...snake];
    const head = { ...newSnake[newSnake.length - 1] };

    // Update head position
    head.x += direction.x;
    head.y += direction.y;

    // Check for collisions with walls
    if (head.x < 0 || head.y < 0 || head.x >= canvasSize / cellSize || head.y >= canvasSize / cellSize) {
      setGameOver(true);
      return;
    }

    // Check for collisions with itself
    if (newSnake.some((segment) => segment.x === head.x && segment.y === head.y)) {
      setGameOver(true);
      return;
    }

    // Check for food collision
    if (head.x === food.x && head.y === food.y) {
      setScore((prevScore) => prevScore + 1);
      setFood({
        x: Math.floor(Math.random() * (canvasSize / cellSize)),
        y: Math.floor(Math.random() * (canvasSize / cellSize)),
      });
    } else {
      newSnake.shift(); // Remove tail if no food eaten
    }

    newSnake.push(head);
    setSnake(newSnake);
  };

  const drawGame = () => {
    const ctx = canvasRef.current.getContext('2d');

    // Clear canvas
    ctx.fillStyle = 'black';
    ctx.fillRect(0, 0, canvasSize, canvasSize);

    // Draw food
    ctx.fillStyle = 'red';
    ctx.fillRect(food.x * cellSize, food.y * cellSize, cellSize, cellSize);

    // Draw snake
    ctx.fillStyle = 'green';
    snake.forEach((segment) => {
      ctx.fillRect(segment.x * cellSize, segment.y * cellSize, cellSize, cellSize);
    });
  };

  useEffect(() => {
    if (canvasRef.current) drawGame();
  }, [snake, food]);

  return (
    <div
      style={{
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        height: '100vh',
        backgroundColor: '#222',
      }}
    >
      <div
        style={{
          position: 'absolute',
          top: 20,
          left: 20,
          color: 'white',
          fontSize: '18px',
        }}
      >
        <p>Score: {score}</p>
        <p>Time: {time}s</p>
        <button
          onClick={() => navigate(-1)}
          style={{
            marginTop: 10,
            padding: '5px 10px',
            backgroundColor: '#f00',
            color: 'white',
            border: 'none',
            borderRadius: '4px',
            cursor: 'pointer',
          }}
        >
          Exit
        </button>
      </div>
      <canvas
        ref={canvasRef}
        width={canvasSize}
        height={canvasSize}
        style={{
          border: '2px solid white',
          backgroundColor: '#000',
        }}
      />
      {gameOver && (
        <div
          style={{
            position: 'absolute',
            top: '50%',
            transform: 'translateY(-50%)',
            textAlign: 'center',
            color: 'white',
          }}
        >
          <h1>Game Over!</h1>
          <p>Final Score: {score}</p>
          <button
            onClick={() => {
              setGameOver(false);
              setSnake([{ x: 10, y: 10 }]);
              setDirection({ x: 0, y: -1 });
              setScore(0);
              setTime(0);
              setFood({ x: 15, y: 15 });
            }}
            style={{
              padding: '10px 20px',
              backgroundColor: '#0f0',
              color: 'black',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer',
            }}
          >
            Restart
          </button>
        </div>
      )}
    </div>
  );
};

export default SnakeGame;
