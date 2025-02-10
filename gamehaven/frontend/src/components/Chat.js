import React, { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import Navbar from './Navbar';
import './Chat.css';

const Chat = () => {
  const navigate = useNavigate();
  const [messages, setMessages] = useState([]);
  const [newMessage, setNewMessage] = useState('');
  const [error, setError] = useState('');
  const messagesEndRef = useRef(null);
  const token = localStorage.getItem('jwt_token');

  const scrollToBottom = () => {
    if (messagesEndRef.current) {
      messagesEndRef.current.scrollIntoView({ behavior: "smooth" });
    }
  };

  const fetchMessages = async () => {
    try {
      if (!token) {
        navigate('/login');
        return;
      }

      const response = await fetch(getApiUrl('chat/messages'), {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json'
        }
      });

      if (!response.ok) throw new Error('Failed to fetch messages');
      
      const data = await response.json();
      setMessages(data);
    } catch (error) {
      setError('Failed to load messages');
      console.error('Error:', error);
    }
  };

  useEffect(() => {
    fetchMessages();
    const interval = setInterval(fetchMessages, 5000); // Poll every 5 seconds
    return () => clearInterval(interval);
  }, []);

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!newMessage.trim()) return;

    try {
      const response = await fetch(getApiUrl('chat/messages'), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ message: newMessage })
      });

      if (!response.ok) throw new Error('Failed to send message');

      const data = await response.json();
      setMessages(prev => [...prev, data]);
      setNewMessage('');
    } catch (error) {
      setError('Failed to send message');
      console.error('Error:', error);
    }
  };

  return (
    <div className="chat-page">
      <Navbar active="chat" />
      <div className="chat-container">
        <div className="chat-header">
          <h1>Game Chat</h1>
          <button className="back-button" onClick={() => navigate('/home')}>
            <i className="fas fa-arrow-left"></i>
          </button>
        </div>

        {error && <div className="error-message">{error}</div>}

        <div className="messages-container">
          {messages.map((message) => (
            <div key={message.id} className="message">
              <img 
                src={message.user.avatarUrl || '/default-avatar.png'} 
                alt={message.user.username}
                className="user-avatar"
              />
              <div className="message-content">
                <div className="message-header">
                  <span className="username">{message.user.username}</span>
                  <span className="timestamp">
                    {new Date(message.createdAt).toLocaleString()}
                  </span>
                </div>
                <p className="message-text">{message.message}</p>
              </div>
            </div>
          ))}
          <div ref={messagesEndRef} />
        </div>

        <form onSubmit={handleSubmit} className="message-form">
          <input
            type="text"
            value={newMessage}
            onChange={(e) => setNewMessage(e.target.value)}
            placeholder="Type your message..."
            className="message-input"
          />
          <button type="submit" className="send-button">
            <i className="fas fa-paper-plane"></i>
          </button>
        </form>
      </div>
    </div>
  );
};

export default Chat;
