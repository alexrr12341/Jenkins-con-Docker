FROM php:apache-buster
RUN docker-php-ext-install pdo pdo_mysql mysqli json
RUN a2enmod rewrite
EXPOSE 80
WORKDIR /var/www/html
COPY ./wordpress /var/www/html
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
