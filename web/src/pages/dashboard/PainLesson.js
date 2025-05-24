import React, { useState } from 'react';
import { Card, Col, Row } from 'react-bootstrap';
import DashboardNavigation from '../../components/nav/DashNavigation';
import SideNavBar from '../../components/side-nav/SIdeNav';
import ContentContainer from './ContentContainer';
import PaintCanvas from '../../components/paint_canvas/PainCanvas';

function PaintLesson() {
  const [selectedLevel, setSelectedLevel] = useState(null);

  const levels = [
    {
      title: 'Level 1: Tree Shape',
      description: 'Draw basic shapes and fill them with colors.',
      image: 'https://static.vecteezy.com/system/resources/previews/009/515/360/non_2x/the-outline-of-the-tree-is-black-free-vector.jpg',
      guide: { part: 'circle', color: 'red' },
    },
    {
      title: 'Level 2: Color Mixing',
      description: 'Learn to mix colors and apply gradients.',
      image: 'https://static.vecteezy.com/system/resources/previews/008/895/343/non_2x/outline-side-view-car-icon-isolated-on-white-background-free-vector.jpg',
      guide: { part: 'background', color: 'blue' },
    },
    {
      title: 'Level 3: Object Shading',
      description: 'Practice shading techniques on objects.',
      image: 'https://example.com/level3.png',
      guide: { part: 'shading', color: 'green' },
    },
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
                  <Card.Title>Levels</Card.Title>
                  {levels.map((level, index) => (
                    <div
                      key={index}
                      className={`lesson-item my-3 p-2 border rounded ${selectedLevel?.title === level.title ? 'selected' : ''}`}
                      onClick={() => setSelectedLevel(level)}
                      style={{ cursor: 'pointer' }}
                    >
                      <h6>{level.title}</h6>
                      <p>{level.description}</p>
                    </div>
                  ))}
                </Card.Body>
              </Card>
            </Col>
            <Col lg={8}>
              <Card className="shadow custom-table">
                <Card.Body>
                  {selectedLevel ? (
                    <PaintCanvas key={selectedLevel.title} level={selectedLevel} />
                  ) : (
                    <p>Please select a level to start painting.</p>
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

export default PaintLesson;
