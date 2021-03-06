<?php
	namespace AppBundle\Command;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Question\Question;

	/**
	
		TODO:
		- Pouvoir ecraser des précédents parametres
	
	 */

	class InstallCommand extends Command
	{
	    protected function configure()
	    {
	        $this
	        	->setName('install')
	        	->setDescription('Configure the framework')
	        	->setHelp('This command allows you to setup the framework (database, etc)');
	    }

	    protected function execute(InputInterface $input, OutputInterface $output)
	    {
	    	$arrConfig = file('Settings/config.php');

	    	foreach ($arrConfig as $i => $configLine) {
	    		// Quand on est sur la ligne qui précède les paramss bdd
	    		if($configLine == '/* Database */'."\r\n"){
	    			if(strlen($arrConfig[($i + 1)]) > 5){
	    				$output->writeln("\n Already installed, please check Settings/config.php if you want to modify more settings.\n");
	    				return;
	    			}
    			 	$output->writeln("\n" . ' This will help you configure the framework to your needs' . "\n");

    			 	$output->writeln(' First, we\'ll need your database credentials' . "\n");

    			 	$responseHost 			= $this->askQuestion(' Database host: (localhost) (or q to quit)', 'localhost', $input, $output);
    			 	if($responseHost == 'q'){ return; }
    			 	$responseDatabaseName 	= $this->askQuestion(' Database name:', '', $input, $output);
    			 	$responseUsername 		= $this->askQuestion(' Database username (root):', 'root', $input, $output);
    			 	$responsePassword 		= $this->askQuestion(' Database password (root):', 'root', $input, $output);
    			 	$responseType 			= $this->askQuestion(' Database type (mysql):', 'mysql', $input, $output);
    			 	$responseCharset 		= $this->askQuestion(' Database charset (charset):', 'charset', $input, $output);

    			 	$handle_config = fopen('Settings/config.php', 'c');
    			 	fwrite($handle_config, $dbParams);


	    		 	$dbParams = $this->paramDatabase($responseHost, $responseDatabaseName, $responseUsername, $responsePassword, $responseType, $responseCharset);
	    			// On rajoute les lignes de config à la suite du commentaire Database
	    			$configLine .= $dbParams;
	    			$arrConfig[$i] = $configLine;
	    			// exit(); // ??


	    		}
	    	}

	    	fwrite($handle_config, implode('', $arrConfig));

			$sqlfile = dirname(dirname(dirname(dirname(__FILE__))))."/Install/users_roles_and_rights_tables.sql";
			$sql_request = file_get_contents ($sqlfile);
			
			$sql_statements = explode(";", $sql_request);
			array_pop($sql_statements);		

			$link = mysqli_connect(
				$responseHost, 
				$responseUsername, 
				$responsePassword, 
				$responseDatabaseName
			);

			if (mysqli_connect_error()) {
				echo "Echec lors de la connexion à MySQL";
			}
			else {

				foreach($sql_statements as $key => $sql_statement){

					if(!mysqli_query($link, $sql_statement)){
						echo("Error description: " . mysqli_error($link));
						echo $sql_statement;
					}
					else
						echo "step-".$key."\n";
				}
				echo "Installation terminée";
			}	
	    }

	    protected function paramDatabase($host, $database, $user, $password, $type, $charset)
	    {
	    	$host = $host != '' ? $host : 'localhost';
	    	$type = $type != '' ? $type : 'mysql';
	    	$charset = $charset != '' ? $charset : 'utf8';

	    	$dbSetting = <<<EOS
define('BDD_HOST', '$host');
define('BDD_NAME', '$database');
define('BDD_USER', '$user');
define('BDD_PASS', '$password');
define('BDD_TYPE', '$type');
define('BDD_CHARSET', '$charset');

EOS;
	    	return $dbSetting;
	    }

		private function askQuestion($q, $default, $input, $output){
			$helper = $this->getHelper('question');
			$question = new Question($q, $default);
			$response = $helper->ask($input, $output, $question);
			return $response;
		}
	}