import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import './Navbar.css';

const Navbar = ({ active }) => {
  const navigate = useNavigate();
  const isAuthenticated = !!localStorage.getItem('jwt_token');
  
  const handleLogout = () => {
    localStorage.removeItem('jwt_token');
    localStorage.removeItem('user_id');
    navigate('/login');
  };

  // Show only logo and login/register for non-authenticated users
  if (!isAuthenticated) {
    return (
      <nav className="navbar">
        <Link to="/home" className="nav-logo">GameHaven</Link>
        <div className="nav-links">
          <Link to="/login" className="nav-button login">Login</Link>
          <Link to="/register" className="nav-button register">Register</Link>
        </div>
      </nav>
    );
  }

  // Show full navigation for authenticated users
  return (
    <nav className="navbar">
      <Link to="/home" className="nav-logo">GameHaven</Link>
      <div className="nav-links">
        <Link to="/games" className={active === 'games' ? 'active' : ''}>Games</Link>
        <Link to="/marketplace" className={active === 'marketplace' ? 'active' : ''}>Marketplace</Link>
        <Link to="/chat" className={active === 'chat' ? 'active' : ''}>Chat</Link>
        <Link to="/wishlist" className={active === 'wishlist' ? 'active' : ''}>Wishlist</Link>
        <Link to="/reviews" className={active === 'reviews' ? 'active' : ''}>Reviews</Link>
        <Link to="/profile" className={active === 'profile' ? 'active' : ''}>Profile</Link>
        <button className="nav-button logout" onClick={handleLogout}>
          Logout
        </button>
      </div>
    </nav>
  );
};

export default Navbar;
