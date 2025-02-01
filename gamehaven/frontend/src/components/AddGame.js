import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import './AddGame.css';

const AddGame = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    name: '',
    platform: '',
    genre: '',
    release_date: '',
    publisher: ''
  });
  const [image, setImage] = useState(null);
  const [imagePreview, setImagePreview] = useState(null);
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      // Validate file type
      if (!file.type.startsWith('image/')) {
        setError('Please select an image file');
        return;
      }
      
      // Validate file size (5MB)
      if (file.size > 5 * 1024 * 1024) {
        setError('Image size should be less than 5MB');
        return;
      }

      setImage(file);
      setImagePreview(URL.createObjectURL(file));
      setError('');
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');

    try {
      const token = localStorage.getItem('jwt_token');
      
      // First create the game
      const response = await fetch(getApiUrl('games'), {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(formData)
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to create game');
      }

      // If there's an image, upload it
      if (image && data.id) {
        const imageFormData = new FormData();
        imageFormData.append('image', image);

        const imageResponse = await fetch(getApiUrl(`games/${data.id}/image`), {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`
          },
          body: imageFormData
        });

        if (!imageResponse.ok) {
          console.error('Failed to upload image');
        }
      }

      navigate('/games');
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="add-game-page">
      <button className="back-button" onClick={() => navigate('/home')}>
        <i className="fas fa-arrow-left"></i>
      </button>

      <div className="add-game-container">
        <h1>Add New Game</h1>
        
        {error && <div className="error-message">{error}</div>}
        
        <form onSubmit={handleSubmit} className="add-game-form">
          {/* Image upload section */}
          <div className="form-group image-upload-section">
            <div className="image-preview">
              {imagePreview ? (
                <img src={imagePreview} alt="Game preview" />
              ) : (
                <div className="image-placeholder">
                  <i className="fas fa-image"></i>
                  <span>Add Game Image</span>
                </div>
              )}
            </div>
            <label className="image-upload-btn">
              <i className="fas fa-camera"></i>
              {image ? 'Change Image' : 'Upload Image'}
              <input
                type="file"
                accept="image/*"
                onChange={handleImageChange}
                style={{ display: 'none' }}
              />
            </label>
          </div>

          <div className="form-group">
            <label>Name</label>
            <input
              type="text"
              value={formData.name}
              onChange={(e) => setFormData({...formData, name: e.target.value})}
              required
            />
          </div>

          <div className="form-group">
            <label>Platform</label>
            <select
              value={formData.platform}
              onChange={(e) => setFormData({...formData, platform: e.target.value})}
              required
            >
              <option value="">Select Platform</option>
              <option value="PS5">PS5</option>
              <option value="PS4">PS4</option>
              <option value="Xbox">Xbox</option>
              <option value="Switch">Switch</option>
              <option value="PC">PC</option>
            </select>
          </div>

          <div className="form-group">
            <label>Genre</label>
            <select
              value={formData.genre}
              onChange={(e) => setFormData({...formData, genre: e.target.value})}
            >
              <option value="">Select Genre</option>
              <option value="Action">Action</option>
              <option value="Adventure">Adventure</option>
              <option value="RPG">RPG</option>
              <option value="Sports">Sports</option>
              <option value="Strategy">Strategy</option>
            </select>
          </div>

          <div className="form-group">
            <label>Release Date</label>
            <input
              type="date"
              value={formData.release_date}
              onChange={(e) => setFormData({...formData, release_date: e.target.value})}
              required
            />
          </div>

          <div className="form-group">
            <label>Publisher</label>
            <input
              type="text"
              value={formData.publisher}
              onChange={(e) => setFormData({...formData, publisher: e.target.value})}
            />
          </div>

          <div className="form-actions">
            <button type="button" onClick={() => navigate('/games')} className="cancel-button">
              Cancel
            </button>
            <button type="submit" disabled={loading} className="submit-button">
              {loading ? 'Adding...' : 'Add Game'}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default AddGame;
