#!/bin/bash

brew services start mysql
php -S localhost:8080 -t public/
