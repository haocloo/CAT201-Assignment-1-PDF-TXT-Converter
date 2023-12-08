# Use an official OpenJDK runtime as a parent image
FROM openjdk:8-jdk

# Install Apache, PHP
RUN apt-get update && apt-get install -y \
    apache2 \
    php

# Copy your Java code and the library into the Docker image
# COPY java/ /java/

# Compile the Java file
# RUN javac -cp /java/lib/pdfbox-app-2.0.24.jar /java/PDFTextConverter.java

# Make port 80 available to the world outside this container
EXPOSE 80

# Run Apache in the foreground when the container starts
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
