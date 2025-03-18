FROM php:8.4-apache

# Set the working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80

# Install Tidy
RUN apt-get update && apt-get install -y libtidy-dev && docker-php-ext-install tidy


# php adjustments.
COPY conf/php.ini /usr/local/etc/php/conf.d/

# # Enable mod_http2
RUN a2enmod http2 ssl

# # Update Apache configuration to enable HTTP/2
RUN echo "Protocols h2 http/1.1" >> /etc/apache2/apache2.conf

# # Set ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Enable mod_remoteip / Set RemoteIPInternalProxy
RUN a2enmod remoteip
RUN echo "RemoteIPHeader X-Forwarded-For"  >> /etc/apache2/apache2.conf
RUN echo "RemoteIPInternalProxy 158.91.1.103/24" >> /etc/apache2/apache2.conf

# Append ErrorDocument directives to Apache configuration
RUN echo "ErrorDocument 404 /errors/404.html" >> /etc/apache2/apache2.conf \
    && echo "ErrorDocument 403 /errors/404.html" >> /etc/apache2/apache2.conf

# Set ServerTokens directive to Prod
RUN echo "ServerTokens Prod" >> /etc/apache2/apache2.conf

# # Restart Apache to apply the changes
RUN service apache2 restart

# Set the default command to run the Apache server
CMD ["apache2-foreground"]