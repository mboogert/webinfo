FROM php:7-apache

MAINTAINER Marcel Boogert <marcel@mtdb.nl>

COPY index.php /var/www/index.php

EXPOSE 80
