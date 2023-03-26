<?php
if(!isset($_GET['user_id'])) {
    Semej::set('danger', 'error', 'Missing user id');
    header('Location: dashboard.php?page=users');
}
$id = Sanitizer::sanitize($_GET['user_id']);

$user = new User();
$user->delete($id);