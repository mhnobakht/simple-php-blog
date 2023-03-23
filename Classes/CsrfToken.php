<?php

class CsrfToken {

    public static function generate() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }


    public static function validate($token) {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }

        if ($_SESSION['csrf_token'] !== $token) {
            return false;
        }

        unset($_SESSION['csrf_token']);
        return true;
    }

}