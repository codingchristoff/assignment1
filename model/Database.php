<!-- Model -->
<?php

class Database
{
    /**
     * @var Database
     */
    protected static $_dbInstance = null;

    /**
     * @var PDO
     */
    protected $_dbHandle;

    /**
     * @return Database
     */
    public static function getInstance() {
        $username ='sgb770';
        $password = '1e6xpAeVPP15aXi';
        $host = 'poseidon.salford.ac.uk';
        $dbName = 'sgb770';

        if(self::$_dbInstance === null) //checks if the PDO exists
        {
            // creates new instance if not, sending in connection info
            self::$_dbInstance = new self($username, $password, $host, $dbName);
        }

        return self::$_dbInstance;
    }

    /**
     * @param $username
     * @param $password
     * @param $host
     * @param $database
     */
    private function __construct($username, $password, $host, $database)
    {
        try
        {
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database",  $username, $password); // creates the database handle with connection info
        }
        catch (PDOException $e)
        { // catch any failure to connect to the database
            echo "Connection to Database could not be established.";
            //echo $e->getMessage(); //Debugging code
        }
    }

    /**
     * @return PDO
     */

    public function getdbConnection() {
        return $this->_dbHandle; // returns the PDO handle to be used elsewhere
    }
    // Closing Database
    public function __destruct() {
        $this->_dbHandle = null; // destroys the PDO handle when no longer needed
    }

}