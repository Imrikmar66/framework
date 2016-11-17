<?php

define('URI_FOLDER', dirname(dirname(__FILE__)));

require_once URI_FOLDER . "/vendor/autoload.php";
require_once 'Command/CreateModuleCommand.php';

use Symfony\Component\Console\Application;
use AppBundle\Command\CreateModuleCommand;


$application = new Application();

$application->add(new CreateModuleCommand());

$application->run();
