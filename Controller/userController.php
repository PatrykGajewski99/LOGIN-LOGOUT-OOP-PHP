<?php
if(!isset($_SESSION))
{
    session_start();
}
include_once '../DataBase/connection.php';
class User extends Connection
{
    protected function checkPassword(string $password, string $confirmPass) : bool
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars  || strlen($password) < 8 ) {
            echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special characters.')</script>";
            return false;
        }
        else{
            if($password!=$confirmPass)
            {
                echo '<script> alert("Passwords are different")</script>';
                return false;
            }
            return true;
        }
    }
    protected function checkEmail(string $email) : bool
    {
        $dbName=$this->tableName;
        $conn=$this->dbConnecting();
        $sql="SELECT count(*) from $dbName where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]);
        $numberOfRows=$stmt->fetchColumn();
        if($numberOfRows==0)
        {
            return true;
        }
        return false;

    }
    protected function checkUserName(string $userName) : bool
    {
        $dbName=$this->tableName;
        $conn=$this->dbConnecting();
        $sql="SELECT count(*) from $dbName where userName=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$userName]);
        $numberOfRows=$stmt->fetchColumn();
        if($numberOfRows==0)
        {
            return true;
        }
        return false;

    }
    public function addUser()
    {
        try {
            $userName= filter_var($_POST['userName'],FILTER_SANITIZE_STRING);
            $fullName= filter_var($_POST['fullName'],FILTER_SANITIZE_STRING);
            $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $password=filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
            $confirmPass= filter_var($_POST['confirmPass'],FILTER_SANITIZE_STRING);
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
    public function logIn()
    {
        try {
            $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $password=filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            $hashedPassword=sha1($password);
            $sql="SELECT count(*) FROM $dbName WHERE email=? AND password=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$email,$hashedPassword]);
            $numberOfRows=$stmt->fetchColumn();
            if($numberOfRows==1)
            {
                header("Location: myAccount.php");
                $_SESSION["login"]=true;
            }
            else
                echo '<script> alert("Incorrect email or password !")</script>';

        }catch(PDOException $e)
        {
            echo "Something was wrong: " . $e->getMessage();
        }
    }
    public function deleteAccount()
    {
        try {
            $email=$_SESSION['email'];
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            $sql="DELETE FROM $dbName WHERE email=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$email]);
            $_SESSION["login"]=false;
            header("Location: ../registration.php");
        }catch (PDOException $e)
        {
            echo "Something was wrong: " . $e->getMessage();
        }
    }
    public function getUserData()
    {
        try {
            $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $_SESSION['email']=$email;
            $dbName=$this->tableName;
            $conn=$this->dbConnecting();
            $sql="SELECT userName, fullName from $dbName WHERE email=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$email]);
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
if(!empty($_POST))
{
    $user=new User();
    if(isset($_POST['registraion']))
        $user->addUser();
    elseif (isset($_POST['logIn']))
    {
        $user->getUserData();
        $user->logIn();
    }
    elseif(isset($_POST['deleteAccount']))
        $user->deleteAccount();
}