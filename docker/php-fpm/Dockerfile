FROM php:8.4-fpm-alpine as development

RUN apk --update add --no-cache --virtual .build-deps $PHPIZE_DEPS zlib-dev \
    && pecl install xdebug \
    && docker-php-ext-install zip \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps

# Need to install composer, otherwise `composer install` fails during build because of missing PHP extensions.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM php:8.4-fpm-alpine as production

COPY --from=development /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=development /usr/lib /usr/lib
COPY --from=development /usr/local/lib /usr/local/lib

COPY . /app

CMD ["php-fpm"]
