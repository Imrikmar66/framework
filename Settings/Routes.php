<?php
//Adding all your routes here
//Route::addRoute('GET', 'index', 'index');
Route::addRoute('GET', 'login', 'login');
Route::addRoute('POST', 'login', 'login')->addPOST('email')->addPOST('password');
Route::addRoute('GET', 'dashboard', 'dashboard');
Route::addRoute('GET', 'login/@tamo/@test/aie', 'index')->using("@tamo", "^[1-9]*$")->using("@test", "^[a-z]*$");