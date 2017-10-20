FROM php:7-apache

MAINTAINER Marcel Boogert <marcel@mtdb.nl>

ADD swarm.png /var/www/html/swarm.png
ADD container-grey.png /var/www/html/container-grey.png
ADD container-green.png /var/www/html/container-green.png
ADD index.php /var/www/html/index.php

EXPOSE 80
