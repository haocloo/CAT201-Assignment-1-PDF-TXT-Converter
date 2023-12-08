# Use an official OpenJDK runtime as a parent image
FROM openjdk:8-jdk

# Install Apache, PHP
RUN apt-get update && apt-get install -y \
    apache2 \
    php

# Make port 80 available to the world outside this container
EXPOSE 80

# Run Apache in the foreground when the container starts
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
