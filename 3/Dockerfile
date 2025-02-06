FROM php:8.2-apache

COPY . /var/www/html/

RUN mv /var/www/html/database /database

EXPOSE 80

CMD ["apache2-foreground"]