<?php

require_once('model/Database.php');
class Post
{
    protected $_dbHandle, $_dbInstance;
    protected $postID, $postTitle, $postContent, $postOwner;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
        $this->postID = $this->postTitle = $this->postContent = $this->postOwner = "";
    }

    /**
     * @return string
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

    public function createPost($postTitle, $postContent)
    {
        $this->postTitle = $postTitle;
        $this->postContent = $postContent;
        $this->postOwner = $_SESSION["userID"];

        // Prepare an insert statement
        $sql = "INSERT INTO posts (postTitle, postContent, postOwner) VALUES (:postTitle,:postContent,:postOwner)";

        if ($stmt = $this->_dbHandle->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":postTitle",$param_postTitle,PDO::PARAM_STR);
            $stmt->bindParam(":postContent",$param_postContent, PDO::PARAM_STR);
            $stmt->bindParam(":postOwner",$param_postOwner, PDO::PARAM_STR);

            // Set parameters
            $param_postTitle = $this->postTitle;
            $param_postContent = $this->postContent;
            $param_postOwner = $this->postOwner;

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

    public function getPost()
    {
        // Prepare a select statement
        $sql = "SELECT * FROM posts";

        if ($stmt = $this->_dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            //$stmt->bindParam(":postOwner", $param_postOwner, PDO::PARAM_STR);

            // Set parameters
            //$param_postOwner = "23";//$_SESSION['userID'];

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                if ($stmt->rowCount() >= 1)
                {
                    if ($row = $stmt->fetch())
                    {
                        $this->postID = $row["postID"];
                        $this->postTitle = $row["postTitle"];
                        $this->postContent = $row["postContent"];
                        $this->postOwner = $row["postOwner"];




                    }
                    // Display an error message if password is not valid
                    return "There is no information to display.";
                }
                return "execute error";
            }
            else
            {
                // Display an error message if username doesn't exist
                return "No account found with that username.";
            }
        }
        else
        {
            return "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($pdo);
    }
}
