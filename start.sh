#!/bin/sh
set -eu

PORT_TO_USE="${PORT:-8080}"

# Update Apache to listen on Render's assigned port
sed -i "s/^Listen .*/Listen ${PORT_TO_USE}/" /etc/apache2/ports.conf || true
# Update VirtualHost port
sed -i "s#<VirtualHost \*:.*>#<VirtualHost *:${PORT_TO_USE}>#" /etc/apache2/sites-available/000-default.conf || true

# Start Apache in foreground
exec apache2-foreground
