import React, { useState, useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl, getAssetUrl } from '../utils/apiConfig';
import './Games.css';
import Navbar from './Navbar';

const Games = () => {
  const navigate = useNavigate();
  const [games, setGames] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [searchTerm, setSearchTerm] = useState('');
  const [platform, setPlatform] = useState('');
  const [genre, setGenre] = useState('');

  const DEFAULT_PLACEHOLDER = `${process.env.REACT_APP_API_BASE_URL}/uploads/placeholder-game.jpg`;

  const fetchGames = useCallback(async (params = '') => {
    try {
      const token = localStorage.getItem('jwt_token');
      if (!token) {
        navigate('/login');
        return;
      }

      const response = await fetch(getApiUrl(`games${params}`), {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json'
        }
      });

      if (!response.ok) {
        throw new Error('Failed to fetch games');
      }

      const data = await response.json();
      // Map over the games to ensure image URLs are complete
      const gamesWithFullUrls = data.map(game => ({
        ...game,
        image_url: game.image_url ? getAssetUrl(game.image_url) : DEFAULT_PLACEHOLDER
      }));
      setGames(gamesWithFullUrls);
    } catch (error) {
      setError('Failed to load games');
      console.error('Error:', error);
    } finally {
      setLoading(false);
    }
  }, [navigate]);

  useEffect(() => {
    fetchGames();
  }, [fetchGames]); 

  const handleSearch = useCallback(async (e) => {
    e.preventDefault();
    setError('');
    
    try {
      if (searchTerm.trim()) {
        await fetchGames(`/search?q=${encodeURIComponent(searchTerm.trim())}`);
      } else {
        await fetchGames();
      }
    } catch (error) {
      setError('Search failed: ' + error.message);
      console.error('Search error:', error);
    }
  }, [searchTerm, fetchGames]);

  const handleSearchInput = (e) => {
    setSearchTerm(e.target.value);
    if (!e.target.value.trim()) {
      // Reset to all games when search is cleared
      fetchGames();
    }
  };

  const handlePlatformChange = useCallback((e) => {
    const newPlatform = e.target.value;
    setPlatform(newPlatform);
    if (newPlatform) {
      fetchGames(`/platform/${newPlatform}`);
    } else {
      fetchGames();
    }
  }, [fetchGames]);

  const handleGenreChange = useCallback((e) => {
    const newGenre = e.target.value;
    setGenre(newGenre);
    if (newGenre) {
      fetchGames(`/genre/${newGenre}`);
    } else {
      fetchGames();
    }
  }, [fetchGames]);

  const handleImageUpload = async (gameId, file) => {
    try {
      const token = localStorage.getItem('jwt_token');
      const formData = new FormData();
      formData.append('image', file);

      const response = await fetch(getApiUrl(`games/${gameId}/image`), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        body: formData
      });

      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Failed to upload image');
      }

      const data = await response.json();
      console.log('Image upload response:', data);

      if (data.image_url) {
        // Update the game in the local state
        setGames(prevGames => prevGames.map(game => 
          game.id === gameId 
            ? { ...game, image_url: getAssetUrl(data.image_url) }
            : game
        ));
      }
    } catch (error) {
      setError('Failed to update game image: ' + error.message);
      console.error('Update error:', error);
    }
  };

  if (loading) {
    return <div className="loading">Loading games...</div>;
  }

  return (
    <div className="games-page">
      <Navbar active="games" />
      <button className="back-button" onClick={() => navigate('/home')}>
        <i className="fas fa-arrow-left"></i>
      </button>

      <div className="games-header">
        <h1>Game Library</h1>
      </div>

      <div className="games-controls">
        <form className="search-bar" onSubmit={handleSearch}>
          <input
            type="text"
            placeholder="Search games..."
            value={searchTerm}
            onChange={handleSearchInput}
          />
          <button type="submit">
            <i className="fas fa-search"></i>
          </button>
        </form>

        <div className="filters">
          <select 
            className="filter-select"
            value={platform}
            onChange={handlePlatformChange}
          >
            <option value="">All Platforms</option>
            <option value="PS5">PS5</option>
            <option value="PS4">PS4</option>
            <option value="Xbox">Xbox</option>
            <option value="Switch">Switch</option>
            <option value="PC">PC</option>
          </select>

          <select 
            className="filter-select"
            value={genre}
            onChange={handleGenreChange}
          >
            <option value="">All Genres</option>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="RPG">RPG</option>
            <option value="Sports">Sports</option>
            <option value="Strategy">Strategy</option>
          </select>
        </div>
      </div>

      {error && <div className="error-message">{error}</div>}

      <div className="games-grid">
        {games.map(game => (
          <div key={game.id} className="game-card">
            <div className="game-image-container">
              <img 
                src={game.image_url}
                alt={game.name}
                className="game-image"
                onError={(e) => {
                  e.target.onerror = null;
                  e.target.src = DEFAULT_PLACEHOLDER;
                }}
              />
              <label className="upload-image-btn">
                <i className="fas fa-camera"></i>
                <input
                  type="file"
                  accept="image/*"
                  onChange={(e) => handleImageUpload(game.id, e.target.files[0])}
                  style={{ display: 'none' }}
                />
              </label>
            </div>
            <div className="game-info">
              <h3 className="game-title">{game.name}</h3>
              <div className="game-details">
                <span>{game.publisher}</span>
                <span>{new Date(game.releaseDate).getFullYear()}</span>
                <span className="game-platform">{game.platform}</span>
              </div>
            </div>
          </div>
        ))}
      </div>

      <button className="add-game-button" onClick={() => navigate('/games/add')}>
        <i className="fas fa-plus"></i>
      </button>
    </div>
  );
};

export default Games;
