const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .vue({version: 3})
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ])
    .disableNotifications();
