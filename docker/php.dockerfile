FROM php:7.2-fpm

RUN apt update && \
    apt -qy install git unzip zlib1g-dev && \
    docker-php-ext-install sockets pcntl zip

WORKDIR /var/www

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

    