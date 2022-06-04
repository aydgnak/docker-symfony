FROM php:7.3-fpm

RUN apt-get update

# Install opcache
RUN docker-php-ext-install opcache

# Install And Enable xDebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Install And Enable APCu
RUN pecl install apcu
RUN docker-php-ext-enable apcu

# Install PDO MySQL Extension
RUN docker-php-ext-install pdo_mysql

# Install Zip Extension
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

# Install Unzip
RUN apt-get install -y unzip

# Install GD Extension
RUN apt-get install -y libgd-dev
RUN docker-php-ext-install gd

# Install XSL Extension
RUN apt install -y libxslt-dev
RUN docker-php-ext-install xsl

# Install Intl Extension
RUN docker-php-ext-install intl

# Install Git
RUN apt-get install -y git

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install npm
RUN apt-get install -y npm

COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html