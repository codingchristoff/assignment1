<?php

$userHandler = new UserHandler();

//$userHandler->searchUser($_POST['searchUser']);

$view->user = $userHandler->searchUser($_POST['searchUser']);


