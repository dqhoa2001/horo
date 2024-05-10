FROM --platform=linux/amd64 php:8.1-fpm
# パッケージの更新と必要なパッケージのインストール
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git libmagickwand-dev imagemagick nodejs npm zip libzip-dev
# Composerのインストール
RUN curl -sS http://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# PHP設定の確認
RUN php -i | grep -i ssl
# PHP拡張機能のインストール
RUN docker-php-ext-install pdo pdo_mysql zip && \
    pecl install imagick && \
    docker-php-ext-enable imagick
# GDライブラリの設定とインストール
RUN docker-php-ext-configure gd && \
    docker-php-ext-install gd
# php-swephのインストール
RUN git clone -b 4.0.9 http://github.com/cyjoelchen/php-sweph.git && \
    cd php-sweph && \
    phpize && \
    ./configure && \
    make && \
    make install
# php-swephディレクトリの削除
RUN rm -r -f php-sweph
# swephp拡張機能の有効化
RUN echo "extension=swephp.so" > /usr/local/etc/php/conf.d/docker-php-ext-sweph.ini
WORKDIR /var/www