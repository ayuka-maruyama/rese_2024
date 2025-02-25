FROM php:8.2-fpm

# php.iniをコピー
COPY ./docker/php/php.ini /usr/local/etc/php/

# 必要な依存パッケージとPHP拡張をインストール
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    cron \
    acl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composerのインストールと更新
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer self-update

# スクリプトをコピー
COPY ./docker/php/start.sh /usr/local/bin/start.sh

# 実行権限を与える
RUN chmod +x /usr/local/bin/start.sh

# Cronタスクを設定するためのファイルを追加
COPY ./docker/php/my_crontab /etc/cron.d/my_crontab

# 権限を設定
RUN chmod 0644 /etc/cron.d/my_crontab

# cronジョブを登録
RUN crontab /etc/cron.d/my_crontab

# 作業ディレクトリの設定
WORKDIR /var/www

# スクリプトを実行
CMD ["/usr/local/bin/start.sh"]
