<?php

require_once __DIR__.'/../autoload.php';

$auth = new Auth();

if(!$auth->validateToken()) {
    $auth->logout();
    header('Location: ../login.php');die;
}