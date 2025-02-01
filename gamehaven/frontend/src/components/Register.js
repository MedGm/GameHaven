import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import './Register.css';

const Register = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    username: '',
    email: '',
    password: ''
  });
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError('');
    setSuccess('');

    try {
      const registerResponse = await fetch(getApiUrl('users'), {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
      });

      const registerData = await registerResponse.json();
      
      if (registerResponse.ok) {
        setSuccess('Registration successful! Logging you in...');
        
        const loginResponse = await fetch(getApiUrl('login'), {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          credentials: 'include',
          body: JSON.stringify({
            username: formData.username,
            password: formData.password
          })
        });

        const loginData = await loginResponse.json();

        if (loginResponse.ok) {
          localStorage.setItem('jwt_token', loginData.token);
          navigate('/home');
        } else {
          setError('Login failed after registration. Please try logging in manually.');
          setTimeout(() => navigate('/login'), 2000);
        }
      } else {
        setError(registerData.message || 'Registration failed');
      }
    } catch (error) {
      console.error('Registration error:', error);
      setError('Registration failed. Please try again.');
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="register-container">
      <form className="register-form" onSubmit={handleSubmit}>
        <h2>Create Account</h2>
        {error && <div className="error-message">{error}</div>}
        {success && <div className="success-message">{success}</div>}
        <input
          type="text"
          placeholder="Username"
          value={formData.username}
          onChange={(e) => setFormData({...formData, username: e.target.value})}
          required
          disabled={isLoading}
        />
        <input
          type="email"
          placeholder="Email"
          value={formData.email}
          onChange={(e) => setFormData({...formData, email: e.target.value})}
          required
          disabled={isLoading}
        />
        <input
          type="password"
          placeholder="Password"
          value={formData.password}
          onChange={(e) => setFormData({...formData, password: e.target.value})}
          required
          disabled={isLoading}
        />
        <button type="submit" disabled={isLoading}>
          {isLoading ? 'Creating Account...' : 'Register'}
        </button>
        <p className="login-link">
          Already have an account?<Link to="/login">Login here</Link>
        </p>
      </form>
    </div>
  );
};

export default Register;
