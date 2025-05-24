import React, { useEffect, useState } from 'react'
import { Breadcrumb, Button, Card, Table } from 'react-bootstrap'
import SideNavBar from '../../components/side-nav/SIdeNav'
import UsersService from '../../services/Users.service'
import Notiflix from 'notiflix'
import { AiOutlineDelete, AiOutlineEdit } from 'react-icons/ai'
import ContentContainer from './ContentContainer'
import { Link } from 'react-router-dom'

function UsersManagement() {
    const [users, setUsers] = useState([])
    const [isExpanded, setIsExpanded] = useState(false);

    const handleSidebarToggle = (isVisible) => {
        setIsExpanded(isVisible);
    };

    const loadUsers = async () => {
        if (users.length > 0) {
          // If users array has elements, flush them before setting new data
          setUsers([]);
        }
              
        await UsersService.getUsers().then((data) => {
          console.log(data);
          setUsers(data);
        });
    };

    const deleteUsers = async (id) => {
        Notiflix.Confirm.show(
            'Confirmation',
            'Are you sure you want to Remove this User?',
            'Yes',
            'No',
            async () => {
                try {
                    await UsersService.deleteUser(id);
                    // setUsers(prevUsers => prevUsers.filter(user => user._id !== id));
                    Notiflix.Report.success(
                        'Success',
                        'User Removed Successfully',
                        'Okay',
                    );
                    setInterval(() => window.location.reload(), 3000)
                } catch (error) {
                    console.error('Error deleting user:', error);
                    Notiflix.Report.failure('Error deleting user. Please try again.');
                }
            }
        );
    };
    

    const updateUsers = async (id, item) => {
        const newStatus = item.approved? false : true;
        const updatedItem = { ...item, approved: newStatus };
    
        Notiflix.Confirm.show(
            'Confirmation',
            'Are you sure you want to Update this User?',
            'Yes',
            'No',
            async () => {
                await UsersService.updateUser(id, updatedItem).then(() => {
                    // setUsers(prevUsers =>
                    //     prevUsers.map(user =>
                    //         user._id === id ? { ...user, approved: newStatus } : user
                    //     )
                    // );
                    Notiflix.Report.success(
                        'Success',
                        "User Updated Successfully",
                        'Okay',
                    );
                    setInterval(() => window.location.reload(), 3000)
                })
            }
        );
    };
    

    useEffect(() => {
        setUsers([])
        loadUsers()
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
                        <Breadcrumb.Item active>User Management</Breadcrumb.Item>
                    </Breadcrumb>
                </div>
                <div className="row justify-content-center">
                <div className="col-md">
                    <Card className='shadow custom-table'>
                    <Card.Body>
                                        <Card.Title>Users Details</Card.Title>
                                        {users && users.length > 0 && (
                                            <Table striped bordered hover>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
                                                        <th>Full Name</th>
                                                        <th>Contact</th>
                                                        <th>Status</th>
                                                        <th>Options</th>
                                                        {/* Add more table headers as needed */}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {users.map((user, index) => (
                                                        <tr key={index} className={user.status === "COMPLETED" ? "table-success" : ""}>
                                                            <td>{index + 1}</td>
                                                            <td>{user.username}</td>
                                                            <td>{user.fullName}<br></br><small>(NIC: {user.nic})</small></td>
                                                            <td>{user.contact}</td>
                                                            <td>{user.approved?"ACTIVE":"BLOCKED"}</td>
                                                            {/* Add more table cells for other properties */}
                                                            <td>
                                                                <Button variant='success' onClick={() => updateUsers(user._id, user)}>
                                                                    <AiOutlineEdit />
                                                                </Button>
                                                                <Button variant='danger' onClick={() => deleteUsers(user._id)}>
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

export default UsersManagement