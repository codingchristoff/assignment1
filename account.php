<?php
session_start();

if(!isset($_SESSION['loggedin']))
{
    $url = 'index.php';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}
else
{
    $userID = $_SESSION['userID'];
    require_once "view/account.phtml";
    require_once ('model/Authentication.php');
    echo "welcome " . $userID;

}




