# Stage 1 - Build Frontend (Vite)
# Uses a large Node image to handle all frontend dependencies and the Vite build process.
FROM node:18 AS frontend
WORKDIR /app

# Copy dependency files first to leverage Docker's build cache
COPY package*.json ./
RUN npm install

# Copy source code and build
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel + PHP + Composer)
# This is the final, minimal production image, updated to include PostgreSQL and Redis extensions.
FROM php:8.2-fpm AS backend

# Install necessary system dependencies (including libpq-dev for Postgres and libz-dev for Redis)
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip libz-dev \
    && rm -rf /var/lib/apt/lists/*

# Install core PHP extensions: PDO, MySQL, PostgreSQL, Multibyte String, and Zip
# NOTE: pdo_pgsql is required for your DB_CONNECTION=pgsql setting.
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# Install Redis extension via PECL (required for REDIS_CLIENT=phpredis)
RUN pecl install redis \
    && docker-php-ext-enable redis

# Clean up APT cache after install to reduce image size
RUN apt-get clean

# Install Composer by copying it from the official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# --- Application Code Copy and Dependency Installation (Combined) ---
# FIX APPLIED HERE: Copy all Laravel source files BEFORE composer install.
# This ensures 'artisan' can bootstrap the application (finding 'bootstrap/app.php') 
# when Composer runs the 'package:discover' script. This breaks the caching layer 
# but resolves the runtime dependency error.
COPY . .

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader

# Critical multi-stage step: Copy the built, optimized frontend assets
# Corrected source and destination paths to match your 'public/build' output.
COPY --from=frontend /app/public/build ./public/build

# Clear and optimize Laravel caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Start the PHP FastCGI Process Manager
CMD ["php-fpm"]