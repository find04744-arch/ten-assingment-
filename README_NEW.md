# AI Prompt Sharing & Marketplace Platform

A modern, community-driven platform for users to create, discover, bookmark, and manage AI prompts for various AI tools such as ChatGPT, Gemini, Claude, Midjourney, and more.

## Project Overview

The **AI Prompt Marketplace** is a full-stack web application built with Laravel backend and React frontend, enabling users to:

- **Create & Publish** AI prompts with rich content
- **Discover & Explore** trending prompts through advanced search and filtering
- **Bookmark & Save** favorite prompts for later access
- **Rate & Review** prompts to help the community
- **Manage Subscription** with premium access for exclusive content
- **Analytics Dashboard** for creators to track prompt performance
- **Admin Moderation** system for content management

## Key Features

### 🔐 Authentication & Authorization

- User registration with email verification
- JWT-based token authentication
- Google OAuth social login
- Role-based access control (User, Creator, Admin)
- Secure password hashing with bcrypt

### 📝 Prompt Management

- Create, read, update, delete prompts (CRUD)
- Multiple visibility levels (Public, Private/Premium)
- Categorization and tagging system
- Difficulty levels (Beginner, Intermediate, Pro)
- Rich content support with thumbnail images
- Status tracking (Pending, Approved, Rejected)
- Featured prompts system

### 💬 Community Features

- Review and rating system (1-5 stars)
- Bookmark prompts for personal collection
- Copy tracking to monitor prompt usage
- Report inappropriate content with admin review
- Top creators leaderboard
- Trending prompts algorithm

### 💳 Payment Integration

- Stripe integration for premium subscriptions
- One-time $5 payment for annual premium access
- Transaction history and receipts
- Free tier with 3 prompt limit
- Unlimited prompts for premium users

### 📊 Analytics & Dashboards

- User Dashboard with subscription management
- Creator Dashboard with detailed analytics
- Charts using Recharts (Copy Growth, Prompt Growth)
- Admin Dashboard for platform management
- Real-time statistics and metrics

### 🛡️ Admin Features

- User management (create, update, delete roles)
- Prompt moderation (approve/reject with feedback)
- Report management and resolution
- Payment tracking and analytics
- Platform analytics and insights

### 🎨 Frontend Features

- Modern, responsive UI design
- Framer Motion animations
- Server-side search, filter, and sort
- Pagination (minimum 2 pages)
- MongoDB aggregation support
- Dark/Light theme toggle (optional)
- Loading spinners and error pages
- 404 error handling

## Technology Stack

### Backend

- **Framework**: Laravel 12
- **Database**: MySQL
- **Authentication**: Laravel Sanctum (API tokens)
- **Payment**: Stripe PHP SDK
- **Additional**:
    - Composer for dependency management
    - PHPUnit for testing
    - Laravel Tinker for debugging

### Frontend

- **Framework**: React 18
- **Routing**: React Router v6
- **Animation**: Framer Motion
- **Styling**: Tailwind CSS 4
- **HTTP Client**: Axios
- **State Management**: Zustand
- **Notifications**: React Toastify
- **Charts**: Recharts
- **Build Tool**: Vite 7

### Additional Libraries

```json
{
  "backend": [
    "laravel/sanctum": "API authentication",
    "stripe/stripe-php": "Payment processing",
    "php": "^8.2"
  ],
  "frontend": [
    "react": "UI library",
    "framer-motion": "Advanced animations",
    "react-router-dom": "Client-side routing",
    "zustand": "State management",
    "recharts": "Data visualization",
    "react-toastify": "Toast notifications",
    "axios": "HTTP requests",
    "stripe": "Payment handling"
  ]
}
```

## Project Structure

```
prompt-marketplace/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── PromptController.php
│   │   │       ├── ReviewController.php
│   │   │       ├── BookmarkController.php
│   │   │       ├── PaymentController.php
│   │   │       ├── ReportController.php
│   │   │       ├── AdminController.php
│   │   │       ├── DashboardController.php
│   │   │       └── UserController.php
│   │   └── Middleware/
│   │       ├── IsAdmin.php
│   │       ├── IsCreator.php
│   │       └── IsPremium.php
│   └── Models/
│       ├── User.php
│       ├── Prompt.php
│       ├── Review.php
│       ├── Bookmark.php
│       ├── Payment.php
│       └── Report.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   ├── js/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── store/
│   │   ├── api/
│   │   ├── layouts/
│   │   ├── App.jsx
│   │   └── main.jsx
│   └── css/
├── routes/
│   ├── api.php
│   └── web.php
├── tests/
├── config/
├── bootstrap/
├── storage/
├── public/
├── composer.json
├── package.json
├── vite.config.js
├── .env.example
└── README.md
```

## Installation & Setup

### Prerequisites

- PHP 8.2+
- Node.js 18+
- MySQL 8.0+
- Composer
- npm or yarn

### Backend Setup

1. **Clone the repository**

    ```bash
    git clone https://github.com/yourusername/prompt-marketplace.git
    cd prompt-marketplace
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Configure environment**

    ```bash
    cp .env.example .env
    # Edit .env with your database credentials and API keys
    php artisan key:generate
    ```

4. **Setup database**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5. **Generate JWT secret** (if using JWT)
    ```bash
    php artisan jwt:secret
    ```

### Frontend Setup

1. **Install npm dependencies**

    ```bash
    npm install
    ```

2. **Configure environment**

    ```bash
    # Create .env.local in frontend root or use .env.example
    VITE_API_URL=http://localhost:8000/api
    VITE_APP_URL=http://localhost:5173
    ```

3. **Build frontend assets**
    ```bash
    npm run build
    ```

### Running the Application

1. **Start Laravel development server**

    ```bash
    php artisan serve
    ```

2. **Start React development server** (in separate terminal)

    ```bash
    npm run dev
    ```

3. **Start queue listener** (for email notifications)
    ```bash
    php artisan queue:listen
    ```

## API Endpoints

### Authentication

- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User login
- `POST /api/auth/google` - Google OAuth login
- `POST /api/auth/logout` - User logout
- `POST /api/auth/refresh-token` - Refresh JWT token

### Prompts (Public)

- `GET /api/prompts` - Get all public prompts with search/filter
- `GET /api/prompts/featured` - Get featured prompts
- `GET /api/prompts/trending` - Get trending prompts
- `GET /api/prompts/{id}` - Get single prompt details

### Prompts (Authenticated)

- `POST /api/prompts` - Create new prompt
- `PUT /api/prompts/{id}` - Update prompt
- `DELETE /api/prompts/{id}` - Delete prompt
- `GET /api/prompts/my-prompts` - User's prompts
- `POST /api/prompts/{id}/copy` - Increment copy count

### Reviews

- `GET /api/prompts/{id}/reviews` - Get prompt reviews
- `POST /api/prompts/{id}/review` - Submit review
- `PUT /api/reviews/{id}` - Update review
- `DELETE /api/reviews/{id}` - Delete review

### Bookmarks

- `GET /api/user/bookmarks` - Get user bookmarks
- `POST /api/prompts/{id}/bookmark` - Toggle bookmark

### Payments

- `POST /api/payments/create-checkout` - Create Stripe checkout
- `GET /api/payments/success` - Payment success handler
- `GET /api/payments/history` - Payment history

### Dashboard

- `GET /api/user/profile` - Get user profile
- `PUT /api/user/profile` - Update profile
- `GET /api/dashboard/stats` - User dashboard stats

### Admin (Require admin role)

- `GET /api/admin/dashboard` - Admin dashboard
- `GET /api/admin/users` - All users
- `PUT /api/admin/users/{id}/role` - Update user role
- `GET /api/admin/prompts` - All prompts for moderation
- `PUT /api/admin/prompts/{id}/approve` - Approve prompt
- `PUT /api/admin/prompts/{id}/reject` - Reject prompt

## Environment Variables

### Backend (.env)

```
APP_NAME="AI Prompt Marketplace"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prompt_marketplace
DB_USERNAME=root
DB_PASSWORD=

JWT_SECRET=your-secret-key
JWT_ALGORITHM=HS256
JWT_EXPIRATION=604800

GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret

STRIPE_PUBLIC_KEY=your-stripe-public-key
STRIPE_SECRET_KEY=your-stripe-secret-key
STRIPE_WEBHOOK_SECRET=your-webhook-secret

VITE_API_URL=http://localhost:8000/api
VITE_APP_URL=http://localhost:5173
```

### Frontend (.env.local)

```
VITE_API_URL=http://localhost:8000/api
VITE_APP_URL=http://localhost:5173
```

## Features Documentation

### User Roles

1. **User** (default)
    - View public prompts
    - Create up to 3 prompts
    - Bookmark prompts
    - Write reviews
    - Report prompts
    - Access to dashboard

2. **Creator** (optional upgrade)
    - All User features
    - Unlimited prompt creation
    - Detailed analytics dashboard
    - Prompt performance tracking

3. **Admin** (special role)
    - All User/Creator features
    - Moderate prompts (approve/reject)
    - Manage users and roles
    - View platform analytics
    - Handle reports and warnings
    - Feature prompts

### Premium Features

- Unlimited prompt creation
- Access to all private/premium prompts
- Premium badge on profile
- Enhanced analytics

### Search & Filtering

- **Search by**: Prompt title, tags, AI tool
- **Filter by**: Category, AI tool, difficulty level
- **Sort by**: Most popular, most copied, latest
- **Server-side**: All operations handled by backend

## Database Schema

### Users Table

- id, name, email, password, photo_url, role, subscription_status, subscription_expires_at, etc.

### Prompts Table

- id, user_id, title, description, content, category, ai_tool, tags, difficulty_level, thumbnail_image, visibility, copy_count, status, is_featured, timestamps

### Reviews Table

- id, prompt_id, user_id, rating (1-5), comment, timestamps

### Bookmarks Table

- id, user_id, prompt_id, timestamps

### Payments Table

- id, user_id, stripe_transaction_id, amount, currency, status, payment_method, description, timestamps

### Reports Table

- id, user_id, prompt_id, reason, description, status, timestamps

## Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AuthTest.php

# Run with coverage
php artisan test --coverage
```

## Deployment

### Backend Deployment (Production)

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Run migrations: `php artisan migrate --force`
3. Cache config: `php artisan config:cache`
4. Install production dependencies: `composer install --no-dev`
5. Configure web server (Nginx/Apache) with Laravel root at `public/`

### Frontend Deployment (Production)

1. Build production assets: `npm run build`
2. Deploy `dist/` folder to hosting
3. Configure CORS on backend to accept frontend domain
4. Update `VITE_API_URL` for production API endpoint

## Performance Optimization

- Pagination on all list endpoints (12-20 items per page)
- Database indexing on frequently queried columns
- Eager loading with Eloquent relationships
- Query optimization with aggregations
- Frontend bundle code-splitting with Vite
- Lazy loading of React components
- Image optimization and caching

## Security Features

- CSRF protection with Laravel middleware
- XSS prevention with proper output escaping
- SQL injection prevention with prepared statements
- Password hashing with bcrypt
- JWT token validation
- Role-based authorization middleware
- Rate limiting on API endpoints
- HTTPS only in production
- Secure environment variable handling

## Commits Structure

The project includes meaningful commits for both client and server side:

- **Client commits**: React component creation, page implementation, animations
- **Server commits**: API endpoint creation, model/migration creation, authorization logic

Each commit follows conventional commit format:

```
feat(scope): add new feature
fix(scope): fix bug
docs(scope): update documentation
refactor(scope): refactor code
test(scope): add tests
```

## Future Enhancements

- [ ] Real-time notifications
- [ ] Prompt forking system
- [ ] AI prompt testing with OpenAI/Gemini API
- [ ] Download prompt as PDF
- [ ] Rich text editor with markdown support
- [ ] Infinite scroll pagination
- [ ] Trending algorithm improvements
- [ ] Social media prompt sharing
- [ ] Prompt version history
- [ ] Team collaboration features

## License

This project is licensed under the MIT License - see LICENSE file for details.

## Support

For support, email support@promptmarketplace.com or open an issue on GitHub.

## Contributors

- Project Lead: [Your Name]
- Backend Developer: [Your Name]
- Frontend Developer: [Your Name]

## Live Deployment

- **Frontend URL**: [Your deployed frontend URL]
- **Backend URL**: [Your deployed backend URL]
- **Admin Email**: [admin email]
- **Admin Password**: [Will be provided separately]

---

**Last Updated**: June 22, 2026
**Version**: 1.0.0
