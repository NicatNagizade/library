<?php

use Lara\App\Models\Route;
Route::get('/a/:id','IndexController@test');
Route::get('/test2','IndexController@test2');