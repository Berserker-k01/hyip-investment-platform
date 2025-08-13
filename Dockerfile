# --- Stage 1: Composer install (no dev) ---
FROM composer:2 AS vendor
WORKDIR /app

# Copy only composer files first to leverage Docker layer cache
COPY core/composer.json core/composer.lock* ./core/
RUN set -eux; \
    cd core; \
    composer install --no-dev --no-scripts --optimize-autoloader --no-interaction --prefer-dist \
      --ignore-platform-req=ext-pdo_pgsql

# --- Stage 2: Runtime with Apache & PHP ---
FROM php:8.2-apache

# System deps and PHP extensions
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
      libpq-dev \
      git \
      unzip; \
    docker-php-ext-install pdo pdo_pgsql; \
    a2enmod rewrite; \
    rm -rf /var/lib/apt/lists/*

# Set document root to /var/www/html/public and allow .htaccess overrides
RUN set -eux; \
    sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf; \
    printf "<Directory /var/www/html/public>\n    AllowOverride All\n</Directory>\n" > /etc/apache2/conf-available/laravel.conf; \
    a2enconf laravel

# Copy application source
WORKDIR /var/www/html
COPY core/ /var/www/html/
# Bring vendor from build stage
COPY --from=vendor /app/core/vendor/ /var/www/html/vendor/

# Ensure storage and cache are writable
RUN set -eux; \
    mkdir -p storage bootstrap/cache; \
    chown -R www-data:www-data storage bootstrap/cache

# At runtime, Render sets $PORT. Reconfigure Apache to listen on it, then start.
CMD ["bash", "-lc", "sed -i 's/^Listen .*/Listen ${PORT:-8080}/' /etc/apache2/ports.conf \
  && sed -i 's/<VirtualHost \*:.*>/<VirtualHost *:${PORT:-8080}>/' /etc/apache2/sites-available/000-default.conf \
  && apache2-foreground"]

# Expose default port (informational; Render will map $PORT)
EXPOSE 8080
