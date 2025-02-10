import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Navbar from './Navbar';
import { getAuthUser } from '../utils/auth';
import { getApiUrl, logApiUrl, getAssetUrl } from '../utils/apiConfig';
import './Profile.css';

const Profile = () => {
  const navigate = useNavigate();
  const [userData, setUserData] = useState(null);
  const [avatar, setAvatar] = useState(null);
  const [avatarPreview, setAvatarPreview] = useState(null);
  const [error, setError] = useState('');
  const [message, setMessage] = useState('');
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [deletePassword, setDeletePassword] = useState('');
  const [deleteError, setDeleteError] = useState('');

  useEffect(() => {
    const user = getAuthUser();
    if (!user || !user.id) {
      console.log('No user data found, redirecting to login');
      navigate('/login');
      return;
    }
    fetchUserData(user.id);
  }, [navigate]);

  const fetchUserData = async (userId) => {
    try {
      const token = localStorage.getItem('jwt_token');
      if (!token || !userId) {
        throw new Error('Authentication required');
      }

      logApiUrl(`users/${userId}`); // Debug log

      const response = await fetch(getApiUrl(`users/${userId}`), {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      });

      console.log('Response status:', response.status);

      if (response.status === 401) {
        localStorage.removeItem('jwt_token');
        localStorage.removeItem('user_id');
        throw new Error('Authentication expired');
      }

      if (!response.ok) {
        throw new Error(`Request failed with status ${response.status}`);
      }

      const data = await response.json();
      console.log('Received user data:', data);
      setUserData(data);
      if (data.avatar_url) {
        // Convert relative path to full URL
        setAvatarPreview(getAssetUrl(data.avatar_url));
      }
    } catch (error) {
      console.error('Profile error:', error);
      setError(error.message);
      if (error.message.includes('Authentication')) {
        navigate('/login');
      }
    }
  };

  const handleAvatarChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      // Validate file type
      const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
      if (!validTypes.includes(file.type)) {
        setError('Please select a valid image file (JPG, PNG, or GIF)');
        return;
      }
      
      // Validate file size (5MB)
      if (file.size > 5 * 1024 * 1024) {
        setError('Image size should be less than 5MB');
        return;
      }

      console.log('Selected file:', {
        name: file.name,
        type: file.type,
        size: file.size
      });
      
      setAvatar(file);
      setAvatarPreview(URL.createObjectURL(file));
      setError(''); // Clear any previous errors
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!avatar) return;

    const userId = localStorage.getItem('user_id');
    const token = localStorage.getItem('jwt_token');
    
    if (!token || !userId) {
      setError('Authentication required');
      navigate('/login');
      return;
    }

    const formData = new FormData();
    formData.append('avatar', avatar);

    try {
      console.log('Uploading avatar...', {
        userId,
        fileName: avatar.name,
        fileType: avatar.type,
        fileSize: avatar.size
      });
      
      const response = await fetch(getApiUrl(`users/${userId}/avatar`), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        body: formData
      });

      const data = await response.json();
      console.log('Upload response:', data);

      if (!response.ok) {
        throw new Error(data.message || `Server returned ${response.status}`);
      }

      setMessage('Avatar updated successfully!');
      setAvatar(null);
      if (data.avatar_url) {
        setAvatarPreview(data.avatar_url);
      }
    } catch (error) {
      console.error('Update error:', error);
      setError('Failed to update avatar: ' + error.message);
    }
  };

  const handleDeleteAccount = async () => {
    try {
      const userId = localStorage.getItem('user_id');
      const token = localStorage.getItem('jwt_token');

      const response = await fetch(getApiUrl(`users/${userId}`), {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ password: deletePassword })
      });

      if (response.ok) {
        localStorage.removeItem('jwt_token');
        localStorage.removeItem('user_id');
        navigate('/login');
      } else {
        const data = await response.json();
        setDeleteError(data.message || 'Failed to delete account');
      }
    } catch (error) {
      setDeleteError('Failed to delete account');
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('jwt_token');
    localStorage.removeItem('user_id');
    navigate('/login');
  };

  if (!userData) {
    return <div className="profile-loading">
      <div className="loading-spinner"></div>
      Loading...
    </div>;
  }

  return (
    <div className="profile-page">
      <Navbar active="profile" />
      <div className="profile-container">
        <div className="profile-header">
          <h1>Your Profile</h1>
          <p>Manage your account settings</p>
        </div>

        <div className="profile-card">
          {error && <div className="error-message">{error}</div>}
          {message && <div className="success-message">{message}</div>}
          
          <div className="profile-grid">
            <div className="avatar-section">
              <div className="avatar-preview">
                {avatarPreview ? (
                  <img src={avatarPreview} alt="Profile" />
                ) : (
                  <div className="avatar-placeholder">
                    <i className="fas fa-user"></i>
                  </div>
                )}
              </div>
              <label className="avatar-upload-btn">
                <i className="fas fa-camera"></i>
                Change Avatar
                <input
                  type="file"
                  accept="image/*"
                  onChange={handleAvatarChange}
                  style={{ display: 'none' }}
                />
              </label>
            </div>

            <div className="profile-info">
              <div className="info-group">
                <label>Username</label>
                <p>{userData.username}</p>
              </div>
              <div className="info-group">
                <label>Email</label>
                <p>{userData.email}</p>
              </div>
              {/* Add more user info sections as needed */}
            </div>
          </div>

          {avatar && (
            <button className="save-button" onClick={handleSubmit}>
              <i className="fas fa-save"></i>
              <span>Save Changes</span>
            </button>
          )}

          {/* Add danger zone section */}
          <div className="danger-zone">
            <h3>Danger Zone</h3>
            <p>Once you delete your account, there is no going back. Please be certain.</p>
            <button 
              className="delete-account-btn" 
              onClick={() => setShowDeleteModal(true)}
            >
              <i className="fas fa-trash-alt"></i>
              Delete Account
            </button>
          </div>
        </div>
      </div>

      {/* Delete Account Confirmation Modal */}
      {showDeleteModal && (
        <div className="modal-overlay">
          <div className="modal-content">
            <div className="modal-header">
              <h3>Delete Account</h3>
              <p>This action cannot be undone.</p>
            </div>
            <div className="modal-body">
              {deleteError && <div className="error-message">{deleteError}</div>}
              <p>Please enter your password to confirm:</p>
              <input
                type="password"
                value={deletePassword}
                onChange={(e) => setDeletePassword(e.target.value)}
                placeholder="Enter your password"
              />
            </div>
            <div className="modal-footer">
              <button 
                className="cancel-delete"
                onClick={() => {
                  setShowDeleteModal(false);
                  setDeletePassword('');
                  setDeleteError('');
                }}
              >
                Cancel
              </button>
              <button 
                className="confirm-delete"
                onClick={handleDeleteAccount}
                disabled={!deletePassword}
              >
                Delete Account
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Profile;
