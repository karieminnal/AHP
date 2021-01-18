FROM php:7.3-apache

ENV DB_MYSQL_HOST=localhost
ENV DB_MYSQL_PORT=3306

COPY . /var/www/html/ahp_survey

WORKDIR /var/www/html/ahp_survey

sed -i 's/# \(.*multiverse$\)/\1/g' /etc/apt/sources.list && \
apt-get update && \
apt-get -y upgrade && \
apt-get install -y build-essential && \
apt-get install -y software-properties-common && \
apt-get install -y byobu curl git htop man unzip vim wget && \
rm -rf /var/lib/apt/lists/*

ADD root/.bashrc /root/.bashrc
ADD root/.gitconfig /root/.gitconfig
ADD root/.scripts /root/.scripts

EXPOSE 80