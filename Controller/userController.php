<?php
include_once '../DataBase/connection.php';
class User extends Connection
{
    protected function checkPassword($password,$confirmPass)
    {
        if($password!=$confirmPass)
        {
            return false;
        }
        return true;
    }
    protected function checkEmail($email)
    {
        $dbName=$this->tableName;
        $conn=$this->dbConnecting();
        $sql="SELECT count(*) from $dbName where email='$email'";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $numberOfRows=$stmt->fetchColumn();
        if($numberOfRows==0)
        {
            return true;
        }
        return false;

    }
    protected function checkUserName($userName)
    {
        $dbName=$this->tableName;
        $conn=$this->dbConnecting();
        $sql="SELECT count(*) from $dbName where userName='$userName'";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $numberOfRows=$stmt->fetchColumn();
        if($numberOfRows==0)
        {
            return true;
        }
        return false;

    }
    public function addUser($userName,$fullName,$email,$password,$confirmPass)
    {
        try {
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            if($this->checkUserName($userName))
            {
                if($this->checkEmail($email))
                {
                    if($this->checkPassword($password,$confirmPass))
                    {
                        $hashedPassword=sha1($password);
                        $sql="INSERT INTO $dbName VALUES ('NULL',?,?,?,?)";
                        $stmt=$conn->prepare($sql);
                        $stmt->execute([$userName,$fullName,$email,$hashedPassword]);
                        echo '<script> alert("You are register successfully!")</script>';
                    }
                    else
                        echo '<script> alert("Passwords are different")</script>';
                }
                else
                    echo '<script> alert("Email exist in the data base!")</script>';

            }
            else
                echo '<script> alert("This user name is not available, exist in the data base !")</script>';


        }catch(PDOException $e)
        {
            echo "Something was wrong: " . $e->getMessage();
        }
    }
    public function logIn($email,$password)
    {
        try {
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            $hashedPassword=sha1($password);
            $sql="SELECT count(*) FROM $dbName WHERE email='$email' AND password='$hashedPassword'";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $numberOfRows=$stmt->fetchColumn();
            if($numberOfRows==1)
            {
                header("Location: myAccount.php");
                $_SESSION["logIn"]=true;
            }
            else
                echo '<script> alert("Incorrect email or password !")</script>';

        }catch(PDOException $e)
        {
            echo "Something was wrong: " . $e->getMessage();
        }
    }
    public function deleteAccount($email)
    {
        try {
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            $sql="DELETE FROM $dbName WHERE email='$email'";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            echo '<script> alert("User deleted!")</script>';
            header("Location: http://localhost/userRegister_OOP/View/registration.php");
        }catch (PDOException $e)
        {
            echo "Something was wrong: " . $e->getMessage();
        }
    }
    public function getUserData($email)
    {
        try {
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            $sql="SELECT userName, fullName from $dbName WHERE email='$email'";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            while($row=$stmt->fetch())
            {
                $_SESSION['userName']=$row['userName'];
                $_SESSION['fullName']=$row['fullName'];
            }
        }catch (PDOException $e)
        {
            echo "Something was wrong: " . $e->getMessage();
        }
    }
}