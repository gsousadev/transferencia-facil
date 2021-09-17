FROM wyveo/nginx-php-fpm:latest
WORKDIR /usr/share/nginx/
COPY . /usr/share/nginx
RUN rm -rf /usr/share/ngnix/html
RUN chmod -R 777 /usr/share/nginx/storage/*
