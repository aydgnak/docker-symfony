FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql

# Install and enable xDebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Install APCu
RUN pecl install apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

# Install opcache
RUN docker-php-ext-install opcache