#!/bin/sh
set -eu

# Database migrations are safe to run repeatedly and ensure a fresh deployment
# has the current schema before Apache starts serving requests.
php artisan migrate --force
php artisan storage:link --force || true

exec "$@"

