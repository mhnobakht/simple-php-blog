<?php

class Auth {

    protected $dbs;

    public function __construct() {
        $this->dbs = new Database();
    }

    public function register($formData) {
        
        if($formData['password'] != $formData['passwordConfirm']) {
            echo 'not matched password';die;
        }

        $email = $formData['email'];

        $checkEmail = (count($this->dbs->select('users', "email = '$email'")) > 0) ? true : false;

       if($checkEmail) {
        echo 'Email Exists';die;
       }
       

       $explodeEmail = explode('@', $email);
       $username = $explodeEmail[0];

       $password = md5($formData['password'].SALT);

       $data = [
        'firstname' => $formData['firstname'],
        'lastname' => $formData['lastname'],
        'username' => $username,
        'email' => $email,
        'password' => $password
       ];


       $this->dbs->insert('users', $data);
    }

}