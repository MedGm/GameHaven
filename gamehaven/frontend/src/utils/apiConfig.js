export const API_BASE_URL = process.env.REACT_APP_API_BASE_URL || 'https://localhost:8000';

export const getApiUrl = (endpoint) => {
  const cleanEndpoint = endpoint.startsWith('/') ? endpoint : `/${endpoint}`;
  return `${API_BASE_URL}/api${cleanEndpoint}`;
};

export const getAssetUrl = (path) => {
  if (!path) return null;
  
  // If path is already a full URL
  if (path.startsWith('http://') || path.startsWith('https://')) {
    return path;
  }
  
  // Clean the path and ensure it starts with /uploads/
  const cleanPath = path.startsWith('/') ? path : `/${path}`;
  return `${API_BASE_URL}${cleanPath}`;
};

// Debug helper
export const logApiUrl = (endpoint) => {
  console.log('Building URL:', {
    base: API_BASE_URL,
    endpoint,
    full: getApiUrl(endpoint)
  });
};