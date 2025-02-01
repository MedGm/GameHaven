export const parseJwt = (token) => {
  try {
    if (!token) return null;
    
    if (token.startsWith('Bearer ')) {
      token = token.slice(7);
    }

    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
      return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
  } catch (error) {
    console.error('Token parse error:', error);
    return null;
  }
};

export const verifyToken = () => {
  try {
    const token = localStorage.getItem('jwt_token');
    console.log('Verifying token:', token); // Debug log

    if (!token) {
      console.log('No token found'); // Debug log
      return false;
    }

    // Basic structure verification
    const parts = token.split('.');
    if (parts.length !== 3) {
      console.log('Invalid token structure'); // Debug log
      return false;
    }

    // Decode payload
    const payload = JSON.parse(atob(parts[1]));
    console.log('Token payload:', payload); // Debug log

    // Check expiration if exists
    if (payload.exp) {
      const now = Date.now() / 1000;
      if (now > payload.exp) {
        console.log('Token expired'); // Debug log
        return false;
      }
    }

    return true;
  } catch (error) {
    console.error('Token verification error:', error);
    return false;
  }
};

export const getAuthUser = () => {
  try {
    const token = localStorage.getItem('jwt_token');
    const userId = localStorage.getItem('user_id');

    if (!token || !userId) {
      return null;
    }

    return {
      id: userId,
      token: token
    };
  } catch (error) {
    console.error('Get auth user error:', error);
    return null;
  }
};
