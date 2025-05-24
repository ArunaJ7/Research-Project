import React, { useEffect, useState } from 'react';
import { Container, Row, Col, Card, Alert, Spinner } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import SideNavBar from '../../components/side-nav/SIdeNav';
import ContentContainer from './ContentContainer';
import DashboardNavigation from '../../components/nav/DashNavigation';
import { AiOutlineTwitter, AiOutlineStop, AiOutlineEdit, AiFillFormatPainter } from 'react-icons/ai';

function DashboardHome() {
    const [isExpanded, setIsExpanded] = useState(false);
    const [user, setUser] = useState(null);
    const [activities, setActivities] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        try {
            const storedUser = localStorage.getItem('user');
            if (storedUser) {
                const parsedUser = JSON.parse(storedUser);
                if (parsedUser && parsedUser.username) {
                    setUser(parsedUser);
                } else {
                    setError('Invalid user data format');
                }
            } else {
                setError('User not found in local storage');
            }
            
            setActivities([
                { title: 'Lesson 1: Introduction to Sign Language', progress: 75, details: 'Basic gestures and alphabets' },
                { title: 'Lesson 2: Common Phrases', progress: 50, details: 'Daily conversation signs' },
                { title: 'Lesson 3: Numbers and Counting', progress: 90, details: 'Learn numbers from 1-100' }
            ]);
        } catch (err) {
            setError('Failed to load user data');
        } finally {
            setLoading(false);
        }
    }, []);

    const handleSidebarToggle = (isVisible) => {
        setIsExpanded(isVisible);
    };

    if (loading) {
        return (
            <div>
                <SideNavBar onToggle={handleSidebarToggle} />
                <ContentContainer isExpanded={isExpanded}>
                    <DashboardNavigation />
                    <Container fluid className="text-center mt-5">
                        <Spinner animation="border" role="status">
                            <span className="visually-hidden">Loading...</span>
                        </Spinner>
                    </Container>
                </ContentContainer>
            </div>
        );
    }

    if (error) {
        return (
            <div>
                <SideNavBar onToggle={handleSidebarToggle} />
                <ContentContainer isExpanded={isExpanded}>
                    <DashboardNavigation />
                    <Container fluid className="mt-4">
                        <Row>
                            <Col lg={12}>
                                <Alert variant="danger">
                                    {error} - Please try again later or contact support
                                </Alert>
                            </Col>
                        </Row>
                    </Container>
                </ContentContainer>
            </div>
        );
    }

    return (
        <div>
            <SideNavBar onToggle={handleSidebarToggle} />
            <ContentContainer isExpanded={isExpanded}>
                <DashboardNavigation />
                <div className="fluid-container custom mt-4">
                    <Container fluid className="p-0">
                        <Row>
                            <Col lg={12}>
                                <Card className="shadow p-4 d-flex flex-row align-items-center">
                                    {user ? (
                                        <>
                                            <div className="me-3" style={{ 
                                                width: '60px', 
                                                height: '60px', 
                                                borderRadius: '50%', 
                                                backgroundColor: '#007bff', 
                                                display: 'flex', 
                                                alignItems: 'center', 
                                                justifyContent: 'center', 
                                                color: '#fff', 
                                                fontSize: '24px', 
                                                fontWeight: 'bold' 
                                            }}>
                                                {user.username?.charAt(0)?.toUpperCase() || 'U'}
                                            </div>
                                            <div>
                                                <h2>{user.username || 'User'}</h2>
                                                <p>{user.email || 'No email provided'}</p>
                                            </div>
                                        </>
                                    ) : (
                                        <p>Loading user details...</p>
                                    )}
                                </Card>
                            </Col>
                        </Row>
                        
                        <Row className="mt-4">
                            <Col lg={12}>
                                <Card className="shadow p-4">
                                    <h3>Activity Progress</h3>
                                    {activities.length > 0 ? (
                                        <ul className="list-group mt-3">
                                            {activities.map((activity, index) => (
                                                <li key={index} className="list-group-item d-flex align-items-center">
                                                    <div style={{ width: 50, height: 50, marginRight: 15 }}></div>
                                                    <div>
                                                        <h5>{activity.title}</h5>
                                                        <p>{activity.details}</p>
                                                    </div>
                                                </li>
                                            ))}
                                        </ul>
                                    ) : (
                                        <Alert variant="info" className="mt-3">
                                            No activities found
                                        </Alert>
                                    )}
                                </Card>
                            </Col>
                        </Row>

                        <Row className="mt-4">
                            <Col lg={12}>
                                <Card className="shadow p-4">
                                    <h3>Site Navigation</h3>
                                    <div style={{
                                        display: 'grid',
                                        gridTemplateColumns: 'repeat(3, 1fr)', 
                                        gap: '16px', 
                                        marginTop: '16px'
                                    }}>
                                        <Link to={'/dashboard/alphabet-study'} className="btn btn-primary">
                                            <AiOutlineTwitter style={{ color: 'purple', marginRight: '8px' }} />
                                            Sign Alphabet
                                        </Link>
                                        <Link to={'/dashboard/sign-study'} className="btn btn-primary">
                                            <AiOutlineStop style={{ color: 'purple', marginRight: '8px' }} />
                                            Sign Study
                                        </Link>
                                        <Link to={'/dashboard/questions'} className="btn btn-primary">
                                            <AiOutlineEdit style={{ color: 'purple', marginRight: '8px' }} />
                                            Questions
                                        </Link>
                                        <Link to={'/dashboard/lip-lessons'} className="btn btn-primary">
                                            <AiFillFormatPainter style={{ color: 'purple', marginRight: '8px' }} />
                                            Lip Lessons
                                        </Link>
                                    </div>
                                </Card>
                            </Col>
                        </Row>
                    </Container>
                </div>
            </ContentContainer>
        </div>
    );
}

export default DashboardHome;