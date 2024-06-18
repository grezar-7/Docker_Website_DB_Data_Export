#Use the official PHP image as the base image
FROM php:fpm
#Install PDO and PDO MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql
#Install unixODBC and configure PDO ODBC
RUN apt-get update && apt-get install unixodbc unixodbc-dev -y \
 && docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
 && docker-php-ext-install pdo_odbc
 #Install MySQLi extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
#Install Xdebug extension
RUN pecl install xdebug && docker-php-ext-enable xdebug
#install dependencies required for Composer
RUN apt-get update && apt-get install -y curl git unzip
#Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Set enviromental variables for composer (CHATGPT)
ENV COMPOSER_ALLOW_SUPERUSER=1

#Set working directory
WORKDIR /var/www/html

#Copy Composer file into container
COPY composer.json /var/www/html


#Run Composer install (if composer.json is in project)
RUN composer install

#Copy project files into container
COPY . /var/www/html

#Expose port 80
EXPOSE 80

#Start PHP-fpm
##CMD ["php-fpm"]

#if we switch to Apache:
##CMD ["apache2-foreground"]

#End of CHATGPT CODE
