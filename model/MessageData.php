<?php

//require_once('model/MessageHandler.php');
class MessageData
{
    private $messageID, $messageTitle, $messageContent, $messageOwner, $messageRecip, $messageDate;

    public function __construct($dbRow)
    {
        $this->messageID = $dbRow['messageID'];
        $this->messageTitle = $dbRow['messageTitle'];
        $this->messageContent = $dbRow['messageContent'];
        $this->messageOwner = $dbRow['userName'];
        $this->messageRecip = $dbRow['messageRecip'];
        $this->messageDate = $dbRow['messageDate'];
    }

    /**
     * @return mixed
     */
    public function getMessageID()
    {
        return $this->messageID;
    }

    /**
     * @return mixed
     */
    public function getMessageTitle()
    {
        return $this->messageTitle;
    }

    /**
     * @return mixed
     */
    public function getMessageContent()
    {
        return $this->messageContent;
    }

    /**
     * @return mixed
     */
    public function getMessageOwner()
    {
        return $this->messageOwner;
    }

    /**
     * @return mixed
     */
    public function getMessageRecip()
    {
        return $this->messageRecip;
    }

    /**
     * @return mixed
     */
    public function getMessageDate()
    {
        return $this->messageDate;
    }

}