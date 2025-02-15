import React, { useState, useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import './ReviewPage.css';
import Navbar from './Navbar';

const ReviewPage = () => {
  const navigate = useNavigate();
  const [reviews, setReviews] = useState([]);
  const [transactions, setTransactions] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [showAddReview, setShowAddReview] = useState(false);
  const [selectedTransaction, setSelectedTransaction] = useState(null);
  const [newReview, setNewReview] = useState({
    rating: 5,
    comment: ''
  });
  const [reviewerDetails, setReviewerDetails] = useState({});
  const [listingData, setListingData] = useState({});
  const [transactionsData, setTransactionsData] = useState({});

  const fetchReviews = useCallback(async () => {
    try {
      const token = localStorage.getItem('jwt_token');
      const response = await fetch(getApiUrl('reviews'), {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });

      if (!response.ok) throw new Error('Failed to fetch reviews');
      const data = await response.json();
      console.log('Raw reviews data:', data);
      setReviews(data || []);
      
      // Extract unique reviewer IDs and load their details
      const uniqueIds = [
        ...new Set(data.map(review => review.reviewer.id))
      ];
      const details = {};
      await Promise.all(
        uniqueIds.map(async id => {
          const res = await fetch(getApiUrl(`users/${id}`), {
            headers: { 'Authorization': `Bearer ${token}` }
          });
          if (res.ok) {
            const userData = await res.json();
            details[id] = userData;
          }
        })
      );
      setReviewerDetails(details);
      
      // Fetch listing details
      const listingIds = [
        ...new Set(
          data.map(review => review.transaction?.listingId)
              .filter(id => id)
        )
      ];
      const listingsFetched = {};
      await Promise.all(
        listingIds.map(async id => {
          const res = await fetch(getApiUrl(`listings/${id}`), {
            headers: { 'Authorization': `Bearer ${token}` }
          });
          if (res.ok) {
            listingsFetched[id] = await res.json();
          }
        })
      );
      setListingData(listingsFetched);
      
      // Fetch transaction details
      const transactionIds = [...new Set(data.map(review => review.transaction_id).filter(id => id))];
      const transactionsFetched = {};
      await Promise.all(
        transactionIds.map(async id => {
          const res = await fetch(getApiUrl(`transactions/${id}`), {
            headers: { 'Authorization': `Bearer ${token}` }
          });
          if (res.ok) transactionsFetched[id] = await res.json();
        })
      );
      setTransactionsData(transactionsFetched);
      
    } catch (error) {
      console.error('Reviews fetch error:', error);
      setError('Failed to load reviews: ' + error.message);
      setReviews([]);
    }
  }, []);

  const fetchUserTransactions = useCallback(async () => {
    try {
      const token = localStorage.getItem('jwt_token');
      
      const response = await fetch(getApiUrl('transactions/user/purchases'), {
        headers: { 'Authorization': `Bearer ${token}` }
      });
      if (!response.ok) throw new Error('Failed to fetch transactions');
      const purchaseData = await response.json();
      
      const unreviewedTransactions = purchaseData.filter(transaction => 
        !reviews.some(review => parseInt(review.transaction_id, 10) === transaction.id)
      );
      setTransactions(unreviewedTransactions);
    } catch (error) {
      console.error('Transactions fetch error:', error);
      setError('Failed to load transactions: ' + error.message);
      setTransactions([]);
    } finally {
      setLoading(false);
    }
  }, [reviews]);

  useEffect(() => {
    fetchReviews();
    fetchUserTransactions();
  }, [fetchReviews, fetchUserTransactions]);

  const handleCreateReview = async (e) => {
    e.preventDefault();
    try {
      const token = localStorage.getItem('jwt_token');
      const reviewerId = localStorage.getItem('user_id'); // Renamed from userId to reviewerId

      const response = await fetch(getApiUrl('reviews'), {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          transaction_id: selectedTransaction.id,
          reviewer_id: parseInt(reviewerId),
          reviewed_id: selectedTransaction.seller.id, // Use seller ID from transaction
          rating: parseInt(newReview.rating),
          comment: newReview.comment
        })
      });

      if (!response.ok) throw new Error('Failed to create review');

      // Refresh both reviews and transactions after creating a new review
      await Promise.all([
        fetchReviews(),
        fetchUserTransactions()
      ]);

      setShowAddReview(false);
      setNewReview({ rating: 5, comment: '' });
      setSelectedTransaction(null);
    } catch (error) {
      setError('Failed to create review: ' + error.message);
    }
  };

  if (loading) return <div className="loading">Loading reviews...</div>;

  return (
    <div className="review-page">
      <Navbar active="reviews" />
      <button className="back-button" onClick={() => navigate('/home')}>
        <i className="fas fa-arrow-left"></i>
      </button>

      <div className="review-header">
        <h1>Seller Reviews</h1>
        {transactions.length > 0 && (
          <button 
            className="add-review-button"
            onClick={() => setShowAddReview(true)}
          >
            <i className="fas fa-plus"></i> Add Review
          </button>
        )}
      </div>

      {error && <div className="error-message">{error}</div>}

      <div className="reviews-grid">
        {reviews.map(review => {
          // Parse rating as number to ensure correct comparison
          const ratingValue = parseInt(review.rating, 10);
          const reviewerId = review.reviewer?.id;
          const fetchedReviewer = reviewerDetails[reviewerId] || {};
          const reviewerName = fetchedReviewer.username || review.reviewer?.username || 'Unknown User';
          const date = new Date(review.created_at).toLocaleDateString();
          const transaction = transactionsData[review.transaction_id];
          // Use transaction.listing.gameId.name from fetched transaction data
          const gameName = transaction?.listing?.gameId?.name || 'Unknown Game';
          const sellerName = transaction?.seller?.username || review.reviewed?.username || 'Unknown Seller';
          
          return (
            <div key={review.id} className="review-card">
              <div className="review-header">
                <div className="reviewer-info">
                  <img 
                    className="review-avatar"
                    src={
                      fetchedReviewer.avatar_url
                        ? fetchedReviewer.avatar_url
                        : `${process.env.PUBLIC_URL}/uploads/placeholder-avatar.png`
                    }
                    alt="Reviewer Avatar" 
                  />
                  <span className="reviewer-name">{reviewerName}</span>
                  <span className="review-date">{date}</span>
                </div>
                <div className="rating">
                  {[...Array(5)].map((_, i) => (
                    <i 
                      key={i}
                      className={`fas fa-star ${i < ratingValue ? 'filled' : ''}`}
                    />
                  ))}
                </div>
              </div>
              {/* New seller and game information */}
              <div className="review-extra">
                <p>Seller: {sellerName}</p>
                <p>Game: {gameName}</p>
              </div>
              <p className="review-comment">{review.comment || 'No comment provided'}</p>
              {review.transaction && (
                <div className="review-game">
                  Game: {review.transaction?.listing?.gameId?.name || 'Unknown Game'}
                </div>
              )}
            </div>
          );
        })}
        {reviews.length === 0 && (
          <div className="no-reviews">
            <p>No reviews available yet.</p>
          </div>
        )}
      </div>

      {/* Show add review modal only if there are unreviewed transactions */}
      {showAddReview && transactions.length > 0 && (
        <div className="modal-overlay">
          <div className="modal-content">
            <h2>Write a Review</h2>
            <form onSubmit={handleCreateReview}>
              <select
                value={selectedTransaction?.id || ''}
                onChange={(e) => {
                  const selected = transactions.find(t => t.id === parseInt(e.target.value));
                  setSelectedTransaction(selected);
                }}
                required
              >
                <option value="">Select Purchase</option>
                {transactions.map(transaction => (
                  transaction?.listing?.gameId && (
                    <option key={transaction.id} value={transaction.id}>
                      {transaction.listing.gameId.name} - ${transaction.price}
                    </option>
                  )
                ))}
              </select>

              <div className="rating-select">
                {[...Array(5)].map((_, i) => (
                  <i
                    key={i}
                    className={`fas fa-star ${i < newReview.rating ? 'filled' : ''}`}
                    onClick={() => setNewReview({...newReview, rating: i + 1})}
                  />
                ))}
              </div>

              <textarea
                placeholder="Write your review..."
                value={newReview.comment}
                onChange={(e) => setNewReview({...newReview, comment: e.target.value})}
                required
              />

              <div className="modal-actions">
                <button type="button" onClick={() => setShowAddReview(false)}>
                  Cancel
                </button>
                <button type="submit">Submit Review</button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default ReviewPage;
