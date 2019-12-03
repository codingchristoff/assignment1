<!-- Model -->
<?php

require_once ('model/User.php');

$user = new User();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    echo "already logged in";
    print_r($_SESSION);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'logout')
    {
        echo $user->logout();
    }
}
else
{
    $url = 'index.php';
    //echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$user = new User();
        if ($_POST['submit'] == 'register') {
            $validate = $user->register($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm_password']);

            echo "test validate" . $validate;
        } elseif ($_POST['submit'] == 'login') {


            $result = $user->login($_POST['username'], $_POST['password']);

            if ($result === true)
            {
                /*$userID = $user->getID();
                $_SESSION["loggedin"] = $user->getLoggedIn();
                $_SESSION["userID"] = $userID;
                $_SESSION["userName"] = $user->getName();
                print_r($_SESSION);
                session_write_close();*/

                //session_regenerate_id(true);

                // setcookie('userID') = $_SESSION["userID"];
            }
            else
            {
                echo $result;
            }
        }
    }
}