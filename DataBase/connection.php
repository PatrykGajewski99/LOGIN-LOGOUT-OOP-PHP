<?php
class Connection
{
    private $serverName="localhost";
    private $dateBaseName="logowanie";
    private $userName="root";
    private $password="";
    protected $tableName='users';
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