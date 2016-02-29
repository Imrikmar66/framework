<?php
//Adding all your routes here
Route::addRoute('GET', 'index', 'index');
Route::addRoute('GET', 'login', 'login');
Route::addRoute('POST', 'login', 'login')->addPOST('email')->addPOST('password');