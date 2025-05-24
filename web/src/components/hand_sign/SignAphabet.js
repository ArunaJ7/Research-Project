import React, { useState } from 'react';
import { Card, Col, Row } from 'react-bootstrap';
import DashboardNavigation from '../../components/nav/DashNavigation';
import SideNavBar from '../../components/side-nav/SIdeNav';
import SignAnswer from './SignAnswer';
import ContentContainer from '../../pages/dashboard/ContentContainer';
import AlphabetLearningFlow from './AlphabelLearningFlow';

function SignAlpabetLessons() {
  const [selectedLesson, setSelectedLesson] = useState(null);

  const lessons = [
      { 
          title: 'අ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Aa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['අම්මා (mother)', 'අත් (hand)', 'අර්ත (meaning)']
      },
      { 
          title: 'ආ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ආදරය (love)', 'ආච්චි (grandmother)', 'ආකාශය (sky)']
      },
      { 
          title: 'ඇ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Ae.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඇත් (elephant)', 'ඇටය (bone)', 'ඇස (eye)']
      },
      { 
          title: 'ඈ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Aea.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඈත (far)', 'ඈව් (cry)', 'ඈඳ (pull)']
      },
      { 
          title: 'ඉ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Ie.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඉංග්රීසි (English)', 'ඉර (sun)', 'ඉතිහාසය (history)']
      },
      { 
          title: 'ඊ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Iee.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඊයේ (yesterday)', 'ඊතලය (arrow)', 'ඊළාම් (Eelam)']
      },
      { 
          title: 'උ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Ue.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['උදය (morning)', 'උකුස්සා (eagle)', 'උමතු (mad)']
      },
      { 
          title: 'ඌ', 
          videoUrl: 'https://www.youtube.com/embed/EAz89NlmjCE', 
          images: [process.env.PUBLIC_URL + "/materials/Uee.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඌව (Uva province)', 'ඌරා (pig)', 'ඌණ (decrease)']
      },
      
      { 
          title: 'ක', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_18', 
          images: [process.env.PUBLIC_URL + '/materials/Ka.jpg', process.env.PUBLIC_URL + "/materials/Kal.png"],
          examples: ['කමල (lotus)', 'කොටස (part)', 'කවිය (poem)']
      },
      { 
          title: 'ඛ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_19', 
          images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඛණ්ඩ (piece)', 'ඛෙද (sorrow)', 'ඛ්යාල (disgrace)']
      },
      { 
          title: 'ග', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_20', 
          images: [process.env.PUBLIC_URL + "/materials/Ga.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ගම (village)', 'ගුරු (teacher)', 'ගින්දර (fire)']
      },
      { 
          title: 'ඝ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_21', 
          images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඝණ (dense)', 'ඝෝෂා (noise)', 'ඝාතන (murder)']
      },
      { 
          title: 'ඟ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_22', 
          images: [process.env.PUBLIC_URL + "/materials/Gha.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['අඟුරු (coal)', 'තණඟ (grass)', 'වැඟුරු (frog)']
      },
      { 
          title: 'ච', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_23', 
          images: [process.env.PUBLIC_URL + "/materials/Cha.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['චන්ද්ර (moon)', 'චිත්ර (picture)', 'චෝකලට් (chocolate)']
      },
      { 
          title: 'ඡ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_24', 
          images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඡන්ද (vote)', 'ඡායා (shadow)', 'ඡේද (section)']
      },
      { 
          title: 'ජ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_25', 
          images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ජලය (water)', 'ජය (victory)', 'ජාවා (Java)']
      },
      // { title: 'ඣ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_26', images: ['images/sinhala_jha_1.png'] },
      // { title: 'ඤ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_27', images: ['images/sinhala_nya_1.png'] },
      { 
          title: 'ට', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_28', 
          images: [process.env.PUBLIC_URL + "/materials/Ta.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ටැංකි (tank)', 'ටිකට් (ticket)', 'ටෙලිවිෂන් (television)']
      },
      { 
          title: 'ඨ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_29', 
          images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඨාන (place)', 'ඨාකුර (lord)', 'ඨීර (shore)']
      },
      { 
          title: 'ඩ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_30', 
          images: [process.env.PUBLIC_URL + "/materials/Dha.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඩයරි (diary)', 'ඩොලර් (dollar)', 'ඩයස් (dice)']
      },
      // { title: 'ඪ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_31', images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"] },
      { 
          title: 'ණ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_32', 
          images: [process.env.PUBLIC_URL + "/materials/Na.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ණය (debt)', 'ණාඩි (watch)', 'ණත් (law)']
      },
      { 
          title: 'ත', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_33', 
          images: [process.env.PUBLIC_URL + "/materials/Tha.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['තරු (star)', 'තොරතුරු (information)', 'තෑගි (gift)']
      },
      // { title: 'ථ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_34', images: ['images/sinhala_tha_1.png'] },
      { 
          title: 'ද', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_35', 
          images: [process.env.PUBLIC_URL + "/materials/Da.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['දොර (door)', 'දිය (water)', 'දින (day)']
      },
      // { title: 'ධ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_36', images: ['images/sinhala_dha_1.png'] },
      { 
          title: 'න', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_37', 
          images: [process.env.PUBLIC_URL + "/materials/Na.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['නගරය (city)', 'නැකත (star)', 'නම (name)']
      },
      { 
          title: 'ප', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_38', 
          images: ['images/sinhala_pa_1.png', 'images/sinhala_pa_2.png'],
          examples: ['පොත (book)', 'පාසල (school)', 'පැසුණු (ripe)']
      },
      { 
          title: 'ඵ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_39', 
          images: [process.env.PUBLIC_URL + "/materials/Pa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ඵල (fruit)', 'ඵලක (result)', 'ඵලදායී (productive)']
      },
      { 
          title: 'බ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_40', 
          images: [process.env.PUBLIC_URL + "/materials/Ba.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['බත් (rice)', 'බිම (ground)', 'බස (language)']
      },
      // { title: 'භ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_41', images: [process.env.PUBLIC_URL + "/materials/Aaa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"] },
      { 
          title: 'ම', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_42', 
          images: [process.env.PUBLIC_URL + "/materials/Ma.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['මල (flower)', 'මාළිගාව (palace)', 'මිතුරා (friend)']
      },
      { 
          title: 'ය', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_43', 
          images: [process.env.PUBLIC_URL + "/materials/Ya.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['යහපත (goodness)', 'යාළු (friend)', 'යුද (war)']
      },
      { 
          title: 'ර', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_44', 
          images: [process.env.PUBLIC_URL + "/materials/Ra.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['රතු (red)', 'රාජධානිය (kingdom)', 'රූප (image)']
      },
      { 
          title: 'ල', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_45', 
          images: [process.env.PUBLIC_URL + "/materials/La.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ලෝකය (world)', 'ලිපිය (letter)', 'ලෙන් (cave)']
      },
      { 
          title: 'ව', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_46', 
          images: [process.env.PUBLIC_URL + "/materials/Wa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['වතුර (water)', 'වැහි (rain)', 'විදුලිය (electricity)']
      },
      // { title: 'ශ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_47', images: ['images/sinhala_sha_1.png'] },
      // { title: 'ෂ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_48', images: ['images/sinhala_ssha_1.png'] },
      { 
          title: 'ස', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_49', 
          images: [process.env.PUBLIC_URL + "/materials/Sa.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['සඳ (moon)', 'සතුට (happiness)', 'සුරතල් (pet)']
      },
      { 
          title: 'හ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_50', 
          images: [process.env.PUBLIC_URL + "/materials/Ha.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['හතර (four)', 'හදවත (heart)', 'හම (skin)']
      },
      { 
          title: 'ළ', 
          videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_51', 
          images: [process.env.PUBLIC_URL + "/materials/La.jpg", process.env.PUBLIC_URL + "/materials/Aal.png"],
          examples: ['ළමයා (child)', 'ළඟ (near)', 'ළිං (well)']
      },
      // { title: 'ෆ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_52', images: ['images/sinhala_fa_1.png'] },
      // { title: 'ඟ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_53', images: ['images/sinhala_ngnga_1.png'] },
      // { title: 'ඥ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_54', images: ['images/sinhala_gnya_1.png'] },
      // { title: 'ඳ', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_55', images: ['images/sinhala_ndda_1.png'] },
      // { title: 'ක්', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_56', images: ['images/sinhala_kku_1.png'] },
      // { title: 'ත්', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_57', images: ['images/sinhala_tthu_1.png'] },
      // { title: 'ශ්', videoUrl: 'https://www.youtube.com/embed/VIDEO_ID_58', images: ['images/sinhala_shru_1.png'] }
  ];
  

  return (
    <>
      <SideNavBar onToggle={() => {}} />
      <ContentContainer isExpanded={false}>
        <DashboardNavigation />
        <div className="fluid-container custom mt-4">
          <Row>
            <Col lg={4}>
              <Card className="shadow custom-table">
                <Card.Body>
                  <Card.Title>Learn Sinhala Alphabet (Sign Language)</Card.Title>
                  {lessons.map((lesson, index) => (
                    <div
                      key={index}
                      className={`lesson-item my-3 p-2 border rounded ${selectedLesson?.title === lesson.title ? 'selected' : ''}`}
                      onClick={() => setSelectedLesson(lesson)}
                      style={{ cursor: 'pointer' }}
                    >
                      <h6>{lesson.title}</h6>
                    </div>
                  ))}
                </Card.Body>
              </Card>
            </Col>
            <Col lg={8}>
              <Card className="shadow custom-table">
                <Card.Body>
                  {selectedLesson ? (
                    <AlphabetLearningFlow selectedLesson={selectedLesson} />
                  ) : (
                    <p>Please select a Sinhala letter to view the sign video and images.</p>
                  )}
                </Card.Body>
              </Card>
            </Col>
          </Row>
        </div>
      </ContentContainer>
    </>
  );
}

export default SignAlpabetLessons;
