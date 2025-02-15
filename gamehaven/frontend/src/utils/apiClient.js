import { getApiUrl } from './apiConfig';

export const findUserByUsername = async (username) => {
  try {
    const response = await fetch(getApiUrl('users'));
    if (!response.ok) {
      throw new Error('Failed to fetch users');
    }
    
    const users = await response.json();
    return users.find(user => user.username === username);
  } catch (error) {
    console.error('Error finding user:', error);
    return null;
  }
};

const apiClient = async (url, options = {}) => {
  const token = localStorage.getItem('jwt_token');
  console.log('Using token:', token); // Debug log

  const headers = {
    'Accept': 'application/json',
    ...options.headers
  };

  // Only add Authorization header if token exists
  if (token) {
    headers['Authorization'] = `Bearer ${token}`;
    console.log('Added Authorization header:', headers['Authorization']); // Debug log
  }

  // Don't add Content-Type for FormData
  if (!(options.body instanceof FormData)) {
    headers['Content-Type'] = 'application/json';
  }

  try {
    const fullUrl = getApiUrl(url);
    console.log('Making API request:', {
      url: fullUrl,
      method: options.method || 'GET',
      headers
    });

    const response = await fetch(fullUrl, { ...options, headers });
    console.log('Response status:', response.status); // Debug log
    
    if (response.status === 401) {
      console.log('Authentication failed, clearing tokens');
      localStorage.removeItem('jwt_token');
      localStorage.removeItem('user_id');
      window.location.href = '/login';
      throw new Error('Authentication expired');
    }
    
    if (!response.ok) {
      throw new Error(`Request failed with status ${response.status}`);
    }

    return response.json();
  } catch (error) {
    console.error('API Error:', error);
    throw error;
  }
};

export default apiClient;
