import React, { useEffect, useState } from 'react';
import { Button, Modal, Form } from 'react-bootstrap'; 
import SideNavBar from '../../components/side-nav/SIdeNav';
import { Breadcrumb, Card, Col, Row } from 'react-bootstrap';
import ContentContainer from './ContentContainer';
import moment from 'moment';
import DashboardNavigation from '../../components/nav/DashNavigation';
import PlansService from '../../services/Plans.service';
import PersonaInfosService from '../../services/PersonaInfos.service';
import env from '../../data/env';
import { Chart as ChartJs, BarElement, LinearScale, CategoryScale, Title, Tooltip, Legend } from 'chart.js';
import { Bar } from 'react-chartjs-2';
import { FaStar, FaTrashAlt } from 'react-icons/fa';
import RevuewsService from '../../services/Revuews.service';
import Notiflix from 'notiflix';
import { Link } from 'react-router-dom';

ChartJs.register(
  BarElement,
  LinearScale,
  CategoryScale,
  Title,
  Tooltip,
  Legend
);

function ProgressTracking() {
  const [isExpanded, setIsExpanded] = useState(false);
  const [plans, setPlans] = useState([]);
  const [personal, setPersonal] = useState(null);
  const [selected, setSelected] = useState(null);
  const [events, setEvents] = useState([]);
  const [mems, setMems] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const [reviewData, setReviewData] = useState({
    total: 0,
    points: 0,
    user: localStorage.getItem('username'),
    subject: '',
    activity: '',
  });

  const toggleModal = () => setShowModal(!showModal);

  const loadReviews = async () => {
    if(selected){
      await RevuewsService.getReviewsBySubject(selected.subject, selected.activity, localStorage.getItem('username')).then((data) => {
        setMems(data);
      });
    }
  };

  const handleReviewSubmit = async () => {
    // Handle review submission
    reviewData.subject = selected.subject;
    reviewData.activity = selected.type;
    await RevuewsService.createReview(reviewData).then((data) => {
      Notiflix.Report.success(
        'Success',
        "Review submitted successfully",
        'Okay',
      );
      // Close the modal
      toggleModal();
    });
  };

  const barChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    datasets: [
      {
        label: 'Progress (%)',
        data: [65, 59, 80, 81, 56, 55],
        backgroundColor: '#36a2eb',
      },
    ],
  };

  const handleSidebarToggle = (isVisible) => {
    setIsExpanded(isVisible);
  };

  const loadPlans = async () => {
    await PlansService.getPlansByUser(localStorage.getItem('username')).then((data) => {
      const loadedEvents = data.flatMap(plan => {
        const activities = plan.activities.map(activity => {
          const method = env.METHODS.find(method => method.type === activity.type);
          return {
            id: activity._id,
            type: activity.type,
            subject: activity.subject,
            start: new Date(activity.startTime),
            end: moment(activity.startTime).add(activity.hours, 'hours').toDate(),
            color: method ? method.color : '#10eb60',
          };
        });
        return activities;
      });
      setEvents(loadedEvents);
    });
  };

  const loadPersonal = async () => {
    await PersonaInfosService.getLatestPersonalInfoByUsername(localStorage.getItem('username')).then((data) => {
      setPersonal(data);
    });
  };

  const getColorByType = (type) => {
    const method = env.METHODS.find(method => method.type === type);
    return method ? method.color : '#FFFFFF'; 
  };

  useEffect(() => {
    loadPlans();
    loadPersonal();
    loadReviews();
  }, []);

  return (
    <>
      <SideNavBar onToggle={handleSidebarToggle}/>
      <ContentContainer isExpanded={isExpanded} children={
        <>
          <DashboardNavigation />
          <div className="fluid-container custom mt-4">
            <Row>
              <Col lg={12}>
                <Card className="shadow">
                  <Card.Header>
                    <h1>Progress Tracking</h1>
                  </Card.Header>
                  <Card.Body>
                    <span><Link to={'/'}>Home</Link> / Progress Tracking</span>
                  </Card.Body>
                </Card>
              </Col>
            </Row>
            <div className="row justify-content-center mt-4">
              <div className="col-md-8">
                <Card className='shadow'>
                  <Card.Body>
                    <Card.Title>Progress Chart</Card.Title>
                    <Row className='custom-row'>
                      <Col className="col-md-4">
                        <div className='chart-container'>
                          <Bar data={barChartData} />
                        </div>
                      </Col>
                    </Row>
                  </Card.Body>
                </Card>
              </div>
              <div className="col-md-4">
                <Card className='shadow'>
                  <Card.Body>
                    <h5>Select Subject</h5>
                    {events.map(activity => (
                      <div key={activity.id} className="activity-container" style={{ backgroundColor: getColorByType(activity.type), cursor: 'pointer' }}
                        onClick={() => {
                          setSelected(activity);
                          setMems([]);
                          loadReviews();
                        }}>
                        <div className='image'>
                          <img src={process.env.PUBLIC_URL + "/images/logo-em.png"} height={40} alt="logo" />
                        </div>
                        <div>
                          <h6>{activity.type} <small>({activity.subject})</small></h6>
                          <p>{moment(activity.start).format('YYYY-MM-DD HH:mm')}</p>
                        </div>
                        {/* <Button variant="primary" onClick={() => {}}>
                          <FaStar onClick={() => {
                            setSelected(activity);
                            toggleModal();
                          }} style={{ cursor: 'pointer'}} />
                        </Button> */}
                      </div>
                    ))}
                  </Card.Body>
                </Card>
              </div>
            </div>
          </div>
          <Modal show={showModal} onHide={toggleModal}>
            <Modal.Header closeButton>
              <Modal.Title>Write a Review</Modal.Title>
            </Modal.Header>
            <Modal.Body>
              <Form>
                <Form.Group controlId="formTotal">
                  <Form.Label>Total:</Form.Label>
                  <Form.Control type="number" placeholder="Enter total" value={reviewData.total} onChange={e => setReviewData({ ...reviewData, total: e.target.value })} />
                </Form.Group>
                <Form.Group controlId="formPoints">
                  <Form.Label>Points:</Form.Label>
                  <Form.Control type="number" max={reviewData.total} placeholder="Enter points" value={reviewData.points} onChange={e => setReviewData({ ...reviewData, points: e.target.value })} />
                </Form.Group>
              </Form>
            </Modal.Body>
            <Modal.Footer>
              <Button variant="secondary" onClick={toggleModal}>
                Close
              </Button>
              <Button variant="primary" onClick={handleReviewSubmit}>
                Submit Review
              </Button>
            </Modal.Footer>
          </Modal>
        </>
      } />
    </>
  );
}

export default ProgressTracking;
