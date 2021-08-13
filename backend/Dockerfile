FROM php:8.0-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN apt-get update
RUN apt-get install -y libzip-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN mkdir /app
RUN chown -R www-data:www-data /var/www
RUN apt-get update
RUN apt-get -y install sudo
#RUN apt-get install -y cron
#RUN apt-get install vim
#RUN apt-get install rsyslog

#CMD sudo a2enmod rewrite
#CMD service apache2 restart
WORKDIR /var/www/teknasyon

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
