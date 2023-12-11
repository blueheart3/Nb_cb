FROM php:8.1.9-fpm-alpine3.16
EXPOSE 80 443
WORKDIR /app
USER root

RUN set -eux \
    && apk update \
    && apk add --no-cache bash nginx \
    && mkdir -p /app/web \
    && mkdir -p /app/logs \
    && chmod -Rf 666 /app/logs

COPY ./web /app/web/
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./entrypoint.sh /
RUN chmod +x /entrypoint.sh

CMD ["/bin/bash", "-c", "/entrypoint.sh"]
