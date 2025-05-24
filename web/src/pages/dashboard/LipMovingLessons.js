import React, { useState } from 'react';
import { Card, Col, Row } from 'react-bootstrap';
import ContentContainer from './ContentContainer';
import DashboardNavigation from '../../components/nav/DashNavigation';
import SideNavBar from '../../components/side-nav/SIdeNav';
import LipReading from '../../components/face_emotion/LipReading';

function LipMovingLessons() {
  const [selectedLesson, setSelectedLesson] = useState(null);

  const lessons = [
    {
      title: 'Lesson 1: Basic Lip Movements',
      content: 'Learn the basic movements of lips when forming sounds.',
      videoId: 'videos/sample1.mp4',
    },
    {
      title: 'Lesson 2: Pronouncing Vowels',
      content: 'Understand how lips move when pronouncing vowels.',
      videoId: 'videos/sample2.mp4',
    },
    {
      title: 'Lesson 3: Greetings',
      content: 'Practice lip movements for common consonant sounds.',
      videoId: 'videos/sample3.mp4',
    }
  ];

  return (
    <>
      <SideNavBar onToggle={() => {}} />
      <ContentContainer
        isExpanded={false}
      >
        <DashboardNavigation />
        <div className="fluid-container custom mt-4">
          <Row>
            <Col lg={4}>
              <Card className="shadow custom-table">
                <Card.Body>
                  <Card.Title>Lessons</Card.Title>
                  {lessons.map((lesson, index) => (
                    <div
                      key={index}
                      className={`lesson-item my-3 p-2 border rounded ${selectedLesson?.title === lesson.title ? 'selected' : ''}`}
                      onClick={() => setSelectedLesson(lesson)}
                      style={{ cursor: 'pointer' }}
                    >
                      <h6>{lesson.title}</h6>
                      <p>{lesson.content}</p>
                    </div>
                  ))}
                </Card.Body>
              </Card>
            </Col>
            <Col lg={8}>
              <Card className="shadow custom-table">
                <Card.Body>
                  {selectedLesson ? (
                    <LipReading key={selectedLesson.title} selectedLesson={selectedLesson} />
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

export default LipMovingLessons;
