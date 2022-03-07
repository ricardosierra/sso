FROM sierratecnologia/php:7.4

MAINTAINER Ricardo Sierra <sierra.csi@gmail.com>

RUN sed -i -e "s/upload_max_filesize = 2M/upload_max_filesize = 128M/g" $PHP_INI_DIR/php.ini-production
RUN sed -i -e "s/post_max_size = 8M/post_max_size = 128M/g" $PHP_INI_DIR/php.ini-production
RUN sed -i -e "s/memory_limit = 128M/memory_limit = 256M/g" $PHP_INI_DIR/php.ini-production
RUN sed -i -e "s/upload_max_filesize = 2M/upload_max_filesize = 128M/g" $PHP_INI_DIR/php.ini-development
RUN sed -i -e "s/post_max_size = 8M/post_max_size = 128M/g" $PHP_INI_DIR/php.ini-development
RUN sed -i -e "s/memory_limit = 128M/memory_limit = 256M/g" $PHP_INI_DIR/php.ini-development

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
