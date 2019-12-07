<?php

require_once('model/PostHandler.php');
class PostData
{
    private $postID, $postTitle, $postContent, $postOwner, $postDate;

    public function __construct($dbRow)
    {
        $this->postID = $dbRow['postID'];
        $this->postTitle = $dbRow['postTitle'];
        $this->postContent = $dbRow['postContent'];
        $this->postOwner = $dbRow['userName'];
        $this->postDate = $dbRow['postDate'];
    }

    /**
     * @return mixed
     */
    public function getPostID()
    {
        return $this->postID;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * @return mixed
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * @return mixed
     */
    public function getPostOwner()
    {
        return $this->postOwner;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->postDate;
    }
}