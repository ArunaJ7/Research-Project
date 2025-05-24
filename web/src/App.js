import './App.css';
import { BrowserRouter as Router, Routes, Route, useNavigate } from 'react-router-dom'
import Signup from './pages/SignUp';
import SignIn from './pages/SignIn';
import Home from './pages/Home';
import Profile from './pages/dashboard/Profile';
import PageNotFound from './pages/PageNotFound';
import DashboardHome from './pages/dashboard/DashboardHome';
import Questionaire from './pages/dashboard/Questionaire';
import IdentificationScreen from './pages/IdentificationScreen';
import LipreadingScreen from './pages/LipreadingScreen';
import SignLanguageTranslationScreen from './pages/SignLangugeBoard';
import SnakeGame from './pages/dashboard/SnakeGame';
import IdentifySignScreen from './pages/IdentifySignScreen';
import ColorPredictionScreen from './pages/ColorPredictionScreen';
import EmotionSuggestion from './pages/EmotionSuggetion';
import LipMovingLessons from './pages/dashboard/LipMovingLessons';
import SignLanguageLessons from './components/hand_sign/SignLanguageLessons';
import PaintLesson from './pages/dashboard/PainLesson';
import { useEffect } from 'react';
import SignAlpabetLessons from './components/hand_sign/SignAphabet';
import PaintLessonV2 from './pages/dashboard/PaintLessonV2';

function App() {
  return (
    <div className="App">
      <Router>
        <AuthRedirect /> 
        <Routes>
          <Route element={<Home />} path="/" />
          <Route element={<Signup />} path="/sign-up" />
          <Route element={<EmotionSuggestion />} path="/emotion-suggetion" />
          <Route element={<IdentificationScreen />} path="/sign-in" />
          <Route element={<IdentificationScreen />} path="/identification" />
          <Route element={<LipreadingScreen />} path="/lip-reading" />
          <Route element={<SignLanguageTranslationScreen />} path="/sign-avatar" />
          <Route element={<IdentifySignScreen />} path="/sign-identify" />
          <Route element={<ColorPredictionScreen />} path="/color-prediction" />

          <Route path="/dashboard">
            <Route element={<DashboardHome />} path="" />
            <Route element={<Profile />} path="profile" />
            <Route element={<SignAlpabetLessons />} path="alphabet-study" />
            <Route element={<SignLanguageLessons />} path="sign-study" />
            <Route element={<Questionaire />} path="questions" />
            <Route element={<LipMovingLessons />} path="lip-lessons" />
            <Route element={<SnakeGame />} path="snake-game" />
            <Route element={<PaintLesson />} path="color-lesson2" />
            <Route element={<PaintLessonV2 />} path="color-lesson" />
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
