<?php 
	require 'medoo.php';

	class DBAccessor{
		private $type = 'mysql';
		private $charset = 'utf8';

		private $host;
		private $db;
		private $user;
		private $password;

		private $medooConstructorArray;
		private $accessor;

		public function __construct($host, $db, $user, $password){

			$this->host = $host;
			$this->db = $db;
			$this->user = $user;
			$this->password = $password;

			// On stocke l'array prêt à etre envoyé au constructeur de medoo
			$this->medooConstructorArray = [
				'database_type' => $this->type,
				'database_name' => $this->db,
				'server' => $this->host,
				'username' => $this->user,
				'password' => $this->password,
				'charset' => $this->charset];
		}

		// Pour préciser un port, à faire avant le getConnection()
		public function setPort($port){
			$this->medooConstructorArray['port'] = $port;
		}

		public function getConnection(){
			$this->accessor = new medoo($this->medooConstructorArray);
			return $this->accessor;
		}

		public function accessor(){
			return $this->accessor;
		}
	} 
?>