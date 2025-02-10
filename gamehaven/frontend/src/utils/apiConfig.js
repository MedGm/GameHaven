export const API_BASE_URL = process.env.REACT_APP_API_BASE_URL || 'https://localhost:8000';

export const getApiUrl = (endpoint) => {
  const cleanEndpoint = endpoint.startsWith('/') ? endpoint : `/${endpoint}`;
  return `${API_BASE_URL}/api${cleanEndpoint}`;
};

export const getAssetUrl = (path) => {
  if (!path) return '';
  if (path.startsWith('http') || path.startsWith('//')) return path;  // NEW: Return absolute URLs as-is
  return `${process.env.REACT_APP_API_BASE_URL}/${path}`;
};

// Debug helper
export const logApiUrl = (endpoint) => {
  console.log('Building URL:', {
    base: API_BASE_URL,
    endpoint,
    full: getApiUrl(endpoint)
  });
};