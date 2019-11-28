<!-- Controller -->
<?php

require_once ('view/page2.phtml');

$view = new stdClass();

require_once ('model/Register.php');

if (isset($_POST['submit']))
{

    $registration = new Register();

    $validate = $registration->validate($_POST['username'],$_POST['password'],$_POST['confirm_password']);

    $view->result = $validate;

    echo $view->result;
}
