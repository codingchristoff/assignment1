<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Home";

require_once('model/logic/authentication.php');
require_once('model/logic/createPost.php');
require_once('model/logic/watchList.php');

$postHandler = new PostHandler();
$view->postHandler = $postHandler->getLatestPost();

if(isset($_SESSION['loggedin']))
{
    $view->watchList = $postHandler->getWatchList($_SESSION['userID']);
}
require_once('view/index.phtml');
