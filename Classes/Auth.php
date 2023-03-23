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


    public function login($formData) {
        $csrf_token = $formData['csrf_token'];

        if(!CsrfToken::validate($csrf_token)) {
            Semej::set('danger', 'error', "Missing CSRF Token.");
            header('Location: login.php');die;
        }

        $email = $formData['email'];
        $password = md5($formData['password'].SALT);
        $user = $this->dbs->select("users", "email = '$email'");

        if(count($user) == 0) {
            Semej::set('danger', 'error', "incorrect Email or password.");
            header('Location: login.php');die;
        }
        
        if($user[0]['password'] != $password) {
            Semej::set('danger', 'error', "incorrect Email or password.");
            header('Location: login.php');die;
        }

        if(!$user[0]['is_active']) {
            Semej::set('danger', 'error', "Your Account is not active.");
            header('Location: login.php');die;
        }

        $user = $user[0];

        $_SESSION['auth_user'] = [
            "username" => $user['username'],
            "id" => $user['id'],
            "email" => $user['email']
        ];

        // generate auth token
        $token = $this->generateToken($user['email']);

        $_SESSION['auth_token'] = $token;

        header('Location: dashboard/index.php');die;
        
    }

    protected function generateToken($email) {
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $token = sha1(SALT.$remote_addr.$email);
        return $token;
    }

    public function validateToken() {
        if(!isset($_SESSION)) {
            return false;
        }

        if(!isset($_SESSION['auth_user']) || !isset($_SESSION['auth_token'])) {
            return false;
        }

        $email = $_SESSION['auth_user']['email'];
        $token = $_SESSION['auth_token'];

        $generated_token = $this->generateToken($email);

        if($token != $generated_token) {
            return false;
        }

        return true;
        
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}