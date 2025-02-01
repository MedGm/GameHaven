import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { getApiUrl } from '../utils/apiConfig';
import './TransactionPage.css';
import Navbar from './Navbar';
import { loadStripe } from '@stripe/stripe-js';
import { Elements, CardElement, useStripe, useElements } from '@stripe/react-stripe-js';

const DEFAULT_GAME_IMAGE = `${process.env.REACT_APP_API_BASE_URL}/uploads/placeholder-game.jpg`;

// Move stripePromise outside the component
const stripePromise = loadStripe(process.env.REACT_APP_STRIPE_PUBLIC_KEY);

const TransactionPage = () => {
  const { listingId } = useParams();
  const navigate = useNavigate();
  const [listing, setListing] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    const fetchListing = async () => {
      try {
        const token = localStorage.getItem('jwt_token');
        const response = await fetch(getApiUrl(`listings/${listingId}`), {
          headers: {
            'Authorization': `Bearer ${token}`,
          }
        });

        if (!response.ok) throw new Error('Failed to fetch listing');
        const data = await response.json();

        // Transform the listing data to match our expected structure
        const transformedListing = {
          ...data,
          game: {
            id: data.gameId?.id,
            name: data.gameId?.name,
            platform: data.gameId?.platform,
            genre: data.gameId?.genre,
            image_url: data.gameId?.imageUrl || DEFAULT_GAME_IMAGE
          }
        };

        setListing(transformedListing);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchListing();
  }, [listingId]);

  const handlePaymentSuccess = (paymentIntent) => {
    alert('Payment successful!');
    navigate('/marketplace');
  };

  // Separate CheckoutForm into its own component file later
  const CheckoutForm = ({ listing, onSuccess }) => {
    const stripe = useStripe();
    const elements = useElements();
    const [error, setError] = useState(null);
    const [processing, setProcessing] = useState(false);

    const handleSubmit = async (event) => {
      event.preventDefault();
      setProcessing(true);

      if (!stripe || !elements) {
        return;
      }

      try {
        const token = localStorage.getItem('jwt_token');
        
        // First create the transaction
        const transactionResponse = await fetch(getApiUrl('transactions'), {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            listing_id: listing.id,
            buyer_id: parseInt(localStorage.getItem('user_id')),
            seller_id: listing.user.id,
            price: listing.price,
            status: 'pending'
          })
        });

        if (!transactionResponse.ok) {
          throw new Error('Failed to create transaction');
        }

        const transactionData = await transactionResponse.json();

        // Then create payment intent
        const intentResponse = await fetch(getApiUrl('payments/create-intent'), {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            amount: Math.round(listing.price * 100), // Convert to cents
            currency: 'usd',
            transaction_id: transactionData.transaction.id
          }),
        });

        if (!intentResponse.ok) {
          throw new Error('Failed to create payment intent');
        }

        const { clientSecret } = await intentResponse.json();

        // Complete payment
        const { error: stripeError, paymentIntent } = await stripe.confirmCardPayment(
          clientSecret,
          {
            payment_method: {
              card: elements.getElement(CardElement),
              billing_details: {
                name: listing.user.username,
              },
            },
          }
        );

        if (stripeError) {
          throw new Error(stripeError.message);
        }

        if (paymentIntent.status === 'succeeded') {
          onSuccess(paymentIntent);
        }
      } catch (error) {
        setError(error.message);
        console.error('Payment error:', error);
      } finally {
        setProcessing(false);
      }
    };

    return (
      <form onSubmit={handleSubmit} className="stripe-form">
        <div className="card-element-container">
          <CardElement
            options={{
              style: {
                base: {
                  fontSize: '16px',
                  color: '#ffffff',
                  '::placeholder': {
                    color: '#aab7c4'
                  }
                },
                invalid: {
                  color: '#fa755a',
                }
              }
            }}
          />
        </div>
        {error && <div className="error-message">{error}</div>}
        <button 
          type="submit" 
          className="payment-button"
          disabled={!stripe || processing}
        >
          {processing ? 'Processing...' : `Pay $${listing.price}`}
        </button>
      </form>
    );
  };

  if (loading) return <div className="loading">Loading transaction details...</div>;
  if (error) return <div className="error">{error}</div>;
  if (!listing) return <div className="error">Listing not found</div>;

  return (
    <div className="transaction-page">
      <Navbar active="marketplace" />
      <button className="back-button" onClick={() => navigate('/marketplace')}>
        <i className="fas fa-arrow-left"></i>
      </button>
      <div className="transaction-container">
        <h1>Complete Your Purchase</h1>
        <div className="item-details">
          <img 
            src={listing.game?.image_url || DEFAULT_GAME_IMAGE} 
            alt={listing.game?.name}
            onError={(e) => {
              e.target.onerror = null;
              e.target.src = DEFAULT_GAME_IMAGE;
            }}
          />
          <div className="item-info">
            <h2>{listing.game?.name}</h2>
            <p className="price">${listing.price}</p>
            <p className="platform">{listing.game?.platform}</p>
            <p className="condition">Condition: {listing.condition}</p>
            <p className="seller">Seller: {listing.user?.username}</p>
          </div>
        </div>

        <div className="payment-section">
          <h3>Payment Details</h3>
          {stripePromise && (
            <Elements stripe={stripePromise}>
              <CheckoutForm listing={listing} onSuccess={handlePaymentSuccess} />
            </Elements>
          )}
        </div>
      </div>
    </div>
  );
};

export default TransactionPage;
