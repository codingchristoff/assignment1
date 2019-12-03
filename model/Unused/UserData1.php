<!-- Model -->
<?php


class UserData1
{
// private fields
    private $username, $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_Password;
    }
}