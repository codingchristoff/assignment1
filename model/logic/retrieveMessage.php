<?php

require_once('model/MessageHandler.php');

$messageHandler = new MessageHandler();

//$view->thread = $postHandler->searchPostID($_GET['postID']);
$view->messageHandler = $messageHandler->getMessages($_SESSION['userID']);

