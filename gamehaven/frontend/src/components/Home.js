import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Navbar from './Navbar';
import './Home.css';

const Home = () => {
  const navigate = useNavigate();
  const isAuthenticated = !!localStorage.getItem('jwt_token');

  const handleProtectedAction = (path) => {
    if (!isAuthenticated) {
      navigate('/login');
    } else {
      navigate(path);
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('jwt_token');
    window.location.reload(); // Reload to update auth state
  };

  return (
    <div className="home">
      <Navbar active="home" />
      
      <main className="hero-section">
        <div className="hero-content">
          <h1 className="hero-title">
            <span className="hero-title-main">GameHaven</span>
            <span className="hero-title-sub">Where Gamers Unite</span>
          </h1>
          <p className="hero-description">
            Step into the ultimate gaming marketplace where passionate gamers connect, 
            trade, and share their favorite games. Join our thriving community and 
            discover endless possibilities for your gaming collection.
          </p>
          <div className="cta-buttons">
            <button 
              onClick={() => handleProtectedAction('/games')} 
              className="cta-button primary"
            >
              <i className="fas fa-gamepad"></i> Explore Games
            </button>
            <button 
              onClick={() => handleProtectedAction('/marketplace')} 
              className="cta-button secondary"
            >
              <i className="fas fa-store"></i> Visit Marketplace
            </button>
          </div>
        </div>
      </main>

      <section className="features">
        <div className="feature-card">
          <i className="fas fa-exchange-alt"></i>
          <h3>Trade Games</h3>
          <p>Exchange games with other players</p>
        </div>
        <div className="feature-card">
          <i className="fas fa-users"></i>
          <h3>Community</h3>
          <p>Join a thriving gaming community</p>
        </div>
        <div className="feature-card">
          <i className="fas fa-star"></i>
          <h3>Reviews</h3>
          <p>Share your gaming experiences</p>
        </div>
      </section>
    </div>
  );
};

export default Home;
