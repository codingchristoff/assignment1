<!-- Controller -->
<?php

$view = new stdClass();
$view-> pageTitle = "Database";

require_once('model/UserDataSet.php');

$userDataSet = new UserDataSet();

$view->userDataSet = $userDataSet->fetchAllUsers();

require_once('view/database.phtml');

