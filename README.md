# Single-Page Digital Résumé

A modern, responsive single-page digital Résumé built with Laravel 12 and Tailwind CSS. This beginner-friendly project demonstrates Laravel fundamentals including the service container, request lifecycle, facades, routing, Blade templating, caching, and file system operations.

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-blue?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.0-06B6D4?style=flat-square&logo=tailwindcss)

## 📖 About This Project

This project focuses on building a clean, professional digital Résumé that showcases your skills, experience, and achievements in a modern web interface. More importantly, it serves as a practical learning tool for mastering Laravel's core concepts through real-world implementation. The Résumé content is dynamically sourced from local JSON files and processed using Laravel's powerful service container and file system abstractions.

This project is available through [CodeArch](https://codearch.app) - a curated collection of development projects broken down into manageable, step-by-step tasks. The Single Page Digital Résumé project guides you through building a complete Laravel application while learning core framework concepts.

📺 **[Watch the complete build process](https://youtu.be/mLTqmPnIU1k)** as we code together, building this entire application from scratch and explaining each step and decision along the way.
## 🚀 Quick Start

### Installation

#### Option 1: Local Development

This setup uses Composer and npm directly on your local machine. Assuming you have PHP, Composer, and Node.js installed, follow these steps:

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd single-page-digital-resume-laravel
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Build assets and start development server**
   In a new terminal:
   ```bash
   composer run dev
   ```

Your application will be available at `http://localhost:8000`

#### Option 2: Docker Development with Laravel Sail

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd single-page-digital-resume-laravel
   ```

2. **Install dependencies via Docker**
   ```bash
   ./vendor/bin/sail up -d
   ./vendor/bin/sail composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

5. **Install frontend dependencies and build assets**
   ```bash
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run dev
   ```
    
Your application will be available at `http://localhost`

**Happy coding! 🚀**
