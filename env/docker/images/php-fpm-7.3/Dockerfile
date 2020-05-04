FROM php:7.3-fpm

# base dependencies
RUN apt-get update && apt-get install -y wget curl git unzip zlib1g-dev libcurl4-openssl-dev libicu-dev

# curl json mbstring extentions
RUN docker-php-ext-install curl && docker-php-ext-enable curl && \
    docker-php-ext-install json && docker-php-ext-enable json && \
    docker-php-ext-install mbstring && docker-php-ext-enable mbstring

# mysql && pdo
RUN docker-php-ext-install mysqli && docker-php-ext-configure mysqli --with-mysqli=mysqlnd && docker-php-ext-enable mysqli && \
    docker-php-ext-install pdo pdo_mysql

# locales
RUN apt-get install -y gettext locales libzip-dev && \
    echo '' >> /usr/share/locale/locale.alias && \
    sed -i 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i 's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen && \
    docker-php-ext-install zip && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-install gettext

# mcrypt
RUN apt-get install -y libmcrypt-dev && pecl install mcrypt-1.0.2 && docker-php-ext-enable mcrypt
# redis
RUN pecl install redis && docker-php-ext-enable redis
# xdebub
RUN pecl install xdebug && docker-php-ext-enable xdebug
# composer
RUN curl -s http://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
# pcntl
RUN docker-php-ext-install pcntl
# stem
# RUN wget "https://bitbucket.org/vaifier/stem/downloads/stem-1.5.1.tar.gz" && pecl install stem-1.5.1.tar.gz && docker-php-ext-enable stem

# gd
RUN apt-get install -y libjpeg-dev libpng-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

# nodejs
RUN apt-get install -y gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 \
    libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 \
    libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 \
    libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 \
    fonts-ipafont-gothic fonts-wqy-zenhei fonts-thai-tlwg fonts-kacst \
    ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils && \
    curl -sL https://deb.nodesource.com/setup_10.x | bash - && \
    apt-get install -y nodejs

RUN apt-get install -y atop htop

# clean apt data
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# add dev user
RUN groupadd -g 1000 dev && \
    useradd --create-home -r -u 1000 dev -g dev

ENV COMPOSER_HOME /home/dev/composer
ENV LANG="C.UTF-8"

WORKDIR /var/www/html

CMD ["php-fpm"]
