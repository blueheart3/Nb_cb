#!/usr/bin/env bash

# 启动 php-fpm 与 nginx
php-fpm -D -R
nginx -g 'daemon off;'