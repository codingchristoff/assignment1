<?php

$postHandler = new PostHandler();

$view->thread = $postHandler->searchPostID($_GET['postID']);
