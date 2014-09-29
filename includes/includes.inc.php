<?php

spl_autoload_register(function ($class) {
	if(file_exists(dirname(__FILE__) . "/classes/{$class}.class.php")){
		require_once(dirname(__FILE__) .  '/classes/' . $class . '.class.php');
	}
});