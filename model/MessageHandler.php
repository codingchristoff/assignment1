<?php

require_once('model/Database.php');
require_once('model/MessageData.php');

class MessageHandler
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    /**
     * @return PDO
     */
    public function getDbHandle()
    {
        return $this->_dbHandle;
    }

    /**
     * @return Database
     */
    public function getDbInstance()
    {
        return $this->_dbInstance;
    }

    public function fetchAllPosts()
    {
        $sqlQuery = 'SELECT * FROM posts';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new PostData($row);
        }
        return $dataSet;  // return an array of PostData objects
    }

    public function createMessage($messageTitle, $messageContent, $messageOwner, $messageRecip)
    {

        // Prepare an insert statement
        $sql = "INSERT INTO messages (messageTitle, messageContent, messageOwner, messageRecip) VALUES (:messageTitle,:messageContent,:messageOwner, :messageRecip)";

        if ($stmt = $this->_dbHandle->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":messageTitle",$param_messageTitle,PDO::PARAM_STR);
            $stmt->bindParam(":messageContent",$param_messageContent, PDO::PARAM_STR);
            $stmt->bindParam(":messageOwner",$param_messageOwner, PDO::PARAM_STR);
            $stmt->bindParam(":messageRecip",$param_messageRecip, PDO::PARAM_STR);

            // Set parameters
            $param_messageTitle = $messageTitle;
            $param_messageContent = $messageContent;
            $param_messageOwner = $messageOwner;
            $param_messageRecip = $messageRecip;

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                return "Successful";
            }
            else
            {
                return "Something went wrong. Please try again later.";
            }
        }
// Close statement
        unset($stmt);
// Close connection
        unset($pdo);
    }

    /**
     * Provides 10 latest messages.
     * @param $userID
     * @return array
     */
    public function getMessages($userID)
    {
        $sqlQuery = 'SELECT *,u.userName FROM messages m INNER JOIN users u ON m.messageOwner = u.userID WHERE m.messageRecip = :userID ORDER BY messageDate DESC LIMIT 10';

        $stmt = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement

        $stmt->bindParam(":userID", $param_userID, PDO::PARAM_STR);

        // Set parameters
        $param_userID = $userID;

        $stmt->execute(); // execute the PDO statement

        $dataSet = [];

        while ($row = $stmt->fetch()) {
            $dataSet[] = new MessageData($row);
        }
        return $dataSet;  // return an array of UserData objects
    }

}