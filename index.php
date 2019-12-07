<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Home";

require_once('model/logic/authentication.php');
require_once('model/logic/createPost.php');

$postHandler = new PostHandler();

$view->postHandler = $postHandler->getLatestPost();

require_once('view/index.phtml');
