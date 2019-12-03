<!-- Login -->
<?php

require_once('model/User.php');

class Login extends User
{

    private $passHash;

    function __construct()
    {
        parent::__construct();
        $this->passHash = "empty";
    }

    public function test($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;

        $result = $this->userName . " " . $this->password . "" . $this->passHash;

        return $result;
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
            if ($stmt->execute()) {
                // $dataSet = [];
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["userID"];
                        $username = $row["userName"];
                        $hashed_password = $row["password"];
                        $this->passHash = $hashed_password;


                        if (password_verify($password, $hashed_password))
                        {
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            return "Logged in";
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
        }

        // Close connection
        unset($pdo);
    }
}




               /* while ($row = $stmt->fetch()) {
                    $dataSet = new UserData($row);
                }

                foreach ($dataSet as $password) {
                    $this->passHash = $password->getPassword();
                }

                if (password_verify($this->password, $this->passHash)) {
                    return "Logged in";
                }
                return "password wrong" . $this->passHash;
            } else {
                return "Error";
                //$this->userName = trim($userName);
            }*/
