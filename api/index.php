<?php

require_once('../vendor/autoload.php');

require_once('../includes/includes.inc.php');

$app = new \Slim\Slim();

// Get a list of responders
$app->get('/responder/', function () {
	echo json_encode(Responder::listAll());
});

// Get specific responder with corresponding ID
$app->get('/responder/:id', function ($id) {
	echo json_encode(Responder::getByID($id));
});

// Get a list of messages
// if no parameters are set, no messages will be retrieved
// if responder_id is set, only messages linked to that responder will be retrieved
// if subscriber_id is set, only messages linked to that subscriber will be retrieved
$app->get('/message/', function () {
	if(isset($_GET['responder_id'])){
		$source = Responder::getByID($_GET['responder_id']);
	}elseif(isset($_GET['subscriber_id'])){
		$source = Subscriber::getByID($_GET['subscriber_id']);
	}
	if(isset($source)){
		echo json_encode($source->getMessages());
	}
});

// Get specific message with corresponding ID
$app->get('/message/:id', function ($id) {
	echo json_encode(Message::getByID($id));
});

// Get a list of subscribers
// if no parameters are set, all subscribers will be retrieved
// if responder_id is set, only subscribers linked to that responder will be retrieved
$app->get('/subscriber/', function () {
	if(isset($_GET['responder_id'])){
		$responder = Responder::getByID($_GET['responder_id']);
		echo json_encode($responder->getSubscribers());
	}else{
		echo json_encode(Subscriber::listAll());
	}
});

// Get specific subscriber with corresponding ID
$app->get('/subscriber/:id', function ($id) {
	echo json_encode(Subscriber::getByID($id));
});

// Remove specific subscriber with corresponding ID
$app->delete('/subscriber/:id', function ($id) {
	Subscriber::getByID($id)->delete();
});

$app->run();