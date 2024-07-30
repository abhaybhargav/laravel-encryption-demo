# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Create storage and cache directories if they do not exist
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Set ownership and permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Debug step: Check if artisan file exists
RUN ls -la /var/www/html

# Copy the environment file
RUN cp .env.example .env

# Debug step: Display the content of the .env file
RUN cat .env

# Switch to www-data user
USER www-data

# Install application dependencies
RUN composer install --no-scripts

# Switch back to root user
USER root

# Debug step: Check if artisan file exists after composer install
RUN ls -la /var/www/html

# Ensure artisan file exists before running commands
RUN if [ -f "artisan" ]; then php artisan key:generate --force; else echo "artisan file not found"; fi
RUN if [ -f "artisan" ]; then php artisan config:cache; else echo "artisan file not found"; fi
RUN if [ -f "artisan" ]; then php artisan package:discover --ansi; else echo "artisan file not found"; fi

# Switch back to www-data user
USER www-data

# Expose port 80 (Apache default)
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
