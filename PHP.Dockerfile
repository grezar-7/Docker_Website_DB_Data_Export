FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install unixodbc unixodbc-dev -y \
 && docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
 && docker-php-ext-install pdo_odbc

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN pecl install xdebug && docker-php-ext-enable xdebug