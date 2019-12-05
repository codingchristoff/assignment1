<?php

require_once('model/Database.php');
require_once('model/UserData.php');

class UserHandler
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function login($userName, $password)
    {
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE userName = :userName";

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
                        $userData = new UserData($row);

                        $hashedPassword = $userData->getPassword();

                        if (password_verify($password, $hashedPassword))
                        {
                            $userData->setLoggedIn(true);
                            $_SESSION["loggedin"] = $userData->getLoggedIn();
                            $_SESSION["userID"] = $userData->getUserID();
                            $_SESSION["firstName"] = $userData->getFirstName();
                            $_SESSION["lastName"] = $userData->getLastName();
                            $_SESSION["email"] = $userData->getEmail();
                            $_SESSION["userName"] = $userData->getUserName();
                            $_SESSION["profileImage"] = $userData->getProfileImage();

                            session_write_close();

                            //Redirects to account page on login
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

    public function logOut()
    {
        session_destroy();

        // Redirect to login page
        $URL = "index.php";
        return '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    public function register($firstName, $lastName, $email, $userName, $password, $confirm_password)
    {
        $userVerify = $this->validateUserName($userName);
        $passVerify = $this->validatePassword($password, $confirm_password);

        if ($userVerify === true && $passVerify === true)
        {
            return $this->sendToDB($firstName, $lastName, $email, $userName, $password);
        }
        else
        {
            return "Please correct the following errors: " . $userVerify . " " . $passVerify;
        }
    }

    private function sendToDB($firstName, $lastName, $email, $userName, $password)
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
            $param_firstName = trim($firstName);
            $param_lastName = trim($lastName);
            $param_email = trim($email);
            $param_userName = trim($userName);
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                return "Successfully registered, please login.";
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
                    return true;
                }
            }
            else
            {
                return "An error has occurred, please try again later.";
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
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
            return true;
        }
    }
}