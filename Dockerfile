FROM php:7-apache

MAINTAINER Marcel Boogert <marcel@mtdb.nl>

ADD swarm.png /var/www/html/swarm.png
ADD swarm-moby-blue.png /var/www/html/swarm-moby-blue.png
ADD swarm-moby-green.png /var/www/html/swarm-moby-green.png
ADD index.php /var/www/html/index.php

EXPOSE 80
