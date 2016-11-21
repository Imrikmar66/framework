<?php
require_once "External/vendor/autoload.php";
require_once 'Command/CreateModuleCommand.php';
require_once 'Command/InstallCommand.php';

use Symfony\Component\Console\Application;
use AppBundle\Command\CreateModuleCommand;
use AppBundle\Command\InstallCommand;


$application = new Application();

$application->add(new InstallCommand());
$application->add(new CreateModuleCommand());

$application->run();
