# mello-media
FROM mellointeractive/backend-ubuntu:22.04

RUN apt-get update -y --fix-missing && \
    apt-get install -y \
    ffmpeg

WORKDIR /var/www
COPY . .

RUN mkdir -p bootstrap/cache
RUN mkdir -p storage/app storage/framework storage/logs
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data
RUN touch storage/logs/laravel.log
RUN chmod -R 775 storage bootstrap/cache
RUN usermod -a -G root www-data

RUN composer install
RUN php artisan optimize

CMD ["/usr/bin/supervisord"]
