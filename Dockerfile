FROM php:8.3-apache

ARG XDE=0
ARG WORKING_DIR=/var/www/html

RUN apt-get update && apt-get install -y \
        apt-transport-https \
        curl \
        gnupg \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        git \
        zip \
        unzip \
        libsodium-dev \
        cron \
        vim \
        libpq-dev \
        supervisor\
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure sodium \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo \
    && docker-php-ext-install opcache \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo_pgsql


#Xdebug - should be removed for prod
RUN echo "Install XDE: ${XDE}"
RUN if [ $XDE -eq 1 ]; then pecl install xdebug; fi

COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/

# Set working directory
WORKDIR $WORKING_DIR

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY --chown=www-data:www-data . $WORKING_DIR

# Composer install
RUN composer install -o --no-cache
#RUN composer update --no-scripts
RUN composer dump-autoload

#Apache2
RUN rm -f /etc/apache2/sites-available/*
RUN rm -f /etc/apache2/sites-enabled/*

COPY .docker/apache2/app.conf  /etc/apache2/sites-available/

RUN a2ensite app
RUN a2enmod rewrite
RUN a2enmod headers

# Allow app to write files
RUN mkdir -p $WORKING_DIR/storage/framework/cache/data
RUN mkdir -p $WORKING_DIR/storage/framework/views
RUN chmod -R 777 $WORKING_DIR/storage
RUN chown -R www-data:www-data $WORKING_DIR

# Expose port and start apache2 server
EXPOSE 80
EXPOSE 443

RUN sed -i 's/^exec /service cron start\n\nexec /' /usr/local/bin/apache2-foreground

# Start container with entrypoint
RUN chmod +x ./.docker/entrypoint.sh

ENTRYPOINT ["./.docker/entrypoint.sh"]
