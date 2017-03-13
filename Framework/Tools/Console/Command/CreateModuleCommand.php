<?php
	namespace AppBundle\Command;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Question\Question;

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

			$response = $this->askQuestion('Module name (or q to quit):', 'DefaultModule', $input, $output);

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
	       
	        $output->writeln("\n $response folder has been created in Modules/ \n");

	       	
	       	/**
	       	 * GÉNÉRATION ROUTES
	       	 */

	       	$skel_route = "<?php \n\n";

	        $output->writeln('Now we will register your module routes and contoller methods');
			$responseRoutePath = $this->askQuestion('Route path: (or q to quit/save):', '', $input, $output);

	        // Quitte si q
	        if($responseRoutePath == '' || $responseRoutePath == 'o'){
				fwrite($handle_controller, '}');
				exit();
	        }
	        $handle_route = fopen($modulePath . '/routes.php', 'a');

	
	        // Sinon rentre dans la boucle
	       	while($responseRoutePath != '' && $responseRoutePath != 'q'){

				$responseRouteName = $this->askQuestion('Route name:', '/home', $input, $output);
	       		$responseRouteType = strtoupper($this->askQuestion('Route type: (default: GET)', 'GET', $input, $output));
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

				$responseRoutePath = $this->askQuestion('Route path: (or q to quit/save): ', '', $input, $output);
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

	protected function defineMainView() {
	    $this->mainView = "default";
	}

	protected function errorLoadingController() {
	    $this->mainView = "404";
	}

EOS;
			return $skel_controller;
	    }

	private function askQuestion($q, $default, $input, $output){
		$helper = $this->getHelper('question');
		$question = new Question($q, $default);
		$response = $helper->ask($input, $output, $question);
		return $response;
	}

	}