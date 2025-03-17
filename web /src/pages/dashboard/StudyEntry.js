import React, { useEffect, useState } from 'react';
import { Button, Card, Col, Form, Modal, Row } from 'react-bootstrap'; 
import SideNavBar from '../../components/side-nav/SIdeNav';
import ContentContainer from './ContentContainer';
import DashboardNavigation from '../../components/nav/DashNavigation';
import { FaEdit, FaPlus, FaTrashAlt } from 'react-icons/fa';
import { Link } from 'react-router-dom';

function StudyEntry() {
  

  return (
    <>
      <SideNavBar onToggle={() => {}}/>
      <ContentContainer isExpanded={false} children={
        <>
          <DashboardNavigation />
          <div className="fluid-container custom mt-4">
          <Row>
                            <Col lg={12}>
                                <Card className="shadow">
                                    <Card.Header>
                                        <h1>Study Entry</h1>
                                    </Card.Header>
                                    <Card.Body>
                                    <span><Link to={'/'}>Home</Link> / Study Entry</span>
                                    </Card.Body>
                                    
                                </Card>
                            </Col>
          </Row>
            <div className="row justify-content-center mt-4">
              <div className="col-md-6">
                <Card className='shadow custom-table'>
                  <Card.Body>
                    <Card.Title>Your Study Plans</Card.Title>
                    <div className="add-plan-container" onClick={() => {}}>
                      <span>Add a Study Plan</span> <FaPlus size={30} />
                    </div>
                    {/* {plans.map((plan,index) => (
                      <div style={{display:'flex', justifyContent:'space-between', flexWrap: 'wrap', width: '100%'}}>
                        <div key={index} className="plan-container" style={{flex:1, display:'flex', justifyContent:'space-between', alignItems: 'center'}} onClick={() => {
                          if(!selectedPlan||(selectedPlan && selectedPlan.title !== plan.title)){
                            setSelectedPlan(plan); 
                            setSelectedActs(plan.activities);
                          } 
                          }}>
                            <div>
                            <h5>{plan.title}</h5>
                            <p>{plan.description}</p>
                            </div>
                            
                            <FaEdit className="update-icon" style={{fontSize: 20}} onClick={(event) => handleUpdatePlan(event, plan)} />
                        </div>
                        
                      </div>
                    ))} */}
                    
                  </Card.Body>
                </Card>
              </div>
              <div className="col-md-6">
                <Card className='shadow custom-table'>
                  <Card.Body>
                    <h5>Activities</h5>
                    
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

export default StudyEntry;
