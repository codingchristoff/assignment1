<!-- Logic Model -->
<?php

require_once('model/PostHandler.php');

$post = new PostHandler();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['submit'] == 'subscribe')
    {
        echo $post->setWatchList($_POST['postID'], $_SESSION['userID']);
    }
    elseif ($_POST['submit'] === 'unsubscribe')
    {
        echo $post->unsetWatchList($_POST['postID'], $_SESSION['userID']);
    }
}
