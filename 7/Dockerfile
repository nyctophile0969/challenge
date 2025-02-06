FROM php:8.2-apache

COPY . /var/www/html/

RUN mv /var/www/html/flag.txt /flag.txt

RUN chown -R www-data:www-data /var/www/html

RUN echo "display_errors=Off" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "log_errors=On" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/custom.ini


EXPOSE 80

CMD ["apache2-foreground"]