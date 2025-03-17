import React, { useState, useRef, useEffect } from 'react';
import { Canvas } from 'react-three-fiber';
import { Sky } from 'drei';
import { Vector3 } from 'three';
import { Physics } from 'use-cannon';
import { Ground } from './Ground';
import { Camera } from './Camera';
import { Player } from './Player';
import { Cube, useCubeStore } from './Cube';
import { FaMouse, FaArrowUp, FaArrowDown, FaArrowLeft, FaArrowRight, FaTimes, FaPlay } from 'react-icons/fa';
import { IoMdExit } from 'react-icons/io';

function PointerLock() {
  const controls = useRef();

  useEffect(() => {
    const handleClick = () => {
      if (controls.current) {
        controls.current.requestPointerLock();
      }
    };

    document.addEventListener("click", handleClick);

    return () => {
      document.removeEventListener("click", handleClick);
    };
  }, []);

  return null; // Component does not render anything, just handles pointer lock logic
}

function App() {
  const [isGameStarted, setIsGameStarted] = useState(false);
  const cubes = useCubeStore(state => state.cubes);

  const startGame = () => setIsGameStarted(true);
  const goToMenu = () => setIsGameStarted(false);
  const exitGame = () => {
    if (window.confirm("Are you sure you want to exit the game?")) {
      window.close();
    }
  };

  return (
    <>
      {!isGameStarted && (
        <div style={{
          position: 'absolute',
          top: 0,
          left: 0,
          width: '100%',
          height: '100%',
          background: 'rgba(0, 0, 0, 0.9)',
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
          justifyContent: 'center',
          color: 'white',
          zIndex: 10,
          textAlign: 'center'
        }}>
          <h1>Welcome to the Game</h1>
          
          {/* Game Instructions */}
          <div style={{
            background: 'rgba(255, 255, 255, 0.1)',
            padding: '15px',
            borderRadius: '10px',
            marginBottom: '20px',
            width: '60%'
          }}>
            <h2>How to Play</h2>
            <p><FaMouse /> Use <b>Mouse</b> to move the camera</p>
            <p>
              <FaArrowUp /> <FaArrowDown /> <FaArrowLeft /> <FaArrowRight /> Use <b>Arrow Keys</b> to move
            </p>
            <p><FaTimes /> Press <b>ESC</b> to exit camera lock</p>
          </div>

          {/* Start & Exit Buttons */}
          <button 
            onClick={startGame} 
            style={{
              padding: '10px 20px',
              fontSize: '18px',
              margin: '10px',
              cursor: 'pointer',
              display: 'flex',
              alignItems: 'center',
              gap: '10px',
            }}>
            <FaPlay /> Start Game
          </button>
          <button 
            onClick={exitGame} 
            style={{
              padding: '10px 20px',
              fontSize: '18px',
              margin: '10px',
              cursor: 'pointer',
              background: 'red',
              color: 'white',
              display: 'flex',
              alignItems: 'center',
              gap: '10px',
            }}>
            <IoMdExit /> Exit Game
          </button>
        </div>
      )}

      {isGameStarted && (
        <>
        <button 
            onClick={exitGame} 
            style={{
              position: 'absolute',
              top: '10px',
              right: '10px',
              padding: '10px',
              fontSize: '18px',
              background: 'rgba(255, 0, 0, 0.8)',
              color: 'white',
              border: 'none',
              borderRadius: '5px',
              cursor: 'pointer',
              zIndex: 10,
              display: 'flex',
              alignItems: 'center',
              gap: '8px'
            }}>
            <FaTimes /> Back to Menu
        </button>
        <Canvas shadowMap sRGB gl={{ alpha: false }}>
          <Camera />
          <Sky sunPosition={new Vector3(100, 10, 100)}/>
          <ambientLight intensity={0.3}/>
          <pointLight 
            castShadow
            intensity={0.8}
            position={[100, 100, 100]}
          />
          <Physics gravity={[0, -30, 0]}>
            <Ground />
            <Player />
            <Cube position={[0, 0.5, -10]} />
            {
              cubes.map(cube => cube)
            }
          </Physics>
        </Canvas>
        </>
      )}
    </>
  );
}

export default App;
