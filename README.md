[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

# Registry of illegal dumping sites of Slovenia

Registry of illegal dumping sites of Slovenia is an environmental project which is intended to fight against illegal
waste dumps in Slovenia. It's providing users with a modern, effective and accessible system of reporting new illegal
dumping sites and updating previously recorded ones.

## Table of contents

* [Features](#features)
* [Built with](#built-with)
* [Installation guide](#installation-guide)
* [Views](#views)

## Features

* Mobile first and fully responsive
* Simple to use statistics
* Export data for your own use

## Built with

* [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework packed with classes that can be composed to
  build any design, directly in your markup.
* [Vue 3](https://v3.vuejs.org) - Vue is a progressive framework for building user interfaces.
* [Inertia.js](https://inertiajs.com) - Inertia.js lets you quickly build modern single-page React, Vue and Svelte apps
  using classic server-side routing and controllers.
* [Laravel](https://laravel.com) - Laravel is a web application framework with expressive, elegant syntax.

## Installation guide

```sh
# clone the project
git clone https://github.com/jurerotar/Slovenian-register-of-illegal-waste-dumps.git Clean-Slovenia

# change directory to newly created one
cd Clean-Slovenia  

# install composer dependencies
composer install  

# install node dependencies
npm install  

# set up .env; create a db & user if needed

# migrate the database
php artisan migrate --seed

# after migrating, create static files required by the application
php artisan exports:make

# run development server
php artisan serve  

# compile vue components and watch for changes
npm run dev && npm run watch
```

## Views

Homepage in light color scheme

![Homepage light mode](.github/homepage_white.png)

Data export page in dark color scheme

![Data export page in dark mode](.github/export_dark.png)




