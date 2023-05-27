#!/bin/sh

# php -r "copy('https://getcomposer.org/installer','composer-setup.php');"
# SIGNATURE=$(php -r "echo hash_file('SHA384',composer-setup.php);")
# EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
# echo $SIGNATURE

# if ["$EXPECTED_SIGNATURE" != "$SIGNATURE"] 
# then 
#     echo 'ERROR: Invalid installer signature'
#     rm composer-setup.php
#     exit 1
# fi

# php composer-setup.php --quiet --install-dir=/usr/local/bin
# --filename=composer
# RESULT=$?
# rm composer-setup.php
# exit $

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
#php -r "unlink('composer-setup.php');"

php composer-setup.php --install-dir=/usr/local/bin --filename=composer

rm composer-setup.php

