<?php
	namespace AppBundle\Command;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;

	define('SAVE_PATH', 'Modules');

/**

	TODO:
	- Ajouter la création de vue si GET
	- Second todo item

 */



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
	        $output->writeln('— This command will create all the folders and files needed for your new module.' . "\n");
	        $response = readline("— Module name (or q to quit):\n> ");

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



			// Ecriture dans le controller.php généré
	        $handle_controller = fopen($modulePath . "/controllers/". $responseControllerName ."Controller.php", 'a');
	        $skel_controller = $this->getControllerSkeleton($responseControllerName);
	        fwrite($handle_controller, $skel_controller);
	       
	        $output->writeln("\n— $response folder has been created in Modules/ \n");

	       	
	       	/**
	       	 * GÉNÉRATION ROUTES
	       	 */

	       	$skel_route = "<?php \n\n";

	        $output->writeln('— Now we will register your module routes and contoller methods');
	        $responseRoutePath = readline("— Route path: (or q to quit/save):\n> ");

	        // Quitte si q
	        if($responseRoutePath == '' || $responseRoutePath == 'o'){
				fwrite($handle_controller, '}');
				exit();
	        }
	        $handle_route = fopen($modulePath . '/routes.php', 'a');

	
	        // Sinon rentre dans la boucle
	       	while($responseRoutePath != '' && $responseRoutePath != 'q'){

	        	$responseRouteName = readline("— Route name:\n> ");
	       		$responseRouteType = strtoupper(readline('— Route type: (default: GET)'));
	       		$responseRouteType = $responseRouteType != '' ? $responseRouteType : 'GET';

	        	// On ajoute un suffixe aux methodes controller selon leur type, pour éviter les doublons
	        	$responseControllerMethod = $responseRouteName;
	  			if($responseRouteType == 'POST'){
	  				$responseControllerMethod .= 'Handle';
	  			}
	  			elseif($responseRouteType == 'GET'){
	  				$responseControllerMethod .= 'Action';
	  			}
	
				$skel_route .= "R::addRoute('$responseRouteType', '$responseRoutePath', '$responseControllerName::$responseControllerMethod')->alias('$responseRouteName');\n\n";

				// Si route est GET, on lui génère une vue avec l'alias en nom
				if($responseRouteType == 'GET'){
					$skel_view = "<h1>Welcome to the $response $responseRouteName page !</h1>";
					$handle_view = fopen($modulePath . '/view/' . $responseRouteName . '.tpl', 'w');
					fwrite($handle_view, $skel_view);
				}
				
				// On ecrit le debut de la methode dans le controller
				$skel_method = "\n    public function $responseControllerMethod() {\n";

				// Si la route affiche une vue, on l'appelle dans la methode controller ->
				if($responseRouteType == 'GET'){
					$skel_method .= '        $this->mainView' . " = '$responseRouteName'; \n";
				}
				$skel_method .= "        parent::main();\n";
				$skel_method .= "    }\n\n";
				// -> Fin ecriture methode controller

				fwrite($handle_controller, $skel_method);

				$responseRoutePath = readline("\n— Route path: (or q to quit/save):\n> ");
	       	}
			fwrite($handle_route, $skel_route);

			fwrite($handle_controller, '}');

	    }

	    /**
	     * Get the controller skeleton
	     */ 
	    private function getControllerSkeleton($name){
	        $skel_controller = '<?php
class ' . $name . 'Controller extends Controller {';
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
			return $skel_controller;
	    }


	}