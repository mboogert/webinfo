FROM php:7-apache

MAINTAINER Marcel Boogert <marcel@mtdb.nl>

ADD background.png /var/www/html/background.png
ADD background-left.png /var/www/html/background-left.png
ADD background-right.png /var/www/html/background-right.png

ADD swarm-moby-blue.png /var/www/html/swarm-moby-blue.png
ADD swarm-moby-green.png /var/www/html/swarm-moby-green.png

ADD index.php /var/www/html/index.php

EXPOSE 80
