<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Search";
$view->userHandler = "";
//$view->postHandler = "";
    require_once('model/logic/authentication.php');
    require_once('model/logic/createPost.php');
    require_once('model/logic/retrieveUser.php');
    require_once('model/logic/search.php');
    require_once('view/search.phtml');
