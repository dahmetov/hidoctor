#!/bin/sh
if [ "$@" = '/usr/local/bin/apache2-foreground' ] \
|| [ "$@" = '/var/www/html/vendor/bin/phpunit'  ]; then
    /usr/local/bin/dockerize -timeout 60s -wait tcp://${DB_HOST}:5432
    set -e
    echo 'october up'
    php artisan october:up
    echo 'october up'
fi
exec "$@"
