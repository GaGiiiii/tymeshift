FROM php:8.0-cli-alpine

LABEL maintainer="tymeshiftwfm" \
    version="1.0" \
    description="Tymeshifts PHP test."

COPY . /project

WORKDIR /project

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer\
    && apk add make\
    && composer install --optimize-autoloader --no-dev