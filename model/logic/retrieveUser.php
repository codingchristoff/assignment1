<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if ($_POST['submit'] === 'searchUser')
    {
        if ($_POST['searchUser'] === '')
        {
            echo "Please fill in the search field.";
        }
        else
        {
            $userHandler = new UserHandler();

            $view->user = $userHandler->searchUser($_POST['searchUser']);
        }
    }
}




