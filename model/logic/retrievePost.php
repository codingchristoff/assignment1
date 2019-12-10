<?php

require_once('model/ReplyHandler.php');

$postHandler = new PostHandler();
$replyHandler = new ReplyHandler();

$view->thread = $postHandler->searchPostID($_GET['postID']);
$view->replyHandler = $replyHandler->getReplies($_GET['postID']);

