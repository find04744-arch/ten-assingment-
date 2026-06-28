# SETUP & IMPLEMENTATION GUIDE

## AI Prompt Marketplace Platform - Quick Start Guide

This guide provides step-by-step instructions for setting up and running the complete project.

### Phase 1: Initial Setup (15 minutes)

#### 1.1 Backend Setup

```bash
# Navigate to project directory
cd "e:/Project GIL/Marketplace Platform"

# Install PHP dependencies
composer install

# Generate application key
php artisan key:generate

# Copy and configure .env file
cp .env.example .env

# Create database (configure DB credentials in .env first)
# Then run migrations:
php artisan migrate

# Create storage symlink for file uploads
php artisan storage:link
```

#### 1.2 Frontend Setup

```bash
# Install npm dependencies
npm install

# Verify Tailwind CSS is configured
npm run build
```

### Phase 2: Configuration

#### 2.1 Configure .env File

Edit `.env` with these critical settings:

```env
APP_NAME="AI Prompt Marketplace"
APP_URL=http://localhost:8000

# Database (adjust to your MySQL setup)
DB_DATABASE=prompt_marketplace
DB_USERNAME=root
DB_PASSWORD=

# JWT & Auth
JWT_SECRET=base64:your-generated-secret-here
JWT_ALGORITHM=HS256
JWT_EXPIRATION=604800

# Google OAuth (get from Google Cloud Console)
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret

# Stripe (get from Stripe Dashboard)
STRIPE_PUBLIC_KEY=pk_test_...
STRIPE_SECRET_KEY=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...

# Frontend URLs
VITE_API_URL=http://localhost:8000/api
VITE_APP_URL=http://localhost:5173
```

#### 2.2 Configure Frontend Environment

Create `.env.local` in root directory:

```
VITE_API_URL=http://localhost:8000/api
VITE_APP_URL=http://localhost:5173
```

### Phase 3: Running the Application

#### 3.1 Terminal 1 - Laravel Server

```bash
php artisan serve
# Server runs at http://localhost:8000
```

#### 3.2 Terminal 2 - React Development Server

```bash
npm run dev
# Frontend runs at http://localhost:5173
```

#### 3.3 Terminal 3 (Optional) - Queue Listener

```bash
php artisan queue:listen
# For sending emails and async tasks
```

### Phase 4: Database Seeding (Optional)

```bash
# Create sample data
php artisan db:seed

# Or run migrations with seeding
php artisan migrate:fresh --seed
```

### Phase 5: Testing the APIs

Use Postman or curl to test endpoints:

```bash
# Register new user
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'

# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'

# Get public prompts
curl http://localhost:8000/api/prompts
```

## Project Structure Reference

### Backend Files Created

**Models** (`app/Models/`):

- ✅ User.php - Enhanced with roles and subscription
- ✅ Prompt.php - Main prompt model
- ✅ Review.php - Review/rating model
- ✅ Bookmark.php - Bookmark model
- ✅ Payment.php - Payment model
- ✅ Report.php - Report model

**Controllers** (`app/Http/Controllers/Api/`):

- ✅ AuthController.php - Authentication logic
- ✅ PromptController.php - Prompt CRUD operations
- ✅ ReviewController.php - Review management
- ✅ BookmarkController.php - Bookmark management
- ✅ PaymentController.php - Stripe integration
- ✅ ReportController.php - Report submission
- ✅ AdminController.php - Admin moderation
- ✅ DashboardController.php - Analytics
- ✅ UserController.php - User profile

**Middleware** (`app/Http/Middleware/`):

- ✅ IsAdmin.php - Admin verification
- ✅ IsCreator.php - Creator verification
- ✅ IsPremium.php - Premium verification

**Migrations** (`database/migrations/`):

- ✅ 2026_06_22_000001_update_users_table.php
- ✅ 2026_06_22_000002_create_prompts_table.php
- ✅ 2026_06_22_000003_create_reviews_table.php
- ✅ 2026_06_22_000004_create_bookmarks_table.php
- ✅ 2026_06_22_000005_create_payments_table.php
- ✅ 2026_06_22_000006_create_reports_table.php

**Routes** (`routes/api.php`):

- ✅ All API endpoints documented and configured

### Frontend Files Created

**Core** (`resources/js/`):

- ✅ main.jsx - Entry point
- ✅ App.jsx - Main app component with routing
- ✅ index.css - Tailwind CSS setup

**Store** (`resources/js/store/`):

- ✅ authStore.js - Zustand auth store

**API** (`resources/js/api/`):

- ✅ axiosInstance.js - Configured Axios with interceptors
- ✅ index.js - API service functions

**Layouts** (`resources/js/layouts/`):

- ✅ MainLayout.jsx - Main layout with navbar/footer
- ✅ DashboardLayout.jsx - Protected dashboard layout

**Components** (`resources/js/components/`):

- ✅ Navbar.jsx - Navigation bar
- ✅ Footer.jsx - Footer with Framer Motion
- ✅ LoadingSpinner.jsx - Loading state
- ✅ Sidebar.jsx - Dashboard sidebar

**Pages** (`resources/js/pages/`):

- ✅ HomePage.jsx - Landing page with animations
- ✅ AllPromptsPage.jsx - All prompts with filtering
- ✅ LoginPage.jsx - Login form
- ✅ RegisterPage.jsx - Registration form
- ✅ PromptDetailsPage.jsx - Prompt details
- ✅ PaymentPage.jsx - Payment page
- ✅ NotFoundPage.jsx - 404 page

**Dashboard Pages** (`resources/js/pages/dashboard/`):

- ✅ UserDashboard.jsx
- ✅ AddPromptPage.jsx
- ✅ MyPromptsPage.jsx
- ✅ SavedPromptsPage.jsx
- ✅ MyReviewsPage.jsx
- ✅ ProfilePage.jsx
- ✅ CreatorDashboard.jsx
- ✅ AdminDashboard.jsx

## Key Implementation Details

### Authentication Flow

1. User registers/logs in
2. Backend generates JWT token
3. Token stored in localStorage
4. Token sent with every API request via interceptor
5. Automatic redirect to login on 401 error

### Prompt Workflow

1. User creates prompt (pending status)
2. Admin reviews and approves/rejects
3. Approved prompts become public
4. Users can bookmark, copy, and review
5. Copy count incremented on each use

### Premium Subscription

1. Free users limited to 3 prompts
2. Payment via Stripe ($5)
3. Subscription set to expire in 1 year
4. Premium users get unlimited prompts + exclusive content access

### Search & Filter

- Server-side implementation ensures performance
- Supports search by title, tags, AI tool
- Filter by category, difficulty, ai_tool
- Sort by popularity, copies, latest

## Important Notes

### Security Checklist

- ✅ .env variables secure (not in git)
- ✅ JWT token validation on all protected routes
- ✅ CORS configured for frontend origin
- ✅ Password hashed with bcrypt
- ✅ SQL injection prevention via prepared statements
- ✅ XSS prevention via React escaping

### Performance Optimization

- ✅ Database indexing on key columns
- ✅ Eager loading with relationships
- ✅ Pagination (12-20 per page)
- ✅ Frontend code-splitting with Vite
- ✅ Lazy loading components

### Next Steps for Full Implementation

1. **Frontend Components** - Expand existing page templates with full UI
2. **Forms** - Implement registration, prompt creation, review forms
3. **Integration** - Connect Stripe for real payments
4. **Testing** - Add PHPUnit and Jest tests
5. **Deployment** - Setup production servers and CI/CD
6. **Email** - Configure email service for notifications
7. **Animations** - Enhance with more Framer Motion animations
8. **Dark Mode** - Implement dark/light theme toggle
9. **Real-time** - Add WebSocket for notifications
10. **Analytics** - Integrate Recharts for dashboards

## Troubleshooting

### Issue: "CORS error when calling API"

**Solution**: Make sure backend CORS is configured to accept frontend origin

```php
# config/cors.php
'paths' => ['api/*'],
'allowed_origins' => [env('APP_URL'), env('VITE_APP_URL')],
```

### Issue: "JWT token not working"

**Solution**: Check JWT_SECRET is properly configured

```bash
php artisan jwt:secret
```

### Issue: "Database connection error"

**Solution**: Verify DB credentials in .env and MySQL is running

```bash
php artisan migrate --verbose
```

### Issue: "Vite HMR not working"

**Solution**: Check vite.config.js HMR settings match your environment

## Support & Resources

- Laravel Docs: https://laravel.com/docs
- React Docs: https://react.dev
- Framer Motion: https://www.framer.com/motion/
- Tailwind CSS: https://tailwindcss.com
- Stripe Docs: https://stripe.com/docs

---

**Setup Completed!** 🎉

Your project structure is ready. Begin implementing the components and features as outlined in the main README.md file.
