<!-- Controller -->
<?php

$view = new stdClass();
$view->pageTitle = "Home";


require "view/index.phtml";

require_once ('model/Register.php');
require_once ('model/User.php');
require_once ('model/Login.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['submit'] == 'register') {

        $registration = new Register();

        $validate = $registration->validate($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm_password']);

        echo $validate;
    }
    elseif ($_POST['submit'] == 'login')
    {
       $login = new Login();
       echo $login->test($_POST['username'], $_POST['password']);
       $result = $login->login($_POST['username'], $_POST['password']);
       echo $result;
    }
}



