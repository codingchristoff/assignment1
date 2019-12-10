<?php

require_once('model/Database.php');
require_once('model/ReplyData.php');

class ReplyHandler
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

    public function createReply($replyContent, $replyBy, $replyPost)
    {
        // Prepare an insert statement
        $sql = "INSERT INTO replies (replyContent,replyBy,replyPost) VALUES (:replyContent,:replyBy,:replyPost)";

        if ($stmt = $this->_dbHandle->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":replyContent",$param_replyContent,PDO::PARAM_STR);
            $stmt->bindParam(":replyBy",$param_replyBy, PDO::PARAM_STR);
            $stmt->bindParam(":replyPost",$param_replyPost, PDO::PARAM_STR);

            // Set parameters
            $param_replyContent = $replyContent;
            $param_replyBy = $replyBy;
            $param_replyPost = $replyPost;

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                $URL = "viewPost.php?postID=$replyPost";
                return '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

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

    /**
     * Provides 9 latest posts.
     * @return array
     */
    public function getReplies($replyPost)
    {
        $sqlQuery = 'SELECT *, u.userName FROM replies r INNER JOIN users u ON r.replyBy = u.userID WHERE replyPost = :replyPost ORDER BY replyDate DESC';

        $stmt = $this->_dbHandle->prepare($sqlQuery);

        $stmt->bindParam(":replyPost",$param_replyPost, PDO::PARAM_STR);

        // Set parameters
        $param_replyPost = $replyPost;

        $stmt->execute(); // execute the PDO statement

        $dataSet = [];

        while ($row = $stmt->fetch()) {
            $dataSet[] = new ReplyData($row);
        }
        return $dataSet;  // return an array of UserData objects

    }

    public function searchPost($searchTerm)
    {
        $sql = 'SELECT *,u.userName FROM posts p INNER JOIN users u ON p.postOwner = u.userID WHERE postTitle LIKE :searchTerm';

        $stmt = $this->_dbHandle->prepare($sql);

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":searchTerm", $param_searchTerm, PDO::PARAM_STR);

        // Set parameters
        $param_searchTerm = "%$searchTerm%";

        $stmt->execute(); // execute the PDO statement

        $postData = [];

        while ($row = $stmt->fetch()) {
            $postData[] = new PostData($row);
        }

        return $postData;  // return an array of UserData objects

    }

    public function searchPostID($postID)
    {
        $sql = 'SELECT *,u.userName FROM posts p INNER JOIN users u ON p.postOwner = u.userID WHERE postID = :postID';

        $stmt = $this->_dbHandle->prepare($sql);

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":postID", $param_postID, PDO::PARAM_STR);

        // Set parameters
        $param_postID = $postID;

        $stmt->execute(); // execute the PDO statement

        $postData = [];

        while ($row = $stmt->fetch()) {
            $postData[] = new PostData($row);
        }

        return $postData;  // return an array of UserData objects

    }

}