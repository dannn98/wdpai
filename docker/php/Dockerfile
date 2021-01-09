FROM php:7.4.3-fpm-alpine3.11

COPY . /app

VOLUME [ "/app" ]

RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;