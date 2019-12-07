<!-- Logic Model -->
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['submit'] == 'searchMessage')
    {
        if ($_POST['searchMessage'] == '')
        {
            echo "Please enter a search term.";
        }
        else
        {
            $postHandler = new PostHandler();

            $view->postHandler = $postHandler->searchPost($_POST['searchMessage']);
        }
    }
}