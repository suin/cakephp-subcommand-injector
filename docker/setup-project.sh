#!/usr/bin/env sh
set -eux

# ...Write project specific setup process here ...
: "Install build tools" && {
  apk update
  apk add --no-cache --virtual .build-deps autoconf g++ make
}

: "Install requirements of CakePHP3" && {
  apk add --no-cache libintl icu icu-dev
  docker-php-ext-install intl
}

: "Cleanup" && {
  rm -rf /tmp/*
  rm -rf /var/cache/apk/*
  apk del .build-deps
}
