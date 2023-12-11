FROM php:8.1.9-fpm-alpine3.16
EXPOSE 80 443
WORKDIR /app
USER root

COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./entrypoint.sh /
RUN chmod +x /entrypoint.sh

RUN set -eux \
    && apk update \
    && apk add --no-cache bash nginx \
    && mkdir -p /app/logs \
    && chmod -Rf 666 /app/logs

CMD ["/bin/bash", "-c", "/entrypoint.sh"]
