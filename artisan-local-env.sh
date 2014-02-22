#!/bin/bash

# Execute artisan in local-Environment.
# php/php.exe has to be accessible in the path, e.g.
# $ export PATH=$PATH:/cygdrive/i/dev/server/xampp/php
LARAVEL_ENV=local php artisan --env=local $1
