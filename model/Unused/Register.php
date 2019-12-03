<!-- Model -->
<?php

require_once('model/Database.php');

class Register
{
    protected $_dbHandle, $_dbInstance;
    protected $firstName, $lastName, $email, $userName, $password, $confirm_password;
    protected $userName_err, $password_err, $confirm_password_err;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
        $this->firstName = $this->lastName = $this->email = $this->userName = $this->password = $this->confirm_password = "";
        $this->userName_err = $this->password_err = $this->confirm_password_err = "";
    }

    public function validate($firstName, $lastName, $email, $userName, $password, $confirm_password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;

        // Validate userName
        if (empty(trim($userName)))
        {
            $this->userName_err = "Please enter a userName.";
        }
        else
        {
            // Prepare a select statement
            $sql = "SELECT userID FROM users WHERE userName = :userName";

            if ($stmt = $this->_dbHandle->prepare($sql))
            {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":userName", $param_userName, PDO::PARAM_STR);

                // Set parameters
                $param_userName = trim($userName);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        return "This userName is already taken.";
                    }
                    else
                    {
                       $this->userName = trim($userName);
                    }
                }
                else
                {
                    return "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            unset($stmt);
        }
        // Validate password
        if (empty(trim($password)))
        {
            return "Please enter a password.";
        }
        elseif (strlen(trim($password)) < 6)
        {
            return "Password must have at least 6 characters.";
        }
        else
        {
            $password = trim($password);
        }
        // Validate confirm password
        if (empty(trim($confirm_password)))
        {
            return "Please confirm password.";
        }
        else
        {
            $this->confirm_password = trim($confirm_password);
            if (empty($password_err) && ($password != $confirm_password))
            {
                return "Password did not match.";
            }
               return $this->sendToDB($password);
        }
        return $this->userName_err;
    }

    public function sendToDB($password)
    {
        // Check input errors before inserting in database
        if (empty($this->userName_err) && empty($this->password_err) && empty($this->confirm_password_err))
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
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if ($stmt->execute())
                {
                    return "Successful" . $param_password . $this->password;
                }
                else
                {
                    return "Something went wrong. Please try again later.";
                }

            }
            // Close statement
            unset($stmt);
        }
        // Close connection
        unset($pdo);
    }
}

