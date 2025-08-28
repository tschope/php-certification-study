# PHP Certification Study - Quiz System

A comprehensive quiz application designed to help developers test their PHP knowledge and prepare for PHP certification exams. The system features a Laravel 11 backend API with a modern Nuxt 3 frontend, providing an interactive quiz experience with real-time scoring and detailed result reviews.

## 🎯 Project Purpose

This application serves as a study tool for PHP developers who want to:
- Test their PHP knowledge with randomized questions
- Practice for PHP certification exams
- Track their progress and identify knowledge gaps
- Review detailed explanations for quiz answers
- Improve their understanding of PHP concepts

## 🏗️ Architecture

### Backend (Laravel 11)
- **API-first architecture** with RESTful endpoints
- **ULID primary keys** for better performance and security
- **Comprehensive validation** with custom request classes
- **Database relationships** for quiz sessions and answers
- **Modern PHP practices** with type declarations and strict validation

### Frontend (Nuxt 3)
- **Server-side rendering** for better SEO and performance
- **Vue 3 Composition API** with TypeScript support
- **PrimeVue component library** with Aura theme
- **Pinia state management** for quiz flow
- **Responsive design** with mobile-first approach

## 🚀 Features

- **Random Quiz Generation**: 30 questions randomly selected from the question pool
- **Real-time Progress Tracking**: Visual progress indicators during quiz
- **Instant Scoring**: Immediate feedback on quiz completion
- **Detailed Review**: Review all questions with correct answers and explanations
- **Session Management**: Persistent quiz sessions with ULID tracking
- **Responsive UI**: Works seamlessly on desktop and mobile devices
- **SEO Optimized**: Proper meta tags and structured data

## 🛠️ Technology Stack

### Backend
- **Laravel 11** - PHP framework
- **MySQL** - Database
- **Laravel Sanctum** - API authentication (ready for future implementation)
- **Spatie Packages** - Query Builder, Permissions, Activity Log
- **Custom Validation** - Request classes with business logic

### Frontend
- **Nuxt 3** - Vue.js framework
- **Vue 3** - JavaScript framework
- **TypeScript** - Type safety
- **PrimeVue 4** - UI component library
- **Pinia** - State management
- **vue-api-query** - API integration with models

### Development Environment
- **DDEV** - Local development environment
- **Node.js** - Frontend build tools
- **Composer** - PHP dependency management

## 📋 Prerequisites

Before running this project locally, ensure you have:

- [DDEV](https://ddev.readthedocs.io/en/stable/) installed and configured
- [Docker](https://www.docker.com/) running (required by DDEV)
- [Node.js](https://nodejs.org/) (v18 or higher)
- [Composer](https://getcomposer.org/) (will be handled by DDEV)

## 🚀 Local Development Setup with DDEV

### 1. Clone and Start DDEV

```bash
# Clone the repository
git clone <your-repository-url>
cd php-certification-study

# Start DDEV environment
ddev start
```

### 2. Backend Setup (Laravel)

```bash
# Install PHP dependencies
ddev composer install

# Copy environment file (if not exists)
cp .env.example .env

# Generate application key
ddev artisan key:generate

# Run database migrations
ddev artisan migrate

# Optional: Seed the database with sample questions
ddev artisan db:seed
```

### 3. Frontend Setup (Nuxt 3)

```bash
# Navigate to frontend directory and install dependencies
cd frontend
ddev npm install

# Copy frontend environment file
cp .env.example .env

# Start the Nuxt development server
ddev nuxt
```

### 4. Access the Application

Once both servers are running:

- **Frontend (Nuxt)**: https://php-certification-study.localhost.ddev.site:3000
- **Backend API (Laravel)**: https://php-certification-study.localhost.ddev.site/api
- **Laravel App**: https://php-certification-study.localhost.ddev.site

## 🔧 Environment Configuration

### Backend (.env)
The Laravel application uses standard Laravel environment variables. Key configurations:

```env
APP_NAME="PHP Certification Study"
APP_URL=https://php-certification-study.localhost.ddev.site
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=db
DB_PASSWORD=db
```

### Frontend (frontend/.env)
The Nuxt application supports the following environment variables:

```env
# Application Configuration
APP_URL=https://php-certification-study.localhost.ddev.site
APP_NAME=PHP Certification Study
APP_DESCRIPTION=Test your PHP knowledge with our comprehensive quiz system

# API Configuration
API_BASE_URL=/api

# SEO Configuration
SITE_AUTHOR=PHP Certification Study Team
SITE_KEYWORDS=PHP, certification, quiz, programming, web development
```

## 📁 Project Structure

```
php-certification-study/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   └── QuizController.php      # Main quiz API controller
│   │   └── Requests/
│   │       ├── StartQuizRequest.php    # Quiz start validation
│   │       └── SubmitAnswerRequest.php # Answer submission validation
│   └── Models/
│       ├── QuizSession.php             # Quiz session model
│       └── QuizAnswer.php              # Quiz answer model
├── database/
│   └── migrations/                     # Database schema
├── routes/
│   └── api.php                         # API routes
├── frontend/
│   ├── components/                     # Vue components
│   ├── composables/
│   │   └── useApi.ts                   # API integration
│   ├── pages/
│   │   ├── index.vue                   # Homepage
│   │   └── quiz/
│   │       ├── start.vue               # Quiz start page
│   │       ├── take.vue                # Quiz taking page
│   │       ├── result.vue              # Quiz results page
│   │       └── review.vue              # Quiz review page
│   ├── stores/
│   │   └── quiz.ts                     # Pinia quiz store
│   ├── plugins/
│   │   └── primevue.client.ts          # PrimeVue configuration
│   └── nuxt.config.ts                  # Nuxt configuration
└── README.md
```

## 🎮 How to Use

1. **Start a Quiz**: Navigate to the homepage and click "Start Quiz"
2. **Take the Quiz**: Answer 30 randomly selected questions
3. **Submit Answers**: Click "Next" after each question or "Finish Quiz" on the last question
4. **View Results**: See your score and performance summary
5. **Review Answers**: Click "Review Quiz" to see all questions with correct answers

## 🔄 Common DDEV Commands

```bash
# Start the development environment
ddev start

# Stop the development environment
ddev stop

# Restart the development environment
ddev restart

# Run Laravel Artisan commands
ddev artisan migrate
ddev artisan make:model ModelName
ddev artisan route:list

# Run Composer commands
ddev composer install
ddev composer update
ddev composer require package/name

# Run NPM commands (from project root)
ddev npm install
ddev npm run build
ddev nuxt  # Start Nuxt dev server

# Access database
ddev mysql

# View logs
ddev logs

# SSH into container
ddev ssh
```

## 🐛 Troubleshooting

### Common Issues

1. **DDEV not starting**: Ensure Docker is running and ports 80/443 are available
2. **Database connection errors**: Run `ddev restart` and check database credentials
3. **Frontend build errors**: Clear node_modules and reinstall: `ddev npm install`
4. **API 500 errors**: Check Laravel logs: `ddev logs`

### Useful Debug Commands

```bash
# Check DDEV status
ddev describe

# View application logs
ddev logs -f

# Clear Laravel caches
ddev artisan cache:clear
ddev artisan config:clear
ddev artisan route:clear

# Clear Nuxt cache
cd frontend && ddev npm run build
```

## 🚀 Deployment

For production deployment:

1. Set appropriate environment variables for your hosting platform
2. Configure your web server to serve the Nuxt application
3. Set up the Laravel API with proper database credentials
4. Configure CORS settings for cross-origin requests
5. Set up SSL certificates for HTTPS

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/new-feature`
3. Commit your changes: `git commit -am 'Add new feature'`
4. Push to the branch: `git push origin feature/new-feature`
5. Submit a pull request

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

## 🆘 Support

If you encounter any issues or have questions:

1. Check the troubleshooting section above
2. Review DDEV documentation: https://ddev.readthedocs.io/
3. Check Laravel documentation: https://laravel.com/docs
4. Check Nuxt documentation: https://nuxt.com/docs

---

**Happy coding and good luck with your PHP certification studies! 🎓**
