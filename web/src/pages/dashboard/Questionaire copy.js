import React, { useEffect, useState } from 'react';
import { Button, Card, Col, Form, Modal, Row } from 'react-bootstrap';
import SideNavBar from '../../components/side-nav/SIdeNav';
import ContentContainer from './ContentContainer';
import DashboardNavigation from '../../components/nav/DashNavigation';
import { FaPlus } from 'react-icons/fa';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

function Questionaire() {
  const [selectedList, setSelectedList] = useState(null);
  const [predictions, setPredictions] = useState({});
  const [correctAnswers, setCorrectAnswers] = useState({});
  const [showBoredModal, setShowBoredModal] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    const timer = setTimeout(() => setShowBoredModal(true), 60000); // Trigger modal after 1 minute
    return () => clearTimeout(timer); // Cleanup on unmount
  }, []);

  const questionLists = [
    {
      title: 'Beginner Level',
      description: 'Simple addition and subtraction.',
      questions: [
        { id: 1, question: 'What is 2 + 2?', answer: 4 },
        { id: 2, question: 'What is 3 - 1?', answer: 2 },
        { id: 3, question: 'What is 1 + 1?', answer: 2 },
        { id: 4, question: 'What is 4 - 2?', answer: 2 },
        { id: 5, question: 'What is 5 - 3?', answer: 2 },
      ],
    },
    {
      title: 'Intermediate Level',
      description: 'Mixed operations with small numbers.',
      questions: [
        { id: 1, question: 'What is 3 * 2?', answer: 6 },
        { id: 2, question: 'What is 12 / 4?', answer: 3 },
        { id: 3, question: 'What is 5 + 7?', answer: 12 },
        { id: 4, question: 'What is 8 - 3?', answer: 5 },
        { id: 5, question: 'What is 6 + 4?', answer: 10 },
      ],
    },
  ];

  const handleFileUpload = async (file, questionId, answer) => {
    const formData = new FormData();
    formData.append('file', file);

    try {
      const response = await axios.post('http://localhost:8000/predict-handsign', formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });

      const predictedClass = parseInt(response.data.predicted_class, 10);
      setPredictions((prev) => ({ ...prev, [questionId]: predictedClass }));
      setCorrectAnswers((prev) => ({
        ...prev,
        [questionId]: predictedClass === answer,
      }));
    } catch (error) {
      console.error('Error during prediction:', error);
    }
  };

  return (
    <>
      <>
        {showBoredModal && (
          <Modal show={showBoredModal} onHide={() => setShowBoredModal(false)} centered>
            <Modal.Header closeButton>
              <Modal.Title>Are You Feeling Bored?</Modal.Title>
            </Modal.Header>
            <Modal.Body>
              <p>If you're feeling bored, we can take you to another screen for some fun activities.</p>
            </Modal.Body>
            <Modal.Footer>
              <Button variant="secondary" onClick={() => setShowBoredModal(false)}>
                No, I'm Fine
              </Button>
              <Button
                variant="primary"
                onClick={() => {
                  setShowBoredModal(false);
                  navigate('/dashboard/snake-game'); 
                }}
              >
                Yes, I'm Bored
              </Button>
            </Modal.Footer>
          </Modal>
        )}
      </>

      <SideNavBar onToggle={() => {}} />
      <ContentContainer
        isExpanded={false}
        children={
          <>
            <DashboardNavigation />
            <div className="fluid-container custom mt-4">
              <Row>
                <Col lg={12}>
                  <Card className="shadow">
                    <Card.Header>
                      <h1>Questionnaire</h1>
                    </Card.Header>
                    <Card.Body>
                      <span>
                        <a href="/">Home</a> / Questionnaire
                      </span>
                    </Card.Body>
                  </Card>
                </Col>
              </Row>
              <div className="row justify-content-center mt-4">
                <div className="col-md-6">
                  <Card className="shadow custom-table">
                    <Card.Body>
                      <Card.Title>Your Study Plans</Card.Title>
                      {questionLists.map((list, index) => (
                        <div
                          key={index}
                          className="d-flex justify-content-between align-items-center my-3"
                          onClick={() => setSelectedList(list)}
                          style={{ cursor: 'pointer' }}
                        >
                          <div>
                            <h5>{list.title}</h5>
                            <p>{list.description}</p>
                          </div>
                          <FaPlus className="text-primary" size={20} />
                        </div>
                      ))}
                    </Card.Body>
                  </Card>
                </div>
                <div className="col-md-6">
                  <Card className="shadow custom-table">
                    <Card.Body>
                      <h5>Activities</h5>
                      {selectedList ? (
                        <div>
                          <h6>Questions for: {selectedList.title}</h6>
                          {selectedList.questions.map((q) => (
                            <div key={q.id} className="mb-4">
                              <p>
                                <strong>Question {q.id}:</strong> {q.question}
                              </p>
                              <Form.Group>
                                <Form.Label>Upload Answer Image</Form.Label>
                                <Form.Control
                                  type="file"
                                  accept="image/*"
                                  className="mb-2"
                                  onChange={(e) => {
                                    const file = e.target.files[0];
                                    if (file) {
                                      handleFileUpload(file, q.id, q.answer);
                                    }
                                  }}
                                />
                              </Form.Group>
                              {predictions[q.id] !== undefined && (
                                <p>
                                  Prediction: {predictions[q.id]} -{' '}
                                  {correctAnswers[q.id] ? (
                                    <span className="text-success">Correct</span>
                                  ) : (
                                    <span className="text-danger">Incorrect</span>
                                  )}
                                </p>
                              )}
                            </div>
                          ))}
                        </div>
                      ) : (
                        <p>Please select a question list to view details.</p>
                      )}
                    </Card.Body>
                  </Card>
                </div>
              </div>
            </div>
          </>
        }
      />
    </>
  );
}

export default Questionaire;
