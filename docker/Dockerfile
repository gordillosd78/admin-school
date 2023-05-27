FROM php:7.4-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    iputils-ping \
    -y --no-install-recommends

RUN apt install -y libmcrypt-dev
RUN apt install -y libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install zip pdo_mysql
RUN docker-php-ext-install calendar
RUN docker-php-ext-install ctype
RUN docker-php-ext-install mysqli

# Copy composer installable
COPY ./install-composer.sh ./

# Copy php.ini
#COPY ./php-ini /usr/local/etc/php/

# Cleanup packages and install composer
RUN apt-get purge -y g++ \
&& apt-get autoremove -y \
&& rm -r /var/lib/apt/lists/* \
&& rm -rf /tmp/* \
&& sh ./install-composer.sh \  
&& rm ./install-composer.sh

# Change the current working directory
WORKDIR /var/www/admin-school

# Change the owner of the container document root
RUN chown -R www-data:www-data /var/www/admin-school

#Start Apache in foreground
CMD ["apache2-foreground"]

