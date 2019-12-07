<!-- Logic Model -->
<?php

require_once('model/Post.php');
require_once('model/PostHandler.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['submit'] == 'submitPost')
    {
        if (empty($_POST['postTitle']) || empty($_POST['postContent']))
        {
            echo "Please ensure you have not left the title or content blank.";
        }
        else
        {
            $post = new Post();

            echo $post->createPost($_POST['postTitle'], $_POST['postContent']);
        }
    }
}
