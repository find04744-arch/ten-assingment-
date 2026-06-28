# AI Prompt Sharing & Marketplace Platform

A modern **Laravel 12** web application for sharing, discovering, and monetizing AI prompts.

## 🚀 Quick Start

### Prerequisites

- PHP 8.2+
- MySQL 8.0+
- Composer
- npm/node.js (for Tailwind CSS and Vite)

### Installation

```bash
# Navigate to project
cd "e:/Project GIL/Marketplace Platform"

# Install PHP dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan  migrate

# Install frontend dependencies (Tailwind CSS)
npm install

# Build assets
npm run build

# Create storage link
php artisan storage:link
```

### Running the Application

```bash
# Start Laravel development server
php artisan serve

# In another terminal, watch for CSS changes
npm run dev
```

Visit `http://localhost:8000` in your browser.

## 📋 Features

### Authentication & Authorization

- ✅ User registration and login
- ✅ Session-based authentication
- ✅ Role-based access control (User, Creator, Admin)

### Prompt Management

- ✅ Create, read, update, delete prompts
- ✅ Public/private visibility control
- ✅ Difficulty levels (beginner/intermediate/pro)
- ✅ Tagging and categorization
- ✅ Server-side search, filter, and sort
- ✅ Pagination (12 items per page)

### Community Features

- ✅ Review and rating system (1-5 stars)
- ✅ Bookmark/save functionality
- ✅ Copy tracking
- ✅ Content reporting
- ✅ Top creators leaderboard

### Premium System

- ✅ One-time $5 Stripe payment
- ✅ Subscription management
- ✅ Free tier with 3 prompt limit
- ✅ Premium unlimited access

### Creator Dashboard

- ✅ Analytics and statistics
- ✅ Prompt performance tracking
- ✅ Copy and bookmark counts
- ✅ Rating overview

### Admin Panel

- ✅ User management
- ✅ Prompt moderation and approval
- ✅ Payment tracking
- ✅ Report management
- ✅ Platform analytics

## 🗄️ Database Schema

### Users Table

- Basic authentication fields
- Role: user | creator | admin
- Subscription status and expiration
- Profile information (bio, photo)

### Prompts Table

- Title, description, content
- Category, AI tool, tags
- Difficulty level, visibility, status
- Featured flag, copy count
- Thumbnail image

### Reviews Table

- Rating (1-5 stars)
- Comment/feedback text
- User and prompt relationships

### Bookmarks Table

- User bookmarks for prompts
- Unique constraint on user-prompt pair

### Payments Table

- Stripe transaction tracking
- Amount, currency, status
- Payment method and date

### Reports Table

- Content moderation reports
- Reason array, description
- Status tracking

## 🎨 UI/UX

- **Modern Design**: Clean professional interface using Tailwind CSS 4
- **Responsive**: Mobile-first design for all device sizes
- **Fast**: Server-side rendering for optimal performance
- **Accessible**: Form fields and navigation standards

## 🔐 Security

- ✅ Password hashing with bcrypt
- ✅ CSRF protection on forms
- ✅ XSS prevention with Blade escaping
- ✅ SQL injection prevention via Eloquent ORM
- ✅ Session-based authentication
- ✅ Authorization gates and policies
- ✅ Environment variable protection

## 📦 Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade Templates + Tailwind CSS 4
- **Database**: MySQL
- **Build Tool**: Vite 7
- **Payment**: Stripe
- **Authentication**: Laravel Session (Server-side)

## 🚀 Deployment

### Production Setup

1. **Environment Setup**

    ```bash
    cp .env.example .env
    # Edit .env with production values
    php artisan key:generate
    ```

2. **Database Migration**

    ```bash
    php artisan migrate --force
    ```

3. **Build Assets**

    ```bash
    npm run build
    ```

4. **Web Server Configuration**
    - Point document root to `public/` folder
    - Ensure `.env` file is not accessible
    - Set proper file permissions

5. **Production Mode**
    - Set `APP_DEBUG=false`
    - Set `APP_ENV=production`

## 📊 Route Summary

### Public Routes

- `GET /` - Home page
- `GET /prompts` - All prompts with filters
- `GET /prompts/{id}` - Prompt details with reviews
- `GET /login` - Login page
- `GET /register` - Registration page

### Protected Routes (Auth Required)

- `GET /dashboard` - User dashboard
- `GET /my-prompts` - User's prompts
- `GET /prompts/create` - Create prompt form
- `POST /prompts` - Create prompt
- `GET /prompts/{id}/edit` - Edit form
- `PUT /prompts/{id}` - Update prompt
- `DELETE /prompts/{id}` - Delete prompt
- `GET /saved-prompts` - Bookmarks
- `GET /profile` - User profile
- `PUT /profile` - Update profile
- `POST /prompts/{id}/bookmark` - Toggle bookmark
- `POST /prompts/{id}/review` - Add review
- `DELETE /reviews/{id}` - Delete review
- `POST /prompts/{id}/report` - Report content

### Creator Routes

- `GET /creator/dashboard` - Creator analytics
- `GET /creator/analytics` - Detailed analytics

### Admin Routes

- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - Manage users
- `GET /admin/prompts` - Moderate prompts
- `GET /admin/reports` - Manage reports
- `GET /admin/payments` - Payment tracking

## 🔄 Database Migrations

```bash
# Run all migrations
php artisan migrate

# Rollback latest
php artisan migrate:rollback

# Rollback all
php artisan migrate:reset

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

## 📊 Eloquent Models

- `User` - Platform users with roles
- `Prompt` - AI prompts content
- `Review` - Ratings and reviews
- `Bookmark` - Saved prompts
- `Payment` - Transaction records
- `Report` - Moderation reports

## 💳 Stripe Setup

1. Get API keys from [Stripe Dashboard](https://dashboard.stripe.com)
2. Update `.env`:
    ```
    STRIPE_PUBLIC_KEY=pk_test_...
    STRIPE_SECRET_KEY=sk_test_...
    ```
3. Create $5 product in Stripe
4. Setup webhook for payment events

## 🛠️ Development

### Artisan Commands

```bash
php artisan migrate          # Run migrations
php artisan tinker           # Interactive shell
php artisan db:seed          # Seed database
php artisan storage:link     # Link storage
```

### Testing

```bash
php artisan test
```

## 📧 Email Configuration

Configure in `.env`:

- `MAIL_MAILER`: 'log' for dev, 'smtp' for production
- `MAIL_FROM_ADDRESS`: Sender email
- `MAIL_FROM_NAME`: Display name

## 🐛 Troubleshooting

### 500 Error

- Check `.env` configuration
- Run `php artisan key:generate`
- Check `storage/logs`

### Database Error

- Verify MySQL is running
- Check database credentials in `.env`
- Run `php artisan migrate`

### File Upload Issues

- Run `php artisan storage:link`
- Check storage folder permissions
- Verify disk in `config/filesystems.php`

## 📄 License

MIT License

## 🤝 Contributing

1. Create feature branch
2. Make changes
3. Submit pull request

---

**Version**: 1.0.0  
**Laravel**: 12  
**Status**: Production Ready  
**Project Date**: June 2026


---

***Login Url : http://127.0.0.1:8001/login
***Email : admin@admin.com
***Password : password

***Laravel command : php artisan serve


