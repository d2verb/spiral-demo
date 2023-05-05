FROM php:8.2-cli

ARG GROUPID
ARG USERID

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN apt update \
    && apt install -y git unzip libonig-dev libcurl4-openssl-dev libzip-dev vim procps sudo \
    && docker-php-ext-install mbstring sockets curl zip pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN groupadd --force -g $GROUPID app
RUN useradd -ms /bin/bash --no-user-group -g $GROUPID -u $USERID app

WORKDIR /src

ENTRYPOINT ["./rr", "serve"]