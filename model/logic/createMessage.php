<!-- Logic Model -->
<?php

require_once('model/MessageHandler.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['submit'] == 'submitMessage')
    {
        if (empty($_POST['messageTitle']) || empty($_POST['messageContent']) || empty($_POST['messageRecip']))
        {
            echo "Please ensure you have filled out all fields";
        }
        else
        {
            $message = new MessageHandler();

            echo $message->createMessage($_POST['messageTitle'], $_POST['messageContent'], $_SESSION['userID'], $_POST['messageRecip']);
        }
    }
}
