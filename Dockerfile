FROM php:7.2-apache
COPY ./src /var/www/html
RUN docker-php-ext-install mysqli

# CMD php 1_read-file-contents.php && php 2_read-env-var.php  && php 3_read-secret-fixed-path.php && php 4_read-secret-path-from-env-var.php && php 5_connect-to-database-with-secrets.php 
