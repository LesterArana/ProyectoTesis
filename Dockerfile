# Usar PHP 8.1 con FPM
FROM php:8.1-fpm

# Instalar dependencias de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar las dependencias de Composer
RUN composer install
RUN php artisan key:generate

# Exponer el puerto de PHP-FPM
EXPOSE 9000

# Iniciar PHP-FPM
CMD ["php-fpm"]
