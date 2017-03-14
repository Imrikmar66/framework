<?php 
R::addRoute('GET', 'login', 'Auth::login')
    ->alias('login');

R::addRoute('GET', 'action/login', 'Auth::actionLogin')
    ->addGET('username')
    ->addGET('password')
    ->alias('actionLogin');