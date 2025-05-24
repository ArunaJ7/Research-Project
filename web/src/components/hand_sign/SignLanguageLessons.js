import React, { useState } from 'react';
import { Card, Col, Row } from 'react-bootstrap';
import DashboardNavigation from '../../components/nav/DashNavigation';
import SideNavBar from '../../components/side-nav/SIdeNav';
import SignAnswer from './SignAnswer';
import ContentContainer from '../../pages/dashboard/ContentContainer';
import AlphabetLearningFlow from './AlphabelLearningFlow';

function SignLanguageLessons() {
  const [selectedLesson, setSelectedLesson] = useState(null);

  const lessons = [
    { title: 'කන්න', videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', images: [process.env.PUBLIC_URL + "/materials/Aa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"] },
    { title: 'රට', videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"] },
    { title: 'කට', videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', images: [process.env.PUBLIC_URL + "/materials/Ae.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"] },
  ];

  return (
    <>
      <SideNavBar onToggle={() => {}} />
      <ContentContainer isExpanded={false}>
        <DashboardNavigation />
        <div className="fluid-container custom mt-4">
          <Row>
            <Col lg={4}>
              <Card className="shadow custom-table">
                <Card.Body>
                  <Card.Title>Sign Language Lessons</Card.Title>
                  {lessons.map((lesson, index) => (
                    <div
                      key={index}
                      className={`lesson-item my-3 p-2 border rounded ${selectedLesson?.title === lesson.title ? 'selected' : ''}`}
                      onClick={() => setSelectedLesson(lesson)}
                      style={{ cursor: 'pointer' }}
                    >
                      <h6>{lesson.title}</h6>
                    </div>
                  ))}
                </Card.Body>
              </Card>
            </Col>
            <Col lg={8}>
              <Card className="shadow custom-table">
                <Card.Body>
                  {selectedLesson ? (
                    <AlphabetLearningFlow selectedLesson={selectedLesson} />
                  ) : (
                    <p>Please select a lesson to view content and video.</p>
                  )}
                </Card.Body>
              </Card>
            </Col>
          </Row>
        </div>
      </ContentContainer>
    </>
  );
}

export default SignLanguageLessons;
