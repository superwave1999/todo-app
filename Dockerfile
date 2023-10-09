FROM php:8.2-cli-bullseye

ENV APP_ENV production
ENV APP_DEBUG false

# add supervisor
RUN apt update
RUN apt -y install supervisor
COPY ./docker/production/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

ADD . /var/www/html
WORKDIR /var/www/html

# add and configure php modules required by base laravel (many are excluded, supposedly enabled by default)
RUN install-php-extensions pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# add and configure extra php modules required by third-party packages
RUN install-php-extensions \
    zip \
    opcache \
    pcntl \
    sockets \
    swoole

RUN docker-php-ext-enable zip
RUN docker-php-ext-enable opcache
RUN docker-php-ext-enable pcntl
RUN docker-php-ext-enable sockets
RUN docker-php-ext-enable swoole

# add composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install \
       --no-interaction \
       --no-dev \
       --optimize-autoloader

# copy php config
COPY ./docker/production/php.ini /etc/php/8.2/cli/conf.d/99-sail.ini

# cleanup the environment
RUN apt-get -y autoremove && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# copy start script and start processes
EXPOSE 8001
COPY ./docker/production/start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container
ENTRYPOINT ["start-container"]
