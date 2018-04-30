FROM php:7.1-alpine

# Define environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1

# Build PHP environment
COPY install.sh /install.sh
RUN sh /install.sh && rm /install.sh

# Change workding directory
WORKDIR /project-copy

# Project specific files
COPY php.ini /usr/local/etc/php/conf.d/docker-php-common.ini
COPY setup-project.sh /setup-project.sh
COPY copy-project.sh /usr/local/bin/copy-project
RUN sh /setup-project.sh && rm /setup-project.sh

# Project directory
VOLUME ["/project"]
