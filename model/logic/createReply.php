<!-- Logic Model -->
<?php

require_once('model/ReplyHandler.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['submit'] == 'submitReply')
    {
        if (empty($_POST['replyContent']))
        {
            echo "Please ensure you have not left the title or content blank.";
        }
        else
        {

            $reply = new ReplyHandler();

            echo $reply->createReply($_POST['replyContent'], $_SESSION['userID'], $_POST['postID']);

        }
    }
}
