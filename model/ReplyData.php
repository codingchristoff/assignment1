<?php

require_once('model/ReplyHandler.php');
class ReplyData
{
    private $replyID, $replyContent, $replyDate, $replyBy, $replyPost;

    public function __construct($dbRow)
    {
        $this->replyID = $dbRow['replyID'];
        $this->replyContent = $dbRow['replyContent'];
        $this->replyDate = $dbRow['replyDate'];
        $this->replyBy = $dbRow['userName'];
        $this->replyPost = $dbRow['replyPost'];
    }

    /**
     * @return mixed
     */
    public function getReplyID()
    {
        return $this->replyID;
    }

    /**
     * @return mixed
     */
    public function getReplyContent()
    {
        return $this->replyContent;
    }

    /**
     * @return mixed
     */
    public function getReplyDate()
    {
        return $this->replyDate;
    }

    /**
     * @return mixed
     */
    public function getReplyBy()
    {
        return $this->replyBy;
    }

    /**
     * @return mixed
     */
    public function getReplyPost()
    {
        return $this->replyPost;
    }
}