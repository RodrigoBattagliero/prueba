# ./docker/php/Dockerfile
FROM php:7.2-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
apt-get install -y \
zlib1g-dev \
libpng-dev \
libxml2-dev \
screen

# Install and enable xDebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN touch /var/log/xdebug_remote.log
RUN chmod 777 /var/log/xdebug_remote.log

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

# Install PHP Extensions
RUN docker-php-ext-install bcmath \
		gd \
        sockets

RUN docker-php-ext-install soap

COPY composer.phar ./

#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '795f976fe0ebd8b75f26a6dd68f78fd3453ce79f32ecb33e7fd087d39bfeb978342fb73ac986cd4f54edd0dc902601dc') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
#RUN php composer-setup.php
#RUN php -r "unlink('composer-setup.php');"
RUN cp composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer 
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini