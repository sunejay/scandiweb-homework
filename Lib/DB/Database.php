<?php 
namespace Scandiweb\Lib\DB;

/**
 * Description of Database
 *
 * @author Sune
 * 
 * This class is for database connection
 */
class Database 
{    
    private $dbHandler;

    public function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $name = $_ENV['DB_NAME'];

        // Create connection 
        $this->dbHandler = new \mysqli($host, $user, $password, $name);

        // Check connection
        if ($this->dbHandler->connect_error) {
            die("Connection failed: " . $this->dbHandler->connect_error);
        }
        // echo "Connected successfully";
    }

    // Return the DB Handler
    public function getDbHandler()
    {
        return $this->dbHandler;
    }
}
