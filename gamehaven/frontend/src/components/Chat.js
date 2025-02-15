import React, { useState, useEffect, useRef, useCallback } from 'react';
import data from '@emoji-mart/data';
import Picker from '@emoji-mart/react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import Navbar from './Navbar';
import './Chat.css';

const Chat = () => {
  const navigate = useNavigate();
  const [messages, setMessages] = useState([]);
  const [newMessage, setNewMessage] = useState('');
  const [error, setError] = useState('');
  const [showEmojiPicker, setShowEmojiPicker] = useState(false);
  const [selectedFile, setSelectedFile] = useState(null);
  const messagesEndRef = useRef(null);
  const fileInputRef = useRef(null);
  const token = localStorage.getItem('jwt_token');

  const scrollToBottom = () => {
    if (messagesEndRef.current) {
      messagesEndRef.current.scrollIntoView({ behavior: "smooth" });
    }
  };

  const fetchMessages = useCallback(async () => {
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
  }, [navigate, token]);

  useEffect(() => {
    fetchMessages();
    const interval = setInterval(fetchMessages, 5000);
    return () => clearInterval(interval);
  }, [fetchMessages]);

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  const handleFileSelect = (event) => {
    const file = event.target.files[0];
    if (file) {
      if (file.size > 5 * 1024 * 1024) { // 5MB limit
        setError('File size must be less than 5MB');
        return;
      }
      
      const fileExtension = file.name.split('.').pop().toLowerCase();
      if (!['pdf', 'docx'].includes(fileExtension)) {
        setError('Only PDF and DOCX files are allowed');
        if (fileInputRef.current) {
          fileInputRef.current.value = '';
        }
        return;
      }
      
      setSelectedFile(file);
      setError(''); // Clear any previous errors
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!newMessage.trim() && !selectedFile) return;

    const formData = new FormData();
    if (newMessage.trim()) {
      formData.append('message', newMessage);
    }
    if (selectedFile) {
      formData.append('file', selectedFile);
    }

    setNewMessage('');
    setSelectedFile(null);
    if (fileInputRef.current) {
      fileInputRef.current.value = '';
    }

    try {
      const response = await fetch(getApiUrl('chat/messages'), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        body: formData
      });

      if (!response.ok) {
        setError('Failed to send message');
        return;
      }

      const data = await response.json();
      setMessages(prev => [...prev, data]);
    } catch (error) {
      console.error('Error:', error);
    }
  };

  const handleEmojiSelect = (emoji) => {
    setNewMessage(prev => prev + emoji.native);
    setShowEmojiPicker(false);
  };

  const renderMessageContent = (message) => {
    return (
      <>
        {message.message && <p className="message-text">{message.message}</p>}
        {message.fileUrl && (
          <div className="message-attachment">
            {message.fileType === 'application/pdf' ? (
              <a 
                href={message.fileUrl} 
                target="_blank" 
                rel="noopener noreferrer" 
                className="file-attachment"
              >
                <i className="fas fa-file-pdf"></i>
                {message.fileUrl.split('/').pop().substring(13)} {/* Remove unique prefix */}
              </a>
            ) : message.fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ? (
              <a 
                href={message.fileUrl} 
                target="_blank" 
                rel="noopener noreferrer" 
                className="file-attachment"
              >
                <i className="fas fa-file-word"></i>
                {message.fileUrl.split('/').pop().substring(13)}
              </a>
            ) : (
              <a 
                href={message.fileUrl} 
                target="_blank" 
                rel="noopener noreferrer" 
                className="file-attachment"
              >
                <i className="fas fa-file"></i>
                Download File
              </a>
            )}
          </div>
        )}
      </>
    );
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
                {renderMessageContent(message)}
              </div>
            </div>
          ))}
          <div ref={messagesEndRef} />
        </div>

        <form onSubmit={handleSubmit} className="message-form">
          <div className="input-container">
            <button 
              type="button" 
              className="emoji-button"
              onClick={() => setShowEmojiPicker(!showEmojiPicker)}
            >
              <i className="far fa-smile"></i>
            </button>
            <input
              type="text"
              value={newMessage}
              onChange={(e) => setNewMessage(e.target.value)}
              placeholder="Type your message..."
              className="message-input"
            />
            <label className="file-input-label">
              <i className="fas fa-paperclip"></i>
              <input
                type="file"
                onChange={handleFileSelect}
                ref={fileInputRef}
                className="file-input"
                accept=".pdf,.docx,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
              />
            </label>
            {selectedFile && (
              <div className="selected-file">
                <span>{selectedFile.name}</span>
                <button 
                  type="button" 
                  onClick={() => setSelectedFile(null)}
                  className="remove-file"
                >
                  <i className="fas fa-times"></i>
                </button>
              </div>
            )}
            {showEmojiPicker && (
              <div className="emoji-picker-container">
                <Picker 
                  data={data} 
                  onEmojiSelect={handleEmojiSelect}
                  theme="dark"
                />
              </div>
            )}
          </div>
          <button type="submit" className="send-button">
            <i className="fas fa-paper-plane"></i>
          </button>
        </form>
      </div>
    </div>
  );
};

export default Chat;
