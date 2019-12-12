<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Search";
//$view->userHandler = "";

//Models
require_once('model/logic/authentication.php');
require_once('model/logic/createPost.php');
require_once('model/logic/retrieveUser.php');
require_once('model/logic/search.php');
require_once('model/logic/createMessage.php');
//Views
require_once('view/search.phtml');
