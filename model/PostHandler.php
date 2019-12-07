<?php

require_once('model/Database.php');
require_once('model/PostData.php');

class PostHandler
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

    /**
     * Provides 9 latest posts.
     * @return array
     */
    public function getLatestPost()
    {
        $sqlQuery = 'SELECT *,u.userName FROM posts p INNER JOIN users u ON p.postOwner = u.userID ORDER BY postDate DESC LIMIT 9';

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new PostData($row);
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