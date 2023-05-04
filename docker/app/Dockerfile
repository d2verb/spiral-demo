FROM php:8.2-cli

ARG GROUPID
ARG USERID

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install sockets pdo_mysql
RUN apt update && apt install -y git unzip procps

RUN groupadd --force -g $GROUPID app
RUN useradd -ms /bin/bash --no-user-group -g $GROUPID -u $USERID app

WORKDIR /src

CMD ["./rr", "serve"]