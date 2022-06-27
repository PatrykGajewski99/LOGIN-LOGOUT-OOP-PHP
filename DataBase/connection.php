<?php
include_once "../Model/DataBase.php";
class Connection extends DataBase
{
    protected function dbConnecting()
    {
        try {
            $conn = new PDO("mysql:host=$this->serverName;dbname=$this->dateBaseName", $this->userName, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e)
        {
            echo "Connecting error: ". $e->getMessage();
        }
        return $conn;
    }
}