<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Post";
$view->threadID = $_GET['postID'];

//Models
require_once('model/logic/authentication.php');
require_once('model/logic/createPost.php');
require_once('model/logic/retrievePost.php');
require_once('model/logic/createReply.php');
require_once('model/logic/watchList.php');
//Views
require_once('view/viewPost.phtml');


