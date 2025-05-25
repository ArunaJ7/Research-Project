import React from 'react';
import { Container, Row, Col, Button } from 'react-bootstrap';
import { Link, useNavigate } from 'react-router-dom';
import Navigation from '../components/nav/Navigation';

const FAQContainer = () => {
  const navigate = useNavigate();

  return (
    <>
      <Navigation />
      <div className='main-container'>
        <div className="hero-container">
          <Container fluid>
            <Row className="align-items-center">
              <Col className="text-center custom-frame">
                <h1>Frequently Asked Questions</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  lorem, eget consectetur felis accumsan a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan euismod lorem, eget consectetur felis accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam accumsan euismod lorem, eget consectetur felis accumsan a.</p>
                <div className="button-group">
                  <Link to={'/faq-details'}><button className="custom-button light mr-3">View FAQ Details</button></Link>
                  <Link to={'/sign-in'}><button className="custom-button primary">Get Started</button></Link>
                </div>
              </Col>
            </Row>
            
          </Container>
        </div>
      </div>
    </>
  );
};

export default FAQContainer;
