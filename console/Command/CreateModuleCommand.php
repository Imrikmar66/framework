<?php
	namespace AppBundle\Command;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;

	define('SAVE_PATH', 'Modules');

	class CreateModuleCommand extends Command
	{
	    protected function configure()
	    {
	        $this
	        	->setName('create:module')
	        	->setDescription('Create a new module, with folders and files')
	        	->setHelp('This command allows you to create a module pretty fast *swoosh*');
	    }

	    protected function execute(InputInterface $input, OutputInterface $output)
	    {
	    	echo "\n";
	        $output->writeln('This command will create all the folders and files needed for your new module.');
	        $response = readline("Module name (or q to quit):\n");

	        $responseControllerName = ucfirst(strtolower($response));

	        // Quitte si q
	        if($response == 'q'){
	        	return;
	        }

	        $modulePath = SAVE_PATH . '/' . $response;

	        mkdir($modulePath);
	        mkdir($modulePath . '/view');
	        mkdir($modulePath . '/controllers');
	        mkdir($modulePath . '/class');
	        mkdir($modulePath . '/assets');


	        // Squelette controller
	        $skel_controller = '<?php

class ' . $responseControllerName . 'Controller extends Controller {';
	        $skel_controller .= <<<'EOS'
	            

	protected function authenticationRequirement() {
	    return false;
	}

	protected function defineMainView() {
	    $this->mainView = "default";
	}

	protected function errorLoadingController() {
	    $this->mainView = "404";
	}

	public function abs() {
	    parent::main();
	}

EOS;
			// Ecriture dans le controller.php généré
	        $handle_controller = fopen($modulePath . "/controllers/". $responseControllerName ."Controller.php", 'a');
	        fwrite($handle_controller, $skel_controller);
	       
	        $output->writeln("$response folder has been created in Modules/ \n");

	       	
	       	/**
	       	 * GÉNÉRATION ROUTES
	       	 */

	       	$skel_route = "<?php \n\n";

	        $output->writeln('Now we will register your module routes and contoller methods');
	        $responseRoutePath = readline("Route path: (or q to quit/save):\n");

	        $output->writeln($responseRoutePath);
	        // Quitte si q
	        if($responseRoutePath == '' || $responseRoutePath == 'o'){
				fwrite($handle_controller, '}');
				exit();
	        }
	        $handle_route = fopen($modulePath . '/routes.php', 'a');

	
	        // Sinon rentre dans la boucle
	       	while($responseRoutePath != '' && $responseRoutePath != 'q'){
	        	$responseRouteName = readline("Route name:\n");
	
				$skel_route .= "R::addRoute('GET', '$responseRoutePath', '$responseControllerName::$responseRouteName')->alias('$responseRouteName');\n\n";
	
				$skel_method = "\n    public function $responseRouteName() {\n";
				$skel_method .= "        parent::main();\n";
				$skel_method .= "    }\n\n";

				fwrite($handle_controller, $skel_method);

				$responseRoutePath = readline("Route path: (or q to quit/save):\n");
	       	}
			fwrite($handle_route, $skel_route);

			fwrite($handle_controller, '}');

	    }
	}