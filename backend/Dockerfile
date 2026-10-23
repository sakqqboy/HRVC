FROM yiisoftware/yii2-php:8.3-apache@sha256:4f70de93a043bc68377d632717f16d80254b2db704adc4e1b811893f03b80f11

# Require the PHP2Shell security fixes in the image used for this build.
RUN php -r 'exit(version_compare(PHP_VERSION, "8.3.36", ">=") ? 0 : 1);'

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf
