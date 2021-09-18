FROM wyveo/nginx-php-fpm:latest
WORKDIR /usr/share/nginx/
COPY . /usr/share/nginx
COPY ./.docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
RUN rm -rf /usr/share/ngnix/html
RUN chmod -R 777 /usr/share/nginx/storage/*