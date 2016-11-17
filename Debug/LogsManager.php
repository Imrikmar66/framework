<?php 

	/**
	* Fonction de gestion de logs
	* Enregistre en BDD la date, un message et un code prédéfinis
	*/

	class LogsManager{
		private static $accessor;

		// Constantes LOGGER, c'est le $action
		const LOGS_OK 		= 0;
		const LOGS_ERROR 	= 1;
		const LOGS_PENDING 	= 2;
		const LOGS_DELETION = 3;

		public static function log($action, $message){
			self::$accessor = Bdd::getBdd();
			self::$accessor->insert('logs',
				[
					'action' => $action,
					'message' => $message,
				]);
		}
	}

 ?>