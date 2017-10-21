FROM php:7-apache

MAINTAINER Marcel Boogert <marcel@mtdb.nl>

RUN apt-get update && \
    apt-get -y install git && \
    apt-get clean

RUN cd /var/www/html && \
    git clone git://github.com/nrk/predis.git

ADD background.png /var/www/html/background.png
ADD background-left.png /var/www/html/background-left.png
ADD background-right.png /var/www/html/background-right.png

ADD swarm-moby-blue.png /var/www/html/swarm-moby-blue.png
ADD swarm-moby-green.png /var/www/html/swarm-moby-green.png

ADD docker-host-blue.png /var/www/html/docker-host-blue.png
ADD docker-host-green.png /var/www/html/docker-host-green.png

ADD index.php /var/www/html/index.php
ADD redis.php /var/www/html/redis.php

EXPOSE 80
