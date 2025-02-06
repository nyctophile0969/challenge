FROM php:8.2-apache

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

RUN mv /var/www/html/database /database

RUN chown -R www-data:www-data /database/notes.db

EXPOSE 80

CMD ["apache2-foreground"]