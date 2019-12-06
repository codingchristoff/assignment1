<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Search";
$view->userHandler = "";

if (!isset($_SESSION['loggedin']))
{
    $url = 'index.php';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}
else {
    require_once('model/logic/authentication.php');
    require_once('model/logic/createPost.php');
    require_once('model/logic/retrieveUser.php');
    require_once('view/search.phtml');
}