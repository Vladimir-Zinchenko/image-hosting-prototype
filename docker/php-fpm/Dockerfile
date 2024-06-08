FROM phpdockerio/php:8.3-fpm
WORKDIR "/app"

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash;
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -; \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list;

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        php8.3-intl \
        php8.3-yaml \
        php8.3-mysql \
        gcc g++ make \
        nodejs \
        yarn \
        mc; \
    pecl install xdebug-3.1.5; \
    docker-php-ext-enable xdebug; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
