// SideNavBar.js
import React, { useState } from "react";
import "@trendmicro/react-sidenav/dist/react-sidenav.css";
import { AiOutlineAudio, AiOutlineStop, AiOutlineFormatPainter, AiOutlineHome, AiOutlineNotification, AiFillHome, AiOutlineBarChart, AiFillBackward, AiOutlineFastBackward, AiOutlineStepBackward, AiOutlineDotChart, AiOutlineCalendar, AiOutlineEdit, AiFillFormatPainter, AiOutlineTwitter, AiFillPauseCircle } from 'react-icons/ai'
import SideNav, { Toggle, Nav, NavItem, NavIcon, NavText } from "@trendmicro/react-sidenav";
import { Link } from "react-router-dom";
import { FaVoicemail } from "react-icons/fa";

const SideNavBar = ({onToggle}) => {
  const [isVisible, setIsVisible] = useState(false);

  const handleToggle = () => {
    const newVisibility = !isVisible;
    setIsVisible(newVisibility);
    onToggle(newVisibility); // Call the callback function to notify Dashboard
  };

  return (
    <SideNav expanded={isVisible} style={{ background: 'var(--primary-bg)', position: 'fixed' }}>
      <SideNav.Toggle
        onClick={() => {
          handleToggle();
        }}
      />
      <SideNav.Nav defaultSelected="home">
        <NavItem eventKey="home">
          <NavIcon>
            <Link to={'/dashboard'}><AiOutlineHome style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard'}>Home</Link></NavText>
        </NavItem>
        <NavItem eventKey="sign-alpabet">
          <NavIcon>
            <Link to={'/dashboard/alphabet-study'}><AiOutlineTwitter style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard/alphabet-study'}>Sign Alpabet</Link></NavText>
        </NavItem>
        <NavItem eventKey="sign-study">
          <NavIcon>
            <Link to={'/dashboard/sign-study'}><AiOutlineStop style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard/sign-study'}>Sign Study</Link></NavText>
        </NavItem>
        <NavItem eventKey="study-entry">
          <NavIcon>
            <Link to={'/dashboard/questions'}><AiOutlineEdit style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard/questions'}>Questions</Link></NavText>
        </NavItem>
        <NavItem eventKey="lip">
          <NavIcon>
            <Link to={'/dashboard/lip-lessons'}><FaVoicemail style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard/lip-lessons'}>Lip Lessons</Link></NavText>
        </NavItem>
        <NavItem eventKey="painter">
          <NavIcon>
            <Link to={'/dashboard/color-lesson'}><AiFillFormatPainter style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard/color-lesson'}>Paint Lessons</Link></NavText>
        </NavItem>
        <NavItem eventKey="painter2">
          <NavIcon>
            <Link to={'/dashboard/color-lesson2'}><AiFillPauseCircle style={{ fontSize: "1.75em" }} /></Link>
          </NavIcon>
          <NavText><Link to={'/dashboard/color-lesson2'}>Color Lessons</Link></NavText>
        </NavItem>
        
        
      </SideNav.Nav>
    </SideNav>
  );
};

export default SideNavBar;
