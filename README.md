# GameHaven – Video Games Marketplace 🎮

![mainpage](https://github.com/user-attachments/assets/4857236b-59ed-4bae-8c2c-671a7f169d67)

Welcome to GameHaven, a full-stack web application that allows users to buy, sell, and trade video games securely. Built with Symfony (backend) and React 18 (frontend), GameHaven provides a dynamic user experience with features like secure authentication, game listings, wishlist management, and integrated payment processing using Stripe.

## 📌 Key Features
- **User Authentication:** JWT-based authentication with role-based access.
- **Game Listings:** Create, update, search, and manage game listings.
- **Wishlist Management:** Keep track of your favorite games.
- **Secure Payments:** Integrated with Stripe for payment processing.
- **Robust Backend:** RESTful API built with Symfony and Doctrine ORM.
- **Optimized Data Management:** Powered by PostgreSQL.
- **Responsive Frontend:** Modern React 18 UI with dynamic navigation.
  
## 🚀 Tech Stack
- **Backend:** [<img src="https://upload.wikimedia.org/wikipedia/commons/5/5d/Symfony_logo.svg" width="60" alt="Symfony Logo">], Doctrine ORM, LexikJWT, NelmioCorsBundle
- **Frontend:** [<img src="https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg" width="40" alt="React Logo"> React 18], React Router, Axios
- **Database:** [<img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Postgresql_elephant.svg" width="40" alt="PostgreSQL Logo"> PostgreSQL]
- **APIs & Tools:** [<img src="https://www.vectorlogo.zone/logos/getpostman/getpostman-icon.svg" width="40" alt="Postman Logo"> Postman], Stripe API

## 📁 Project Hierarchy
```
GameHaven/
├── backend/
│   ├── config/
│   ├── src/
│   ├── public/
│   └── ...
├── frontend/
│   ├── public/
│   ├── src/
│   │   ├── components/
│   │   ├── utils/
│   │   └── ...
│   └── package.json
└── README.md
```

## ⚙️ Setup & Installation

### Backend (Symfony)
1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/GameHaven.git
   cd GameHaven/backend
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```
   
3. **Create and configure the `.env` file:**
   ```bash
   cp .env.example .env
   ```
   Update the following fields in `.env`:
   - `DATABASE_URL`
   - `JWT_SECRET_KEY`, `JWT_PUBLIC_KEY`, `JWT_PASSPHRASE`
   - `CORS_ALLOW_ORIGIN`
   - `STRIPE_SECRET_KEY`, `STRIPE_PUBLIC_KEY`

4. **Generate JWT keys:**
   ```bash
   mkdir -p config/jwt
   openssl genpkey -algorithm RSA -out config/jwt/private.pem -aes256 -pass pass:your_passphrase
   openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem -passin pass:your_passphrase
   ```

5. **Database Setup:**
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

6. **Run Symfony server:**
   ```bash
   symfony server:start
   ```

### Frontend (React)
1. **Navigate to frontend directory:**
   ```bash
   cd ../frontend
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Configure environment variables:**
   - Copy `.env.example` to `.env` and update:
     - `REACT_APP_API_URL` (Backend API URL)
     - `REACT_APP_STRIPE_PUBLIC_KEY`

4. **Start the development server:**
   ```bash
   npm start
   ```
   The app should run at [http://localhost:3000](http://localhost:3000).

## 🛠️ Running & Testing the Application
- Use Postman for API testing.
- Browser-based testing for the frontend.
- Monitor logs for backend Symfony server and React development server for debugging.

## 🎯 Final Thoughts
GameHaven is designed to deliver a seamless gaming marketplace experience. Contributions, feedback, or issues are welcome—feel free to open an issue or a pull request.

---

Happy coding! 🚀🎮

[Connect with me on LinkedIn](https://www.linkedin.com/in/mohamed-el-gorrim-8052822a0/)
