# Laravel blog with routing and import data from Wordpress

Transfer your Wordpress blog to the Laravel framework

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![GitHub stars](https://img.shields.io/github/stars/ship87/laravel-press.svg)](https://github.com/ship87/laravel-press/stargazers)

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation)


Clone the repository

    git clone git@github.com:/ship87/laravel-press.git

Switch to the repo folder

    cd laravel-press

Install all the dependencies using composer

    composer install
    
Install all the dependencies using npm

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Import data from Wordpress

    php artisan import-data-wordrpess {--prefix=: prefix Wordpress tables database} 

Start the local development server


    php artisan serve
    
You can now access the server at http://localhost:8000