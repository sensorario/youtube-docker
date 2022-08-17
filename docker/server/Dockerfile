FROM php:8.1-apache
RUN apt-get -y update
RUN apt-get -y install git zip unzip libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-source delete
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./ /var/www/html
WORKDIR public
