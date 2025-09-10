<?php
namespace Config;

use PDO;
use PDOException;
use execption;

class Database
{
    private $host;
    private $db_name;
    private $password;
    private $username;
    private $connection;

    public function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $db_name = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
    
        try{
            $this->connection = new PDO("mysql:host=$host;dbname=$db_name", $username);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e){
            echo "Connection error: " . $e->getMessage();
        }
        catch(Exception $e){
            echo "General error: " . $e->getMessage();
        }
}  public function getConnection()
    {
        return $this->connection;
    }
}
