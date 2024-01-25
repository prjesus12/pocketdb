# Use the official PHP image as a base image
FROM php:7.4-cli

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the local PHP files to the container
COPY ./ /var/www/html

# Expose port 8000 for the PHP server
EXPOSE 8000

# Command to start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000"]
