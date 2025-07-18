FROM php:8.4.10-zts-alpine3.22 as development

# Install dependencies
RUN apk --update add --no-cache \
    libzip-dev \
    && docker-php-ext-install \
    zip

# Need to install composer, otherwise `composer install` fails during build because of missing PHP extensions.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM php:8.4.10-zts-alpine3.22 as production

COPY --from=development /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=development /usr/lib /usr/lib
COPY --from=development /usr/local/lib /usr/local/lib

COPY . /app

CMD ["php-fpm"]
