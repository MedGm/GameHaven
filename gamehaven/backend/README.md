# GameHaven API Documentation

## Authentication
- Base URL: `http://localhost:8000`
- All protected routes require authentication token
- Login first to get authentication token

### Authentication Endpoints
```
POST /login
GET /logout
```

## API Endpoints

### Games
```
GET /api/games                          # Get all games
GET /api/games/{id}                     # Get specific game
GET /api/games/platform/{platform}      # Get games by platform
GET /api/games/genre/{genre}           # Get games by genre
GET /api/games/search?q={searchTerm}   # Search games
POST /api/games                        # Create new game
PUT /api/games/{id}                    # Update game
DELETE /api/games/{id}                 # Delete game

Sample POST/PUT body:
{
    "name": "The Last of Us",
    "platform": "PS4",
    "genre": "Action",
    "release_date": "2013-06-14",
    "publisher": "Sony"
}
```

### Listings
```
GET /api/listings                    # Get all listings
GET /api/listings/{id}              # Get specific listing
POST /api/listings                  # Create new listing
PUT /api/listings/{id}              # Update listing
DELETE /api/listings/{id}           # Delete listing

Sample POST/PUT body:
{
    "price": 29.99,
    "condition": "Used - Like New",
    "description": "Barely used, comes with original case",
    "game_id": 1
}
```

### Reviews
```
GET /api/reviews                    # Get all reviews
GET /api/reviews/{id}              # Get specific review
POST /api/reviews                  # Create new review
DELETE /api/reviews/{id}           # Delete review

Sample POST body:
{
    "transaction_id": 1,
    "reviewer_id": 3,
    "rating": 5,
    "comment": "Great seller!"
}
```

### Transactions
```
GET /api/transactions                      # Get all transactions
GET /api/transactions/{id}                 # Get specific transaction
GET /api/transactions/user/purchases       # Get user's purchases
GET /api/transactions/user/sales           # Get user's sales
POST /api/transactions                     # Create new transaction
PUT /api/transactions/{id}                 # Update transaction
DELETE /api/transactions/{id}              # Delete transaction

Sample POST body:
{
    "listing_id": 1,
    "buyer_id": 2,
    "seller_id": 3,
    "price": 29.99,
    "payment_method": "PayPal"
}

Sample PUT body:
{
    "status": "completed",
    "payment_method": "Credit Card"
}
```

### Users
```
GET /api/users                     # Get all users
GET /api/users/{id}               # Get specific user
POST /api/users                   # Create new user
PUT /api/users/{id}               # Update user
DELETE /api/users/{id}            # Delete user

Sample POST body:
{
    "username": "johndoe",
    "email": "john@example.com",
    "password": "securepassword123"
}

Sample PUT body:
{
    "email": "newemail@example.com",
    "password": "newpassword123",
    "avatar_url": "https://example.com/avatar.jpg"
}
```

### Wishlist
```
GET /api/wishlist/{userId}        # Get user's wishlist
POST /api/wishlist               # Add game to wishlist
DELETE /api/wishlist/{id}        # Remove from wishlist

Sample POST body:
{
    "user_id": 3,
    "game_id": 5
}
```

## Testing in Postman

1. **Setup Environment**
   - Create a new environment in Postman
   - Add variable `baseUrl` with value `http://localhost:8000`

2. **Authentication**
   - Send POST request to `{{baseUrl}}/login` with credentials
   - Copy the authentication token from response
   - Add token to Authorization header: `Bearer <token>`

3. **Testing Endpoints**
   - Use the appropriate HTTP method (GET, POST, PUT, DELETE)
   - Use the correct endpoint path
   - For POST/PUT requests, include JSON body as shown in examples
   - Set Content-Type header to `application/json`

4. **Common Status Codes**
   - 200: Success
   - 201: Created
   - 400: Bad Request
   - 401: Unauthorized
   - 403: Forbidden
   - 404: Not Found
   - 500: Server Error

5. **Testing Tips**
   - Test CRUD operations in order: Create → Read → Update → Delete
   - Verify error handling with invalid data
   - Keep track of created resource IDs for subsequent requests
   - Test relationships between entities (e.g., creating a review requires valid transaction_id)
