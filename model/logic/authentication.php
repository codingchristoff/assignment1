<!-- Model Logic-->
<?php

//NEW
require_once ('model/UserData.php');
require_once ('model/UserHandler.php');

$user = new UserHandler();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit'] == 'logout')
    {
        echo $user->logout();
    }
}

else
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if ($_POST['submit'] == 'register')
        {
            $validate = $user->register($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm_password']);
            echo "test validate " . $validate;
        }
        elseif ($_POST['submit'] == 'login')
        {
            $result = $user->login($_POST['username'], $_POST['password']);
            echo $result;
        }
    }
}