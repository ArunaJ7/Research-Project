import React, { useEffect, useState } from 'react';
import { Breadcrumb, Form, Button, Container, Row, Col, Card, ListGroup } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import SideNavBar from '../../components/side-nav/SIdeNav';
import ContentContainer from './ContentContainer';
import NotificationsService from '../../services/Notifications.service';
import Notiflix from 'notiflix';
import env from '../../data/env';

function Notifications() {
    const [isExpanded, setIsExpanded] = useState(false);
    const [title, setTitle] = useState('');
    const [message, setMessage] = useState('');
    const [district, setDistrict] = useState('');
    const [notifications, setNotifications] = useState([]);

    const loadNotifications = async () => {
        await NotificationsService.getNotifications().then((data) => {
          console.log(data)
          setNotifications(data)
        })
    }

    const handleSidebarToggle = (isVisible) => {
        setIsExpanded(isVisible);
    };

    const handleTitleChange = (e) => {
        setTitle(e.target.value);
    };

    const handleMessageChange = (e) => {
        setMessage(e.target.value);
    };

    const handleDistrictChange = (e) => {
        setDistrict(e.target.value);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const newNotification = {
            title: title,
            message: message,
            district: district
        };
        Notiflix.Confirm.show(
            'Confirmation',
            'Are you sure you want to Send this Notification?',
            'Yes',
            'No',
            async () => {
                
                await NotificationsService.addNotification(newNotification).then((data) => {
                    setNotifications([newNotification, ...notifications]);
                    Notiflix.Report.success(
                        'Success',
                        "Notification has sent Successfully",
                        'Okay',
                    );
                    
                })
                
            }
        );
        

        // Reset form fields
        setTitle('');
        setMessage('');
        setDistrict('');
    };

    useEffect(() => {
        loadNotifications()
      }, [])

    return (
      <div>
        <SideNavBar onToggle={handleSidebarToggle}/>
        <ContentContainer isExpanded={isExpanded} children={
            <div className="fluid-container custom mt-4">
                <div className='custom-breadcrumb'>
                    <Breadcrumb>
                        <Breadcrumb.Item><Link to={'/'}>Home</Link></Breadcrumb.Item>
                        <Breadcrumb.Item><Link to={'/dashboard'}>Dashboard</Link></Breadcrumb.Item>
                        <Breadcrumb.Item active>Notifications</Breadcrumb.Item>
                    </Breadcrumb>
                </div>
                
                <Container fluid className="p-0">
                    <Row>
                        <Col lg={6}>
                            <Card className='shadow'>
                                <Card.Body>
                                    <h5>Create Notification</h5>
                                    <Form onSubmit={handleSubmit}>
                                        <Form.Group controlId="title">
                                            <Form.Label>Title</Form.Label>
                                            <Form.Control type="text" value={title} onChange={handleTitleChange} />
                                        </Form.Group>
                                        <Form.Group controlId="message">
                                            <Form.Label>Message</Form.Label>
                                            <Form.Control as="textarea" rows={3} value={message} onChange={handleMessageChange} />
                                        </Form.Group>
                                        <Form.Group controlId="district">
                                            <Form.Label>District</Form.Label>
                                            <Form.Control as="select" value={district} onChange={handleDistrictChange}>
                                                <option value="">Select District</option>
                                                {env.SECTORS.map((item) => <option value={item}>{item}</option>)}
                                            </Form.Control>
                                        </Form.Group>
                                        <Button variant="primary" type="submit">
                                            Submit
                                        </Button>
                                    </Form>
                                </Card.Body>
                            </Card>
                        </Col>
                        <Col lg={6}>
                            <Card className='custom-card shadow'>
                                <Card.Body>
                                    <h5>Previously Sent Notifications</h5>
                                    {notifications.length === 0 ? (
                                        <p>No messages available</p>
                                    ) : (
                                        <ListGroup>
                                            {notifications.map((notification, index) => (
                                                <ListGroup.Item key={index}>
                                                    <h5>{notification.title}</h5>
                                                    <p>{notification.message}</p>
                                                    <p>District: {notification.district}</p>
                                                </ListGroup.Item>
                                            ))}
                                        </ListGroup>
                                    )}
                                </Card.Body>
                            </Card>
                        </Col>
                    </Row>
                </Container>
            </div>
        } />
      </div>
    );
}

export default Notifications;
