FROM php:7.2.6-fpm-alpine as development

RUN apk --update add --no-cache --virtual .build-deps $PHPIZE_DEPS zlib-dev \
    && pecl install xdebug-2.6.1 \
    && docker-php-ext-install zip \
    && apk del .build-deps

# Need to install composer, otherwise `composer install` fails during build because of missing PHP extensions.
COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM php:7.2.6-fpm-alpine as production

COPY --from=dev /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=dev /usr/lib /usr/lib
COPY --from=dev /usr/local/lib /usr/local/lib

COPY . /app

CMD ["php-fpm"]
