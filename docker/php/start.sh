#!/bin/sh

# Cronをバックグラウンドで実行
cron

# storageディレクトリの作成と権限設定
mkdir -p /var/www/storage/app/public/evaluation-images
mkdir -p /var/www/storage/app/public/qrcodes
mkdir -p /var/www/storage/app/public/shop-images

# 所有者をwww-dataに変更
chown -R www-data:www-data /var/www/storage

# 書き込み権限を付与
chmod -R 777 /var/www/storage

# PHP-FPMをフォアグラウンドで実行
php-fpm
