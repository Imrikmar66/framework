<?php
	namespace AppBundle\Command;

	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Question\ChoiceQuestion;

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
	    		if($configLine == '/* Database */' . "\n"){
	    			if($arrConfig[($i - 1)] != "\n"){
	    				$output->writeln("\n— Already installed, please check Settings/config.php if you want to modify more settings.\n");
	    				return;
	    			}
    			 	$output->writeln("\n" . '— This will help you configure the framework to your needs' . "\n");

    			 	$output->writeln('— First, we\'ll need your database credentials' . "\n");

    			 	$responseHost 			= readline('— Database host: (localhost) (or q to quit)' . "\n> ");
    			 	if($responseHost == 'q'){ return; }
    			 	$responseDatabaseName 	= readline('— Database name:' . "\n> ");
    			 	$responseUsername 		= readline('— Database username:' . "\n> ");
    			 	$responsePassword 		= readline('— Database password:' . "\n> ");
    			 	$responseType 			= readline('— Database type: (mysql)' . "\n> ");
    			 	$responseCharset 		= readline('— Database charset: (charset)' . "\n> ");

    			 	$handle_config = fopen('Settings/config.php', 'c');
    			 	fwrite($handle_config, $dbParams);


	    		 	$dbParams = $this->paramDatabase($responseHost, $responseUsername, $responseDatabaseName, $responseUsername, $responseType, $responseCharset);
	    			// On rajoute les lignes de config à la suite du commentaire Database
	    			$configLine .= $dbParams;
	    			$arrConfig[$i] = $configLine;
	    			// exit(); // ??
	    		}
	    	}

	    	fwrite($handle_config, implode('', $arrConfig));

	    }

	    protected function paramDatabase($host, $database, $user, $password, $type, $charset)
	    {
	    	$host = $host != '' ? $host : 'localhost';
	    	$type = $type != '' ? $type : 'mysql';
	    	$charset = $charset != '' ? $charset : 'utf8';

	    	$dbSetting = <<<EOS
define('BDD_HOST', '$host');
define('BDD_USER', '$database');
define('BDD_PASS', '$user');
define('BDD_NAME', '$database');
define('BDD_TYPE', '$type');
define('BDD_CHARSET', '$charset');

EOS;
	    	return $dbSetting;
	    }
	}