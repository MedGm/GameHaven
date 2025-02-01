import React, { useState, useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import Navbar from './Navbar';
import './Marketplace.css';

const Marketplace = () => {
  const DEFAULT_GAME_IMAGE = 'uploads/placeholder-game.jpg';
  
  const navigate = useNavigate();
  const [listings, setListings] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [userGames, setUserGames] = useState([]);
  const [showCreateListing, setShowCreateListing] = useState(false);
  const [selectedGame, setSelectedGame] = useState(null);
  const [newListing, setNewListing] = useState({
    price: '',
    condition: 'new',
    description: ''
  });

  const fetchListings = useCallback(async () => {
    try {
      const token = localStorage.getItem('jwt_token');
      
      const listingsResponse = await fetch(getApiUrl('listings'), {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json',
        }
      });

      if (!listingsResponse.ok) {
        throw new Error('Failed to fetch listings');
      }

      const listingsData = await listingsResponse.json();
      
      // Transform the listings data to match our component's expected structure
      const transformedListings = listingsData
        .filter(listing => !listing.sold) // Only show unsold listings
        .map(listing => ({
          ...listing,
          game: {
            id: listing.gameId?.id,
            name: listing.gameId?.name,
            platform: listing.gameId?.platform,
            genre: listing.gameId?.genre,
            image_url: listing.gameId?.imageUrl || DEFAULT_GAME_IMAGE
          },
          user: listing.user // Keep the user data as is
        }));

      console.log('Transformed listings:', transformedListings);
      setListings(transformedListings);
    } catch (error) {
      console.error('Fetch listings error:', error);
      setError('Failed to load listings: ' + error.message);
    } finally {
      setLoading(false);
    }
  }, []);

  const fetchUserGames = useCallback(async () => {
    try {
      const token = localStorage.getItem('jwt_token');
      const response = await fetch(getApiUrl('games'), {
        headers: {
          'Authorization': `Bearer ${token}`,
        }
      });

      if (!response.ok) throw new Error('Failed to fetch games');
      
      const data = await response.json();
      setUserGames(data);
    } catch (error) {
      console.error('Failed to load games:', error);
    }
  }, []);

  useEffect(() => {
    fetchListings();
    fetchUserGames();
  }, [fetchListings, fetchUserGames]);

  const handleCreateListing = async (e) => {
    e.preventDefault();
    try {
      const token = localStorage.getItem('jwt_token');
      const response = await fetch(getApiUrl('listings'), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          ...newListing,
          game_id: selectedGame.id
        })
      });

      if (!response.ok) throw new Error('Failed to create listing');

      setShowCreateListing(false);
      setNewListing({ price: '', condition: 'new', description: '' });
      setSelectedGame(null);
      await fetchListings();
    } catch (error) {
      setError('Failed to create listing: ' + error.message);
    }
  };

  const handleBuy = async (listingId) => {
    try {
      const token = localStorage.getItem('jwt_token');
      const userId = localStorage.getItem('user_id');
      const listing = listings.find(l => l.id === listingId);

      if (!listing) {
        throw new Error('Listing not found');
      }

      // Check if buyer is the same as seller
      if (userId === listing.user.id.toString()) {
        setError("You can't buy your own listing!");
        return;
      }

      const response = await fetch(getApiUrl('transactions'), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          listing_id: listingId,
          buyer_id: parseInt(userId),
          seller_id: listing.user.id,
          price: listing.price,
          status: 'pending'
        })
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to create transaction');
      }

      // Show success message
      setError('');
      alert(`Purchase successful! Transaction ID: ${data.transaction.id}`);

      // Remove the sold listing from the display
      setListings(prevListings => prevListings.filter(l => l.id !== listingId));
    } catch (error) {
      console.error('Purchase error:', error);
      setError('Failed to process purchase: ' + error.message);
    }
  };

  const handleAddToWishlist = async (gameId) => {
    try {
      const token = localStorage.getItem('jwt_token');
      const response = await fetch(getApiUrl(`wishlist/${gameId}`), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        }
      });

      if (!response.ok) {
        const data = await response.json();
        throw new Error(data.message || 'Failed to add to wishlist');
      }

      // Show success message
      alert('Added to wishlist!');
    } catch (error) {
      console.error('Wishlist error:', error);
      setError('Failed to add to wishlist: ' + error.message);
    }
  };

  if (loading) return <div className="loading">Loading marketplace...</div>;

  return (
    <div className="marketplace-page">
      <Navbar active="marketplace" />
      <button className="back-button" onClick={() => navigate('/home')}>
        <i className="fas fa-arrow-left"></i>
      </button>

      <div className="marketplace-header">
        <h1>Game Marketplace</h1>
        <button 
          className="create-listing-button"
          onClick={() => setShowCreateListing(true)}
        >
          <i className="fas fa-plus"></i> Create Listing
        </button>
      </div>

      {error && <div className="error-message">{error}</div>}

      <div className="listings-grid">
        {listings.map(listing => (
          <div key={listing.id} className="listing-card">
            <img 
              src={listing?.game?.image_url || DEFAULT_GAME_IMAGE}
              alt={listing?.game?.name || 'Game'}
              className="listing-image"
              onError={(e) => {
                e.target.onerror = null;
                e.target.src = DEFAULT_GAME_IMAGE;
              }}
            />
            <div className="listing-info">
              <h3>{listing?.game?.name || 'Unknown Game'}</h3>
              <p className="listing-price">${listing?.price || '0'}</p>
              <p className="listing-condition">Condition: {listing?.condition || 'N/A'}</p>
              <p className="listing-description">{listing?.description || 'No description available'}</p>
              <div className="listing-seller-info">
                <img 
                  className="seller-avatar"
                  src={listing?.user?.avatarUrl || 'uploads/placeholder-avatar.png'}
                  alt="Seller Avatar" 
                />
                <span>Seller: {listing?.user?.username || 'Unknown Seller'}</span>
              </div>
              <div className="listing-actions">
                <button 
                  className="buy-button"
                  onClick={() => navigate(`/transaction/${listing.id}`)}
                >
                  Buy Now
                </button>
                <button 
                  className="wishlist-button"
                  onClick={() => handleAddToWishlist(listing.gameId.id)}
                >
                  <i className="fas fa-heart"></i> Add to Wishlist
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>

      {showCreateListing && (
        <div className="modal-overlay">
          <div className="modal-content">
            <h2>Create New Listing</h2>
            <form onSubmit={handleCreateListing}>
              <select
                value={selectedGame?.id || ''}
                onChange={(e) => setSelectedGame(userGames.find(g => g.id === parseInt(e.target.value)))}
                required
              >
                <option value="">Select Game</option>
                {userGames.map(game => (
                  <option key={game.id} value={game.id}>{game.name}</option>
                ))}
              </select>

              <input
                type="number"
                placeholder="Price"
                value={newListing.price}
                onChange={(e) => setNewListing({...newListing, price: e.target.value})}
                required
              />

              <select
                value={newListing.condition}
                onChange={(e) => setNewListing({...newListing, condition: e.target.value})}
                required
              >
                <option value="new">New</option>
                <option value="like-new">Like New</option>
                <option value="good">Good</option>
                <option value="fair">Fair</option>
              </select>

              <textarea
                placeholder="Description"
                value={newListing.description}
                onChange={(e) => setNewListing({...newListing, description: e.target.value})}
                required
              />

              <div className="modal-actions">
                <button type="button" onClick={() => setShowCreateListing(false)}>
                  Cancel
                </button>
                <button type="submit">Create Listing</button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default Marketplace;
