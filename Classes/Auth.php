<?php

class Auth {

    protected $dbs;

    public function __construct() {
        $this->dbs = new Database();
    }

    public function register($formData) {

        $csrf_token = $formData['csrf_token'];

        if(!CsrfToken::validate($csrf_token)) {
            Semej::set('danger', 'error', "Missing CSRF Token.");
            header('Location: register.php');die;
        }
        
        if($formData['password'] != $formData['passwordConfirm']) {
            Semej::set('danger', 'error', "Password doesn't match.");
            header('Location: register.php');die;
        }

        $email = $formData['email'];

        $checkEmail = (count($this->dbs->select('users', "email = '$email'")) > 0) ? true : false;

       if($checkEmail) {
        Semej::set('danger', 'error', "Email Exists.");
            header('Location: register.php');die;
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


       $result = $this->dbs->insert('users', $data);

       if($result != 1) {
            Semej::set('danger', 'error', "Signup failed. tray again later.");
            header('Location: register.php');die;
       }

       Semej::set('success', 'OK', "Please login now.");
       header('Location: login.php');die;
    }

}