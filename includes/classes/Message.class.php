<?php

class Message{
	public $id = null;
	public $subject = '';
	public $sendOffset = 0;
	public $bodyText = '';
	public $bodyHTML = '';

	/**
	 *	Get a specific message
	 *	@param int $id Message to be retrieved
	*/
	public static function getByID($id){
		$db = PdoDb::getInstance();
		$query = $db->prepare("SELECT MsgID, Subject, SecMinHoursDays, BodyText, BodyHTML FROM infresp_messages WHERE MsgID = :id");
		$query->execute( array("id"=>$id) );
		$result = $query->fetch();
		$message = new Message();
		$message->id = $result['MsgID'];
		$message->subject = $result['Subject'];
		$message->sendOffset = $result['SecMinHoursDays'];
		$message->bodyText = $result['BodyText'];
		$message->bodyHTML = $result['BodyHTML'];
		return $message;
	}
}