#!/bin/sh
set -eu

PORT_TO_USE="${PORT:-8080}"

# Ensure Laravel required directories exist and are writable
mkdir -p /var/www/html/storage/framework/{cache,sessions,views} || true
mkdir -p /var/www/html/storage/logs || true
mkdir -p /var/www/html/bootstrap/cache || true
# Relax permissions for web user
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R ug+rw /var/www/html/storage /var/www/html/bootstrap/cache || true

# Optional: create storage symlink if missing (non-fatal)
if [ ! -e /var/www/html/public/storage ]; then
  php /var/www/html/artisan storage:link >/dev/null 2>&1 || true
fi

# Run Prisma migrations (if Prisma is present and DATABASE_URL is set)
if command -v npx >/dev/null 2>&1 && [ -n "${DATABASE_URL:-}" ]; then
  if [ -f /var/www/html/package.json ] && [ -d /var/www/html/prisma ]; then
    (cd /var/www/html && npx prisma migrate deploy >/dev/null 2>&1 || true)
  fi
fi

# Update Apache to listen on Render's assigned port
sed -i "s/^Listen .*/Listen ${PORT_TO_USE}/" /etc/apache2/ports.conf || true
# Update VirtualHost port
sed -i "s#<VirtualHost \*:.*>#<VirtualHost *:${PORT_TO_USE}>#" /etc/apache2/sites-available/000-default.conf || true

# Start Apache in foreground
exec apache2-foreground
