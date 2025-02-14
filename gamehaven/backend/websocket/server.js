const WebSocket = require('ws');
const jwt = require('jsonwebtoken');

const wss = new WebSocket.Server({ port: 8080 });

// Store active connections
const clients = new Map();

wss.on('connection', function connection(ws, req) {
  // Extract token from URL
  const url = new URL(req.url, 'ws://localhost:8080');
  const token = url.searchParams.get('token');
  
  try {
    // Verify JWT token
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    const userId = decoded.id;
    
    // Store client connection
    clients.set(userId, ws);

    ws.on('message', function incoming(message) {
      // Broadcast message to all clients
      clients.forEach((client) => {
        if (client.readyState === WebSocket.OPEN) {
          client.send(JSON.stringify({
            type: 'message',
            data: JSON.parse(message)
          }));
        }
      });
    });

    ws.on('close', () => {
      clients.delete(userId);
    });

  } catch (err) {
    ws.close();
  }
});

module.exports = wss;
