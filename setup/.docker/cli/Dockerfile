FROM php:7.2-cli
MAINTAINER Dana Negrescu <dana.negrescu@boxalino.com>

# # Install dependencies
RUN apt-get update \
   && apt-get install -y \
     cron \
     rsyslog \
     libfreetype6-dev \
     libicu-dev \
     libjpeg62-turbo-dev \
     libmcrypt-dev \
     libxslt1-dev \
     libmcrypt-dev \
     libxml2-dev \
     libsodium-dev \
     mysql-client-* \
     libssh2-1-dev \
     git \
     sendmail-bin \
     sendmail

RUN docker-php-ext-enable sodium

 # Configure the gd library
RUN docker-php-ext-configure \
   gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

 # Install required PHP extensions
RUN docker-php-ext-install \
   gd \
   intl \
   bcmath \
   mbstring \
   pdo_mysql \
   xsl \
   zip \
   json \
   iconv \
   zip \
   soap


#Installing SSH2
RUN pecl channel-update pecl.php.net
 RUN apt-get install -y git libssh2-1 libssh2-1-dev && \
    pecl install ssh2-1.0 && \
    docker-php-ext-enable ssh2

# Get composer installed to /usr/local/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY .composer/auth.json /root/.composer/auth.json

ADD bin/* /usr/local/bin/
RUN chmod +x /usr/local/bin/setup

WORKDIR /var/www/src

RUN usermod -u 1000 www-data
RUN usermod -G 100 www-data

ENTRYPOINT ["/usr/local/bin/setup"]