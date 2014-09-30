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
	public $optMethod = 'Double';
	public $optInRedir = '';
	public $optInDisplay = '';
	public $optOutRedir = '';
	public $optOutDisplay = '';
	public $notifyOwnerOnSub = false;

	/**
	 * List all available responders
	 */
	public static function listAll(){
		$db = PdoDb::getInstance();
		$query = $db->prepare("SELECT ResponderID FROM InfResp_responders");
		$query->execute();
		$responders = array();
		while($result = $query->fetch()){
			$responders[] = Responder::getByID($result['ResponderID']);
		}
		return $responders;
	}

	/**
	 *	Get a specific responder
	 *	@param int $id Responder to be retrieved
	*/
	public static function getByID($id){
		$db = PdoDb::getInstance();
		$query = $db->prepare("SELECT ResponderID, Enabled, Name, ResponderDesc, OwnerEmail, OwnerName, ReplyToEmail, MsgList, OptMethod, OptInRedir, OptOutRedir, OptInDisplay, OptOutDisplay, NotifyOwnerOnSub FROM InfResp_responders WHERE ResponderID = :id");
		$query->execute( array("id"=>$id) );
		$result = $query->fetch();
		$responder = new Responder();
		$responder->id               = $result['ResponderID'];
		$responder->enabled          = (bool) $result['Enabled'];
		$responder->name             = $result['Name'];
		$responder->description      = $result['ResponderDesc'];
		$responder->ownerEmail       = $result['OwnerEmail'];
		$responder->ownerName        = $result['OwnerName'];
		$responder->replyTo          = $result['ReplyToEmail'];
		$responder->msgList          = $result['MsgList'];
		$responder->optMethod        = $result['OptMethod'];
		$responder->optInRedir       = $result['OptInRedir'];
		$responder->optInDisplay     = $result['OptInDisplay'];
		$responder->optOutRedir      = $result['OptOutRedir'];
		$responder->optOutDisplay    = $result['OptOutDisplay'];
		$responder->notifyOwnerOnSub = (bool) $result['NotifyOwnerOnSub'];
		return $responder;
	}

	/**
	 *	Retrieve all messages linked to responder
	*/
	public function getMessages(){
		$messages = array();
		$messageList = explode(',', $this->msgList);
		foreach($messageList as $messageID){
			$messages[] = Message::getByID($messageID);
		}
		return $messages;
	}

	/**
	 * Retrieve all subscribers linked to responder
	*/
	public function getSubscribers(){
		$subscribers = array();
		$db = PdoDb::getInstance();
		$query = $db->prepare("SELECT SubscriberID FROM InfResp_subscribers WHERE ResponderID = :id");
		$query->execute(array("id"=>$this->id));
		while($result = $query->fetch()){
			$subscribers[] = Subscriber::getById($result['SubscriberID']);
		}
		return $subscribers;
	}
}