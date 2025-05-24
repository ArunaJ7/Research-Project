import React from 'react'
import HeroContainer from '../components/hero/Hero'
import Footer from '../components/footer/Footer'
import Navigation from '../components/nav/Navigation'
import Services from '../components/cards/Services'

function Home() {
  return (
    <>
        <Navigation />
        <div className='main-container'>
            <HeroContainer />
            <Services />
            
        </div>
        

        <Footer />
    </>
  )
}

export default Home