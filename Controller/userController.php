<?php
include_once '../Model/userModel.php';
class UserController extends User
{
    public function addUser($userName,$fullName,$email,$password,$confirmPass)
    {
        $this->createUser($userName,$fullName,$email,$password,$confirmPass);
    }
    public function logIn($email,$password)
    {
        $this->getUser($email,$password);
        return $email;
    }
    public function delete($email)
    {
        $this->deleteAccount($email);
    }
}