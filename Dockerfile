# FROM php:7.4-fpm
FROM nanoninja/php-fpm:7.4.4

COPY composer.lock composer.json /var/www/

# Set up the working directory
WORKDIR /var/www

COPY ./docker/php/php.ini $PHP_INI_DIR/php.ini

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-install gd
RUN docker-php-ext-install calendar

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN groupadd -g 1004 www
RUN useradd -u 1004 -ms /bin/bash -g www www

COPY . /var/www

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]