import React, { useState } from 'react';
import './form.css';
import Footer from '../components/footer/Footer';

const signsData = [
  { id: 1, gif: '/gifs/hello.gif', caption: 'හෙලෝ' },
  { id: 2, gif: '/gifs/help.gif', caption: 'උදව්වක් ඔනේ' },
  { id: 3, gif: '/gifs/love.gif', caption: 'ආදරෙයි' },
  { id: 4, gif: '/gifs/dontknow.gif', caption: 'මම දන්නෙ නෑ' },
  { id: 5, gif: '/gifs/ba.png', caption: 'බ' },
  { id: 6, gif: '/gifs/b.png', caption: 'බ්' },
  { id: 7, gif: '/gifs/na.png', caption: 'Yes' },
  { id: 8, gif: '/gifs/sign8.gif', caption: 'No' },
  { id: 9, gif: '/gifs/sign9.gif', caption: 'Please' },
  { id: 10, gif: '/gifs/sign10.gif', caption: 'Help' },
  // Add more signs as needed
];

const SignLanguageTranslationScreen = () => {
  const [selectedSigns, setSelectedSigns] = useState([]);
  const [phrase, setPhrase] = useState('');

  const handleSelectSign = (sign) => {
    setSelectedSigns((prev) => [...prev, sign]);
    setPhrase((prev) => `${prev} ${sign.caption}`.trim());
  };

  const handlePhraseChange = (e) => {
    setPhrase(e.target.value);
  };

  return (
    <>
      <div className="form-body" style={{ width: '100%', flexDirection: 'column'}}>
        <h1 className="text-3xl font-semibold mb-6" style={{color: 'white'}}>Sign Language Translation</h1>

        {/* Signs Gallery */}
        <div
          className="signs-gallery"
          style={{
            display: 'flex',
            flexWrap: 'wrap',
            gap: '16px',
            overflowY: 'auto',
            maxHeight: '400px',
            border: '1px solid #ddd',
            padding: '16px',
            borderRadius: '8px',
          }}
        >
          {signsData.map((sign) => (
            <div
              key={sign.id}
              className="sign-box"
              style={{
                width: 'calc(16.66% - 16px)', // 6 boxes per row
                textAlign: 'center',
                cursor: 'pointer',
                border: '1px solid #ccc',
                borderRadius: '8px',
                padding: '8px',
                boxShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
              }}
              onClick={() => handleSelectSign(sign)}
            >
              <img
                src={process.env.PUBLIC_URL + sign.gif}
                alt={sign.caption}
                style={{ width: '100%', borderRadius: '8px' }}
              />
              <p style={{ marginTop: '8px', fontSize: '14px', fontWeight: 'bold' }}>
                {sign.caption}
              </p>
            </div>
          ))}
        </div>

        {/* Selected Translation Section */}
        <div
          className="translation-section"
          style={{
            marginTop: '24px',
            padding: '16px',
            border: '1px solid #ddd',
            borderRadius: '8px',
          }}
        >
          <h2 className="text-xl font-semibold mb-4" style={{color: 'white'}}>Translation</h2>
          <div
            className="selected-signs"
            style={{
              display: 'flex',
              flexWrap: 'wrap',
              gap: '16px',
              marginBottom: '16px',
              borderBottom: '1px solid #ddd',
              paddingBottom: '16px',
            }}
          >
            {selectedSigns.map((sign, index) => (
              <div
                key={index}
                className="sign-box"
                style={{
                  width: 'calc(16.66% - 16px)', // Same as signs gallery
                  textAlign: 'center',
                  border: '1px solid #ccc',
                  borderRadius: '8px',
                  padding: '8px',
                  backgroundColor: '#f9f9f9',
                }}
              >
                <img
                  src={process.env.PUBLIC_URL + sign.gif}
                  alt={sign.caption}
                  style={{ width: '100%', borderRadius: '8px' }}
                />
                <p style={{ marginTop: '8px', fontSize: '14px', fontWeight: 'bold' }}>
                  {sign.caption}
                </p>
              </div>
            ))}
          </div>
          <textarea
            value={phrase}
            onChange={handlePhraseChange}
            className="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
            rows="3"
            placeholder="Your translation will appear here..."
          ></textarea>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default SignLanguageTranslationScreen;
