import React from 'react';
import { Container, Row, Col, Button } from 'react-bootstrap';
import { Link, useNavigate } from 'react-router-dom';
import Navigation from '../components/nav/Navigation';

const StudyTipsContainer = () => {
  // You can use the useNavigate hook to navigate to other routes
  const navigate = useNavigate();

  return (
    <>
    <Navigation />
    <div className='main-container'>
        <div className="hero-container">
        <Container fluid>
            <Row className="align-items-center"> {/* Vertically center content */}
            <Col className="text-center custom-frame">
                <h1>Study Tips</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan euismod lorem, eget consectetur felis accumsan a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan euismod lorem, eget consectetur felis accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan euismod lorem, eget consectetur felis accumsan a.</p>
                <div className="button-group">
                {/* Example button */}
                <button className="custom-button light mr-3" onClick={() => {
                    navigate('/study-tips-details'); // Example navigation to a study tips details page
                }}>View Study Tips Details</button>
                {/* Example button */}
                <Link to={'/sign-in'}><button className="custom-button primary">Get Started</button></Link>
                </div>
                <br/>
                {/* Example image */}
                <div className='image-container'>
                <img src={process.env.PUBLIC_URL+'/images/bg.png'} alt='study tips background' />
                </div>
            </Col>
            </Row>
        </Container>
        </div>
    </div>
    </>
    
  );
};

export default StudyTipsContainer;
