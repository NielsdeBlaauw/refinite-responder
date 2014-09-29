<?php

class PdoDb {
	const BOOL_FALSE = '0';
	const BOOL_TRUE = '1';

	static private $instance = array();
	
	private function __construct() {
	}
	
	/**
	 *	Creates an instance of a PDO interface.
	 *	@param	$type	(optional) Specify the database handle to be used
	*/
	static function getInstance($type = 'db') {
		if (!isset(PdoDb::$instance[$type])) {
			include(dirname(__FILE__)  . "/../../config.php");
			$host = $MySQL_server;
			$database = $MySQL_database;
			$user = $MySQL_user;
			$password = $MySQL_password;
			
			try {
				PdoDb::$instance[$type] = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
				PdoDb::$instance[$type]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e) {
				die("PDO error.".$e->getMessage());
			}
			
			PdoDb::$instance[$type]->exec('SET NAMES utf8');
		}
		return PdoDb::$instance[$type];
	}
}
?>