import React from 'react';
import Navigation from '../components/nav/Navigation';
import Footer from '../components/footer/Footer';
import HeroContainer from '../components/hero/Hero';
import { Container, Row, Col, Card } from 'react-bootstrap';

function AboutUs() {
  return (
    <>
      <Navigation />
      <div className='main-container'>
        <HeroContainer />
        <Container fluid className='p-10'>
          <Row>
            <Col>
              <Card>
                <Card.Body>
                  <h2>About Us</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus auctor auctor massa, ac rutrum arcu posuere at. Integer nec lectus justo. Sed sit amet arcu magna. Donec fermentum sem vitae justo malesuada, ut tincidunt dolor convallis. Curabitur et enim et leo commodo volutpat ac sit amet velit.</p>
                </Card.Body>
              </Card>
            </Col>
          </Row>
        </Container>
      </div>
      <Footer />
    </>
  );
}

export default AboutUs;
