import React, { useEffect, useState } from 'react';
import { Container, Row, Col, Card } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import SideNavBar from '../../components/side-nav/SIdeNav';
import ContentContainer from './ContentContainer';
import DashboardNavigation from '../../components/nav/DashNavigation';
// import { CircularProgressbar, buildStyles } from 'react-circular-progressbar';
// import 'react-circular-progressbar/dist/styles.css';
import { AiOutlineTwitter, AiOutlineStop, AiOutlineEdit, AiFillFormatPainter } from 'react-icons/ai';
import { FaVoicemail } from 'react-icons/fa';

function DashboardHome() {
    const [isExpanded, setIsExpanded] = useState(false);
    const [user, setUser] = useState(null);
    const [activities, setActivities] = useState([]);

    useEffect(() => {
        const storedUser = localStorage.getItem('user');
        if (storedUser) {
            setUser(JSON.parse(storedUser));
        }
        
        // Simulated activity progress data
        setActivities([
            { title: 'Lesson 1: Introduction to Sign Language', progress: 75, details: 'Basic gestures and alphabets' },
            { title: 'Lesson 2: Common Phrases', progress: 50, details: 'Daily conversation signs' },
            { title: 'Lesson 3: Numbers and Counting', progress: 90, details: 'Learn numbers from 1-100' }
        ]);
    }, []);

    const handleSidebarToggle = (isVisible) => {
        setIsExpanded(isVisible);
    };

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
                                            <div className="me-3" style={{ width: '60px', height: '60px', borderRadius: '50%', backgroundColor: '#007bff', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#fff', fontSize: '24px', fontWeight: 'bold' }}>
                                                {user.username.charAt(0).toUpperCase()}
                                            </div>
                                            <div>
                                                <h2>{user.username}</h2>
                                                <p>{user.email}</p>
                                            </div>
                                        </>
                                    ) : (
                                        <p>Loading user details...</p>
                                    )}
                                </Card>
                            </Col>
                        </Row>
                        
                        {/* Activities and Progress Section */}
                        <Row className="mt-4">
                            <Col lg={12}>
                                <Card className="shadow p-4">
                                    <h3>Activity Progress</h3>
                                    <ul className="list-group mt-3">
                                        {activities.map((activity, index) => (
                                            <li key={index} className="list-group-item d-flex align-items-center">
                                                <div style={{ width: 50, height: 50, marginRight: 15 }}>
                                                    {/* <CircularProgressbar 
                                                        value={activity.progress} 
                                                        text={`${activity.progress}%`} 
                                                        styles={buildStyles({
                                                            textSize: '32px',
                                                            pathColor: `#007bff`,
                                                            textColor: '#000',
                                                            trailColor: '#d6d6d6'
                                                        })}
                                                    /> */}
                                                </div>
                                                <div>
                                                    <h5>{activity.title}</h5>
                                                    <p>{activity.details}</p>
                                                </div>
                                            </li>
                                        ))}
                                    </ul>
                                </Card>
                            </Col>
                        </Row>

                        {/* Site Navigation Section */}
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
                                    <Link to={'/dashboard/color-lesson'} className="btn btn-primary">
                                    <AiOutlineTwitter style={{ color: 'purple', marginRight: '8px' }} />
                                    Paint Lessons
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
