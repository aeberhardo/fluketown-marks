#!/bin/bash

# Execute artisan in test-Environment.
# php/php.exe has to be accessible in the path, e.g.
# $ export PATH=$PATH:/cygdrive/i/dev/server/xampp/php
LARAVEL_ENV=test php artisan --env=test $1
