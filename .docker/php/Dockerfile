FROM php:7.3-fpm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install PDO MySQL Extension
RUN docker-php-ext-install pdo_mysql

# Install opcache
RUN docker-php-ext-install opcache

# Install and enable xDebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Install APCu
RUN pecl install apcu
RUN docker-php-ext-enable apcu