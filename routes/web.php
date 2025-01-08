<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "hello world";
});

Route::get('/about', function () {
    echo "about us";
});
