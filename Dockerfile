FROM php:8.0-apache
ENV ACCEPT_EULA=Y
RUN apt-get update && apt-get install -y gnupg2
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - 
RUN curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list 
RUN apt update -y
RUN apt-get update -y
RUN apt-get install msodbcsql18 -y
RUN apt-get install unixodbc-dev -y
# RUN pecl install sqlsrv
# RUN pecl install pdo_sqlsrv
# RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

COPY my_custom_config.conf /etc/ssl/openssl.cnf

COPY ./ /var/www/html

# Expose port 8000 for the PHP server
EXPOSE 8000

# Command to start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000"]
