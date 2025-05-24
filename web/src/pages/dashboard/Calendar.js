import React, { useEffect, useState } from 'react';
import { Button, Modal, Form } from 'react-bootstrap'; 
import SideNavBar from '../../components/side-nav/SIdeNav';
import { Breadcrumb, Card, Col, ListGroup, Row } from 'react-bootstrap';
import ContentContainer from './ContentContainer';
import { Calendar, momentLocalizer } from 'react-big-calendar'; 
import moment from 'moment';
import DashboardNavigation from '../../components/nav/DashNavigation';
import 'react-big-calendar/lib/css/react-big-calendar.css';
import PlansService from '../../services/Plans.service';
import PersonaInfosService from '../../services/PersonaInfos.service';
import env from '../../data/env';
import { Link } from 'react-router-dom';

function StudyPlan() {
  const localizer = momentLocalizer(moment);
  const [username, setUsername] = useState(localStorage.getItem("username"));
  const [avatar, setAvatar] = useState(localStorage.getItem('avatar'));
  const [user, setUser] = useState(null);
  const [isExpanded, setIsExpanded] = useState(false);
  const [notifications, setNotifications] = useState([]);
  const [plans, setPlans] = useState([]);
  const [personal, setPersonl] = useState(null);

  const [events, setEvents] = useState([]);

  const handleSidebarToggle = (isVisible) => {
    setIsExpanded(isVisible);
  };

  const loadPlans = async () => {
    await PlansService.getPlansByUser(localStorage.getItem('username')).then((data) => {
      const loadedEvents = data.flatMap(plan => {
        const activities = plan.activities.map(activity => {
          // Find the method object corresponding to the activity type
          const method = env.METHODS.find(method => method.type === activity.type);
          // Create the event object with color included
          return {
            id: activity._id,
            title: activity.type + ' - ' + activity.subject,
            start: new Date(activity.startTime),
            end: moment(activity.startTime).add(activity.hours, 'hours').toDate(),
            color: method ? method.color : '#10eb60', // Default color if method not found
          };
        });
        return activities;
      });
      setEvents(loadedEvents);
    });
  };

  const loadPersonal = async () => {
    await PersonaInfosService.getLatestPersonalInfoByUsername(localStorage.getItem('username')).then((data) => {
      setPersonl(data);
      console.log(data);
    });
  };

  useEffect(() => {
    loadPlans();
    loadPersonal();
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
                                        <h1>Study Plan</h1>
                                    </Card.Header>
                                    <Card.Body>
                                    <span><Link to={'/'}>Home</Link> / Study Plan</span>
                                    </Card.Body>
                                    
                                </Card>
                            </Col>
          </Row>

          <div className="row justify-content-center mt-4">
            <div className="col-md-8">
              <Card className='shadow'>
                <Card.Body>
                  <Card.Title>Calendar</Card.Title>
                  <Row className='custom-row'>
                    <Col className="col-md-4">
                      {/* Create Calander in this */}
                      <div style={{ width: '100%' }}>
                        <Calendar
                          localizer={localizer}
                          events={events}
                          startAccessor="start"
                          endAccessor="end"
                          // className="custom-calendar"
                          style={{ height: 500, width: 800 }}
                        />
                      </div>
                    </Col>
                    
                  </Row>
                </Card.Body>
              </Card>
            </div>
            <div className="col-md-4">
              <Card className='custom-card shadow'>
                <Card.Body>
                  <h5>Notifications</h5>
                  
                </Card.Body>
              </Card>
            </div>
          </div>
        </div>
        </>
      } />
      
    </>
  );
}

export default StudyPlan;
