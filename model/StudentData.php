<!-- Model -->
<?php


class StudentData
{
// private fields
    private $_id, $_firstName, $_lastName, $_international, $_courseID;

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['id'];
        $this->_firstName = $dbRow['first_name'];
        $this->_lastName = $dbRow['last_name'];
        if ($dbRow['international'])
            $this->_international = 'yes';
        else
            $this->_international = 'no';
        $this->_courseID = $dbRow['courseID'];
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
    public function getCourseID()
    {
        return $this->_courseID;
    }

    /**
     * @return string
     */
    public function getInternational()
    {
        return $this->_international;
    }
}