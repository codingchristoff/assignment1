<!-- Model -->
<?php

require_once('model/Database.php');
class User
{
    protected $_dbHandle, $_dbInstance;
    protected $userID, $firstName, $lastName, $email, $userName, $password, $dateJoined, $loggedIn;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
        $this->userID = $this->firstName = $this->lastName = $this->email = $this->userName = $this->password = $this->dateJoined = "";
        $this->loggedIn = false;
    }

    public function getName()
    {
        return $this->userName;
    }

    public function getID()
    {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getLoggedIn()
    {
        return $this->loggedIn;
    }

    public function logOut()
    {
        //session_start();
// Destroy the session.
        session_destroy();

// Redirect to login page
        $URL = "index.php";
        return '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        //header("location: index.php");
        //exit;

    }

    public function login($userName, $password)
    {
        // Prepare a select statement
        $sql = "SELECT userID,userName,password FROM users WHERE userName = :userName";

        if ($stmt = $this->_dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userName", $param_userName, PDO::PARAM_STR);

            // Set parameters
            $param_userName = trim($userName);

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                if ($stmt->rowCount() == 1)
                {
                    if ($row = $stmt->fetch())
                    {
                        $this->userID = $row["userID"];
                        $this->userName = $row["userName"];

                        $hashedPassword = $row["password"];

                        if (password_verify($password, $hashedPassword))
                        {
                            $this->loggedIn = true;

                            $_SESSION["loggedin"] = $this->getLoggedIn();
                            $_SESSION["userID"] = $this->userID;
                            $_SESSION["userName"] = $this->getName();

                            print_r($_SESSION);
                            session_write_close();

                            $URL = "account.php";
                            return '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

                        }
                    }
                    else
                    {
                        // Display an error message if password is not valid
                        return "The password you entered was not valid.";
                    }
                }
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

    public function register($firstName, $lastName, $email, $userName, $password, $confirm_password)
    {
        $userVerify = $this->validateUserName($userName);
        $passVerify = $this->validatePassword($password, $confirm_password);

        if ($userVerify === true && $passVerify === true)
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            return $this->sendToDB();
        }
        else
        {
            return "Please correct the following errors: " . $userVerify . " " . $passVerify;
        }
    }

    private function sendToDB()
    {
        // Prepare an insert statement
        $sql = "INSERT INTO users (firstName,lastName,email,userName,password) VALUES (:firstName,:lastName,:email,:userName,:password)";

        if ($stmt = $this->_dbHandle->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstName",$param_firstName,PDO::PARAM_STR);
            $stmt->bindParam(":lastName",$param_lastName, PDO::PARAM_STR);
            $stmt->bindParam(":email",$param_email, PDO::PARAM_STR);
            $stmt->bindParam(":userName", $param_userName, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_firstName = $this->firstName;
            $param_lastName = $this->lastName;
            $param_email = $this->email;
            $param_userName = $this->userName;
            $param_password = password_hash($this->password, PASSWORD_DEFAULT); // Creates a password hash

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

    private function validateUserName($userName)
    {
        //Code to verify if username is already in DB
        // Prepare a select statement
        $sql = "SELECT userID FROM users WHERE userName = :userName";

        if ($stmt = $this->_dbHandle->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userName", $param_userName, PDO::PARAM_STR);

            // Set parameters
            $param_userName = $userName;

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                if ($stmt->rowCount() == 1)
                {
                    return "This username is already taken.";
                }
                else
                {
                    $this->userName = trim($userName);
                    return true;
                }
            }
            else
            {
                return "An error has occurred, please try again later.";
            }
        }
        // Close statement
        unset($stmt);
        unset($pdo);
    }

    private function validatePassword($password, $confirm_password)
    {
        //Check password is more than 6 characters
        if (strlen(trim($password)) < 6)
        {
            return "Password must have at least 6 characters.";
        }
        elseif ($password != $confirm_password)
        {
            return "Password did not match.";
        }
        else
        {
            $this->password = trim($password);
            return true;
        }
    }

}
