#!/bin/bash
composer install &&
npm install &&
npm run dev &&
php artisan migrate:fresh &&
php artisan db:seed &&
echo "Installation successful, run 'php artisan serve' for a local development server."
