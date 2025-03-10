import React, { useEffect, useState } from 'react';
import { Button, Modal, Form } from 'react-bootstrap'; // Import Modal and Form
import SideNavBar from '../../components/side-nav/SIdeNav';
import { Breadcrumb, Card, Col, ListGroup, Row } from 'react-bootstrap';
import UsersService from '../../services/Users.service';
import CustomBreadcrumb from '../../components/bredcrumb/BreadCrumb';
import ContentContainer from './ContentContainer';
import { Link } from 'react-router-dom';
import NotificationsService from '../../services/Notifications.service';
import Notiflix from 'notiflix';
import env from '../../data/env';
import DashboardNavigation from '../../components/nav/DashNavigation';

function Profile() {
  const [username, setUsername] = useState(localStorage.getItem("username"));
  const [avatar, setAvatar] = useState(localStorage.getItem('avatar'));
  const [user, setUser] = useState(null);
  const [isExpanded, setIsExpanded] = useState(false);
  const [notifications, setNotifications] = useState([]);
  
  // State variables for popup
  const [showPopup, setShowPopup] = useState(false);
  const [formData, setFormData] = useState({}); // Form data state

  const loadNotifications = async () => {
    await NotificationsService.getNotificationsByDistrict(localStorage.getItem('section')).then((data) => {
      console.log(data);
      setNotifications(data);
    });
  };

  const handleSidebarToggle = (isVisible) => {
    setIsExpanded(isVisible);
  };

  const loadUser = async () => {
    await UsersService.getUser(localStorage.getItem("username")).then((data) => {
      setUser(data[0]);
      console.log(data);
    });
  };

  useEffect(() => {
    loadUser();
    loadNotifications();
  }, []);

  // the popup
  const handleOpenPopup = () => {
    setShowPopup(true);
    // Load existing user information
    setFormData({
      email: user.email,
    });
  };

  // Function to handle closing the popup
  const handleClosePopup = () => {
    setShowPopup(false);
  };

  // Function to handle form field changes
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  // Function to handle form submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    // Update profile logic here
    console.log(formData);
    Notiflix.Confirm.show(
      'Confirmation',
      'Are you sure you want to Update your Profile?',
      'Yes',
      'No',
      async () => {
        await UsersService.updateUser(user._id, formData).then(() => {
          Notiflix.Report.success(
              'Success',
              "Your Profile Updated Successfully",
              'Okay',
          );
          handleClosePopup();
          setInterval(() => window.location.reload(), 5000)
        })
        
      }
  );
    
  };

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
                                        <h1>Your Profile</h1>
                                    </Card.Header>
                                    <Card.Body>
                                    <span><Link to={'/'}>Home</Link> / Profile</span>
                                    </Card.Body>
                                    
                                </Card>
                            </Col>
          </Row>
          <div className="row justify-content-center mt-4">
            
            <div className="col-md-8">
              <Card className='shadow'>
                <Card.Body>
                  <Card.Title>Profile Details</Card.Title>
                  <Row className='custom-row'>
                    <Col className="col-md-4">
                      <div className="custom-profile-large">
                        <img src={avatar} className='rounded' alt=""/>
                      </div>
                    </Col>
                    <Col className="col-md-8">
                      <Card.Text>
                        <span className='ft-large'>{username}</span><br />
                        {user&&<>
                          <strong>Name:</strong> {user.fullName}<br />
                          <strong>Role:</strong> {localStorage.getItem('role')}<br />
                          <strong>Email:</strong> {user.email}<br />
                          <Button variant='primary' onClick={handleOpenPopup}>Update Profile</Button>
                        </>}
                      </Card.Text>
                    </Col>
                  </Row>
                </Card.Body>
              </Card>
            </div>
            <div className="col-md-4">
              <Card className='custom-card shadow'>
                <Card.Body>
                  <h5>Notifications</h5>
                  {notifications.length === 0 ? (
                    <p>No messages available</p>
                  ) : (
                    <ListGroup>
                      {notifications.map((notification, index) => (
                        <ListGroup.Item  key={index}>
                          <h5>{notification.title}</h5>
                          <p>{notification.message}</p>
                          <p>{notification.createdAt}</p>
                        </ListGroup.Item>
                      ))}
                    </ListGroup>
                  )}
                </Card.Body>
              </Card>
            </div>
          </div>
        </div>
        </>
      } />
      
      {/* Popup for updating profile */}
      <Modal show={showPopup} onHide={handleClosePopup}>
        <Modal.Header closeButton>
          <Modal.Title>Update Profile</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form onSubmit={handleSubmit}>
            
            <Form.Group controlId="email">
              <Form.Label>Email</Form.Label>
              <Form.Control type="email" name="email" value={formData.email || ''} onChange={handleInputChange} />
            </Form.Group>
            <Button variant="primary" type="submit">
              Update
            </Button>
          </Form>
        </Modal.Body>
      </Modal>
    </>
  );
}

export default Profile;
