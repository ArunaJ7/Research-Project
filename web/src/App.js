import './App.css';
import { BrowserRouter as Router, Routes, Route, useNavigate } from 'react-router-dom'
import Signup from './pages/SignUp';
import SignIn from './pages/SignIn';
import Home from './pages/Home';
import Profile from './pages/dashboard/Profile';
import PageNotFound from './pages/PageNotFound';
import SignLanguageLessons from './components/hand_sign/SignLanguageLessons';
import { useEffect } from 'react';
import SignAlpabetLessons from './components/hand_sign/SignAphabet';

function App() {
  return (
    <div className="App">
      <Router>
        <AuthRedirect /> 
        <Routes>
          <Route element={<Home />} path="/" />
          

          <Route path="/dashboard">
            <Route element={<DashboardHome />} path="" />
            <Route element={<Profile />} path="profile" />
            <Route element={<SignAlpabetLessons />} path="alphabet-study" />
            <Route element={<SignLanguageLessons />} path="sign-study" />
            
          </Route>
          <Route path="*" element={<PageNotFound />} />
        </Routes>
      </Router>
    </div>
  );
}

// Redirect function based on session existence
function AuthRedirect() {
  const navigate = useNavigate();

  useEffect(() => {
    const user = localStorage.getItem("user");

    if (user) {
      navigate("/dashboard");
    }
  }, []);

  return null;
}

export default App;
