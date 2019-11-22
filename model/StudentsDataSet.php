<!-- Model -->
<?php

require_once('model/UserData.php');  // class from previous slide
require_once ('model/database.php');

class StudentsDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllStudents()
    {
        $sqlQuery = 'SELECT * FROM users';

        echo $sqlQuery;  //helpful for debugging to see what SQL query has been created

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;  // return an array of UserData objects
    }
}