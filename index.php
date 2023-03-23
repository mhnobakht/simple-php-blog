<?php

include_once 'Classes/Sanitizer.php';

$input = ['majid', '<script>alert(1)</script>'];
$input2 = ['firstname' => 'majid', 'color' => 'black'];

$result = Sanitizer::sanitize($input2);

var_dump($result);