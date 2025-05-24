import React, { useState } from "react";
import { Card, Col, Row } from "react-bootstrap";
import DashboardNavigation from "../../components/nav/DashNavigation";
import SideNavBar from "../../components/side-nav/SIdeNav";
import ContentContainer from "./ContentContainer";
import PaintCanvas from "../../components/paint_canvas/PainCanvas";
import PaintCanvas2 from "../../components/paint_canvas/PaintCanvasV2";
import PaintCanvasV3 from "../../components/paint_canvas/PainCanvasV3";

function PaintLessonV2() {
  const [selectedLevel, setSelectedLevel] = useState(null);

  const levels = [
    {
      title: "Level 1: Tree Shape",
      description: "Draw basic shapes and fill them with colors.",
      image:
        "https://i.pinimg.com/564x/8b/5f/e3/8b5fe306c4feba4be48f27f1fb9b8373.jpg",
      guide: [
        { resource: "/gifs/b.png", guideText: "Use orange brush to pain face" },
        { resource: "/gifs/dontknow.gif", guideText: "Use black brush for eyes" },
      ],
    },
    {
      title: "Level 2: Color Mixing",
      description: "Learn to mix colors and apply gradients.",
      image:
        "https://www.peterpauper.com/cdn/shop/products/9781441332028.PT05_3cd27bd0-268a-403f-a2c6-011e77577a09_720x.png?v=1651239772",
      guide: [
        { resource: "/gifs/dontknow.gif", guideText: "Use pink to color tummy of the monkey" },
        { resource: "/gifs/dontknow.gif", guideText: "Use brown to color body of the monkey." },
        { resource: "/gifs/dontknow.gif", guideText: "Use brown for tree branch." },
        { resource: "/gifs/dontknow.gif", guideText: "Use green for leaves." },
      ],
    },
    {
      title: "Level 3: Object Shading",
      description: "Practice shading techniques on objects.",
      image: "https://st2.depositphotos.com/36775914/47405/i/450/depositphotos_474053760-stock-photo-animals-coloring-book-kids-black.jpg",
      guide: [
        { resource: "/gifs/dontknow.gif", guideText: "Use pink to color tummy of the monkey" },
        { resource: "/gifs/dontknow.gif", guideText: "Use brown to color body of the monkey." },
      ],
    },
    {
      title: "Level 4: Lion",
      description: "Practice shading techniques on objects.",
      image: "https://ibb.co/5gzgBSm6",
      guide: [
        { resource: "Outline the object", guideText: "Draw an outline before shading." },
        { resource: "Apply shading", guideText: "Use different shades to create depth." },
      ],
    },
  ];

  https://files.fm/f/h4vtd2c4nq

  return (
    <>
      <SideNavBar onToggle={() => {}} />
      <ContentContainer isExpanded={false}>
        <DashboardNavigation />
        <div className="fluid-container custom mt-4">
          <Row>
            {/* Levels List */}
            <Col lg={4}>
              <Card className="shadow custom-table">
                <Card.Body>
                  <Card.Title>Levels</Card.Title>
                  {levels.map((level, index) => (
                    <div
                      key={index}
                      className={`lesson-item my-3 p-2 border rounded ${
                        selectedLevel?.title === level.title ? "selected" : ""
                      }`}
                      onClick={() => setSelectedLevel(level)}
                      style={{ cursor: "pointer", display: "flex", alignItems: "center", gap: "10px" }}
                    >
                      {/* Image (30%) */}
                      <div style={{ width: "30%" }}>
                        <img
                          src={level.image}
                          alt={level.title}
                          style={{ width: "100%", borderRadius: "5px" }}
                        />
                      </div>
                      {/* Text Details (70%) */}
                      <div style={{ width: "70%" }}>
                        <h6>{level.title}</h6>
                        <p>{level.description}</p>
                      </div>
                    </div>
                  ))}
                </Card.Body>
              </Card>
            </Col>

            {/* Paint Canvas & Guide Section */}
            <Col lg={8}>
              <Card className="shadow custom-table">
                <Card.Body>
                  {selectedLevel ? (
                    <>
                      <PaintCanvasV3 key={selectedLevel.title} level={selectedLevel} />
                      <div className="mt-3">
                        <h5>Guide</h5>
                        <ul>
                          {selectedLevel.guide.map((step, idx) => (
                            <li key={idx}>
                              <strong>{step.resource}: </strong> {step.guideText}
                            </li>
                          ))}
                        </ul>
                      </div>
                    </>
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

export default PaintLessonV2;
