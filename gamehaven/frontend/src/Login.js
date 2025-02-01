import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { getApiUrl } from './utils/apiConfig';
import './Login.css';

const Login = () => {
  const navigate = useNavigate();
  const [credentials, setCredentials] = useState({ username: '', password: '' });
  const [error, setError] = useState('');

  const fetchUserData = async (token) => {
    try {
      const response = await fetch(getApiUrl('users'), {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json'
        }
      });

      if (!response.ok) {
        throw new Error('Failed to fetch user data');
      }

      const users = await response.json();
      console.log('Users list:', users);
      
      // Find the current user in the list
      const currentUser = users.find(user => user.username === credentials.username);
      
      if (currentUser) {
        console.log('Found current user:', currentUser);
        localStorage.setItem('user_id', currentUser.id.toString());
        return true;
      }
      return false;
    } catch (error) {
      console.error('Error fetching user data:', error);
      return false;
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      // 1. First login to get token
      const loginResponse = await fetch(getApiUrl('login'), {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(credentials)
      });
      
      const loginData = await loginResponse.json();
      console.log('Login response:', loginData);

      if (!loginResponse.ok || !loginData.token) {
        throw new Error(loginData.message || 'Invalid credentials');
      }

      // 2. Store the token
      const token = loginData.token;
      localStorage.setItem('jwt_token', token);
      
      // 3. Use token to fetch user data and get user ID
      const userFound = await fetchUserData(token);
      
      if (userFound) {
        navigate('/home');
      } else {
        throw new Error('Could not find user data');
      }
    } catch (error) {
      console.error('Login error:', error);
      setError(error.message);
    }
  };

  return (
    <div className="login-container">
      <form className="login-form" onSubmit={handleSubmit}>
        <h2>Login to GameHaven</h2>
        {error && <div className="error-message">{error}</div>}
        <input
          type="text"
          placeholder="Username"
          value={credentials.username}
          onChange={(e) => setCredentials({...credentials, username: e.target.value})}
        />
        <input
          type="password"
          placeholder="Password"
          value={credentials.password}
          onChange={(e) => setCredentials({...credentials, password: e.target.value})}
        />
        <button type="submit">Login</button>
        <p className="register-link">
          Don't have an account? <Link to="/register">Register here</Link>
        </p>
      </form>
    </div>
  );
};

export default Login;
