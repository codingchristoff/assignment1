<!-- Model -->
<?php


class UserData
{
// private fields
    private $_id, $_firstName, $_lastName, $_email, $_dateJoined, $_password;

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['userID'];
        $this->_firstName = $dbRow['first_name'];
        $this->_lastName = $dbRow['last_name'];
        $this->_email = $dbRow['email'];
        $this->_password = $dbRow['password'];
        $this->_dateJoined = $dbRow['dateJoined'];
    }

    public function getStudentID()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return string
     */
    public function getDateJoined()
    {
        return $this->_dateJoined;
    }
}