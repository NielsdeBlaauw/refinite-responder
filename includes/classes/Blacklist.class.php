<?php

class Blacklist{
	public static function inBlacklist($email){
		$db = PdoDb::getInstance();
		$query = $db->prepare("SELECT 1 FROM InfResp_blacklist WHERE EmailAddress = :email");
		$query->execute(array('email'=>$email));
		return (bool) $query->rowCount();
	}
}