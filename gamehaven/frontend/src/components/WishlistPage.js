import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import './WishlistPage.css';
import Navbar from './Navbar';

const WishlistPage = () => {
  const navigate = useNavigate();
  const [wishlist, setWishlist] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    fetchWishlist();
  }, []);

  const fetchWishlist = async () => {
    try {
      const token = localStorage.getItem('jwt_token');
      const response = await fetch(getApiUrl('wishlist'), {
        headers: {
          'Authorization': `Bearer ${token}`,
        }
      });

      if (!response.ok) throw new Error('Failed to fetch wishlist');
      const data = await response.json();
      setWishlist(data);
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  const handleRemoveFromWishlist = async (gameId) => {
    try {
      const token = localStorage.getItem('jwt_token');
      const response = await fetch(getApiUrl(`wishlist/${gameId}`), {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${token}`,
        }
      });

      if (!response.ok) throw new Error('Failed to remove from wishlist');
      setWishlist(prev => prev.filter(item => item.game.id !== gameId));
    } catch (error) {
      setError(error.message);
    }
  };

  if (loading) return <div className="loading">Loading wishlist...</div>;

  return (
    <div className="wishlist-page">
      <Navbar active="wishlist" />
      <button className="back-button" onClick={() => navigate('/home')}>
        <i className="fas fa-arrow-left"></i>
      </button>
      <h1>Your Wishlist</h1>
      {error && <div className="error-message">{error}</div>}
      
      <div className="wishlist-grid">
        {wishlist.map(item => (
          <div key={item.id} className="wishlist-item">
            <img 
              src={item.game.imageUrl || '/placeholder-game.jpg'} 
              alt={item.game.name} 
            />
            <div className="item-info">
              <h3>{item.game.name}</h3>
              <p>{item.game.platform}</p>
              <p>{item.game.genre}</p>
              <button 
                onClick={() => handleRemoveFromWishlist(item.game.id)}
                className="remove-button"
              >
                Remove
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default WishlistPage;
