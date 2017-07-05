<?php 
R::addRoute('GET', 'dev', 'Dev::dev_home')
    ->alias('dev_home')
    ->roles([1]);

R::addRoute('GET', 'dev/roles', 'Dev::dev_roles')
    ->alias('dev_roles')
    ->roles([1]);

R::addRoute('GET', 'dev/routes', 'Dev::dev_routes')
    ->alias('dev_routes')
    ->roles([1]);

R::addRoute('GET', 'dev/modules', 'Dev::dev_modules')
    ->alias('dev_modules')
    ->roles([1]);

R::addRoute('POST', 'dev/roles/add', 'Dev::roles_add')
    ->alias('dev_roles_add')
    ->roles([1]);   

R::addRoute('POST', 'dev/permissions/add', 'Dev::permissions_add')
    ->alias('dev_permissions_add')
    ->roles([1]);

R::addRoute('POST', 'dev/permissions/update', 'Dev::permissions_update')
    ->alias('dev_permissions_update')
    ->roles([1]);