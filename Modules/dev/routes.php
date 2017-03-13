<?php 
$fu = (new FakeUser())->connectAs(1);

R::addRoute('GET', 'dev/roles', 'Dev::dev_roles')
    ->alias('dev_roles')
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

