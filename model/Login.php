<!-- Login -->
<?php

require_once ('model/UserData.php');

class Login extends User
{
    function __construct()
    {
        parent::__construct();
    }

    public function test($userName,$password)
    {
        $this->userName = $userName;
        $this->password = $password;

        $result = $this->userName ." " . $this->password;
        return $result;
    }

    public function login($userName, $password)
    {
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE userName = :userName";

        if ($stmt = $this->_dbHandle->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userName", $param_userName, PDO::PARAM_STR);

            // Set parameters
            $param_userName = trim($userName);

            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                if ($stmt->rowCount() == 1) {

                    $row = $stmt->fetchAll();

               //dunnooooooo but somehow need to get this data from db

                    if (password_verify($password, $dbPassword)) {
                        return "Logged in";

                    } else {
                        return "password wrong";
                    }
                }
            else
                {
                    return "Error";
                    //$this->userName = trim($userName);
                }
            }
        }

        return "Error2";
    }
}