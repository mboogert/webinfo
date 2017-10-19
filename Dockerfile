FROM php:7-apache

MAINTAINER Marcel Boogert <marcel@mtdb.nl>

ADD index.php /var/www/index.php

EXPOSE 80
