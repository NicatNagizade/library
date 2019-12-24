<?php

use Lara\App\Models\Route;
Route::get('test/:id','IndexController@test');
Route::get('test2','IndexController@test2');
Route::view('test3','test3');