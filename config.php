<?php
session_start();
ob_start();
// database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'phpblog');


// salt
define('SALT', 'f118231db2907365680897e074261bef6a92085caa8dec243c769bcd7cb18de629');