# FROM php:7.4-fpm

# RUN apt-get update && apt-get install -y \
#     libpq-dev \
#     && docker-php-ext-install pdo pdo_pgsql

# # WORKDIR /var/www/html
# # #COPY web/ .
# # COPY web/ /var/www/html/
# # COPY src/ /var/www/html/src/
# WORKDIR /var/www/html
# COPY web/ /var/www/html/
# COPY src/ /var/www/html/src/



# CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]

# EXPOSE 80

FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

# Copy everything from the local project directory (Make sure src/ exists)
COPY . . 

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]

EXPOSE 80
