<!-- Model -->
<?php

require_once('model/Database.php');
class User
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
}
