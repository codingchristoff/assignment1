<!-- Controller -->
<?php

session_start();

$view = new stdClass();
$view->pageTitle = "Home";
require "view/index.phtml";

require_once('model/logic/authentication.php');
