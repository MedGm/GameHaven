import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Login from './Login';
import Register from './components/Register';
import Home from './components/Home';
import Profile from './components/Profile';
import Games from './components/Games';
import AddGame from './components/AddGame';
import ReviewPage from './components/ReviewPage'; 
import WishlistPage from './components/WishlistPage';
import Marketplace from './components/Marketplace';
import TransactionPage from './components/TransactionPage';
import Chat from './components/Chat';
import './App.css';

function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/home" element={<Home />} />
          <Route path="/profile" element={<Profile />} />
          <Route path="/games" element={<Games />} />
          <Route path="/games/add" element={<AddGame />} />
          <Route path="/marketplace" element={<Marketplace />} />
          <Route path="/reviews" element={<ReviewPage />} />
          <Route path="/wishlist" element={<WishlistPage />} />
          <Route path="/transaction/:id" element={<TransactionPage />} />
          <Route path="/chat" element={<Chat />} />
          <Route path="/" element={<Navigate to="/home" />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
