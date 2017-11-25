<?php 

R::addRoute('GET', 'doc', 'Documentation::doc_docAction')->alias('doc_doc');

R::addRoute('GET', 'doc/installation', 'Documentation::doc_installAction')->alias('doc_install');

R::addRoute('GET', 'doc/configuration', 'Documentation::doc_configAction')->alias('doc_config');

R::addRoute('GET', 'doc/module', 'Documentation::doc_moduleAction')->alias('doc_module');

R::addRoute('GET', 'doc/route', 'Documentation::doc_routeAction')->alias('doc_route');

R::addRoute('GET', 'doc/controller', 'Documentation::doc_controllerAction')->alias('doc_controller');

R::addRoute('GET', 'doc/classe', 'Documentation::doc_classeAction')->alias('doc_classe');

R::addRoute('GET', 'doc/database', 'Documentation::doc_databaseAction')->alias('doc_database');

R::addRoute('GET', 'doc/view', 'Documentation::doc_viewAction')->alias('doc_view');

R::addRoute('GET', 'doc/dev', 'Documentation::doc_devAction')->alias('doc_dev');

