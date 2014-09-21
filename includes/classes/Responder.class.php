<?php

class Responder{
	public $id = null;
	public $enabled = false;
	public $name = '';
	public $description = '';
	public $ownerEmail = '';
	public $ownerName = '';
	public $replyTo = '';
	public $msgList = '';
	public $optMethd = 'Double';
	public $optInRedir = '';
	public $optInDisplay = '';
	public $optOutRedit = '';
	public $optOutDisplay = '';
	public $notifyOwnOnSub = false;

	public function listAll(){
		$db = PdoDb::getInstance();
		$query = $db->prepare("SELECT ResponderID FROM infresp_responders");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_COLUMN, 0);
	}
}