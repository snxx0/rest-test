FROM php:fpm-alpine
RUN docker-php-ext-install pdo_mysql \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --filename=composer --install-dir=/usr/local/bin \
    && php -r "unlink('composer-setup.php');"
COPY confs/php.ini /usr/local/etc/php
COPY confs/www.conf /usr/local/etc/php-fpm.d
COPY ../../html/composer.json .
RUN composer install && composer dump-autoload