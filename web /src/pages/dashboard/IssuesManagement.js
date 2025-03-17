import React, { useEffect, useState } from 'react'
import SideNavBar from '../../components/side-nav/SIdeNav'
import { Breadcrumb, Button, Card, Table } from 'react-bootstrap'
import IssuesService from '../../services/Issues.service'
import { AiOutlineDelete, AiOutlineEdit } from 'react-icons/ai'
import Notiflix from 'notiflix'
import ContentContainer from './ContentContainer'
import { Link } from 'react-router-dom'

function IssuesManagement() {

    const [issues, setIssues] = useState([])
    const [isExpanded, setIsExpanded] = useState(false);

    const handleSidebarToggle = (isVisible) => {
        setIsExpanded(isVisible);
    };

    const loadIssues = async () => {
        setIssues([])
        await IssuesService.getIssues().then((data) => {
          console.log(data)
          setIssues(data)
        })
    }

    const deleteIssues = async (id) => {
        Notiflix.Confirm.show(
            'Confirmation',
            'Are you sure you want to Remove this Item?',
            'Yes',
            'No',
            async () => {
                await IssuesService.deleteIssue(id).then(() => {
                    // setIssues(prevIssues => prevIssues.filter(issue => issue._id !== id));
                    Notiflix.Report.success(
                        'Success',
                        "Issue Remved Successfully",
                        'Okay',
                    );
                    setInterval(() => window.location.reload(), 3000)
                })
            }
        );
        
    }

    const updateIssues = async (id, item) => {
        const newStatus = item.status === "PENDING" ? "COMPLETED" : "PENDING";
        const updatedItem = { ...item, status: newStatus }; 
    
        Notiflix.Confirm.show(
            'Confirmation',
            'Are you sure you want to Update this Item?',
            'Yes',
            'No',
            async () => {
                await IssuesService.updateIssue(id, updatedItem).then(() => {
                    // setIssues([])
                    // setIssues(prevIssues =>
                    //     prevIssues.map(issue =>
                    //         issue._id === id ? { ...issue, status: newStatus } : issue
                    //     )
                    // );
                    Notiflix.Report.success(
                        'Success',
                        "Issue Updated Successfully",
                        'Okay',
                    );
                    setInterval(() => window.location.reload(), 3000)
                })
            }
        );
    };
    

    useEffect(() => {
        loadIssues()
      }, [])
  return (
    <>
        <SideNavBar onToggle={handleSidebarToggle}/>
        <ContentContainer isExpanded={isExpanded} children={<div >
            <div className="fluid-container custom mt-4">
                <div className='custom-breadcrumb'>
                    <Breadcrumb>
                        <Breadcrumb.Item><Link to={'/'}>Home</Link></Breadcrumb.Item>
                        <Breadcrumb.Item>
                            <Link to={'/dashboard'}>Dashboard</Link>
                        </Breadcrumb.Item>
                        <Breadcrumb.Item active>Issues Management</Breadcrumb.Item>
                    </Breadcrumb>
                </div>
                <div className="row justify-content-center">
                <div className="col-md">
                    <Card className='shadow custom-table'>
                    <Card.Body>
                                        <Card.Title>Issues Details</Card.Title>
                                        {issues && issues.length > 0 && (
                                            <Table striped bordered hover>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th>Options</th>
                                                        {/* Add more table headers as needed */}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {issues.map((issue, index) => (
                                                        <tr key={index} className={issue.status === "COMPLETED" ? "table-success" : ""}>
                                                            <td>{index + 1}</td>
                                                            <td>{issue.title}</td>
                                                            <td>{issue.description}</td>
                                                            <td>{issue.status}</td>
                                                            {/* Add more table cells for other properties */}
                                                            <td>
                                                                <Button variant='success' onClick={() => updateIssues(issue._id, issue)}>
                                                                    <AiOutlineEdit />
                                                                </Button>
                                                                <Button variant='danger' onClick={() => deleteIssues(issue._id)}>
                                                                    <AiOutlineDelete />
                                                                </Button>
                                                            </td>
                                                        </tr>
                                                    ))}
                                                </tbody>
                                            </Table>
                                        )}

                                    </Card.Body>
                    </Card>
                </div>
                </div>
            </div>
        </div>} />
      
    </>
  )
}

export default IssuesManagement