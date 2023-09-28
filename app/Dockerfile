ARG PHP_VERSION=8.1

# this creates the php-fpm for this application. all it does is copy the application code
FROM ghcr.io/netlogix/docker/php-cli:$PHP_VERSION as app
ENV PHP_MEMORY_LIMIT=128m

COPY --chown=www-data:www-data . /var/www/

# Dev php-fpm image
FROM ghcr.io/netlogix/docker/php-cli-dev:$PHP_VERSION AS app_dev
ENV PHP_MEMORY_LIMIT=128m

CMD while true; do  sleep 1; done
