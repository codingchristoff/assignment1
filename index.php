<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Home";

require_once('model/logic/authentication.php');
require_once('model/logic/authentication.php');
require_once('model/logic/createPost.php');
require_once('model/logic/retrievePost.php');
require_once('view/index.phtml');
