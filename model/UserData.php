<?php


class UserData
{
    private $userID, $firstName, $lastName, $email, $userName, $password, $dateJoined, $loggedIn, $profileImage;

    public function __construct($dbRow)
    {
        $this->userID = $dbRow['userID'];
        $this->firstName = $dbRow['firstName'];
        $this->lastName = $dbRow['lastName'];
        $this->email = $dbRow['email'];
        $this->userName = $dbRow['userName'];
        $this->password = $dbRow['password'];
        $this->dateJoined = $dbRow['dateJoined'];
        $this->loggedIn = false;
        $this->profileImage = $dbRow['profileImage'];
    }

    /**
     * @return string
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getDateJoined()
    {
        return $this->dateJoined;
    }

    /**
     * @return mixed
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function getLoggedIn()
    {
        return $this->loggedIn;
    }

    /**
     * @param bool $loggedIn
     */
    public function setLoggedIn($loggedIn)
    {
        $this->loggedIn = $loggedIn;
    }


}