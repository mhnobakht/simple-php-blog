<?php
if(!isset($_GET['message_id'])) {
    Semej::set('danger', 'error', 'Missing message id');
    header('Location: dashboard.php?page=messages');
}
$id = Sanitizer::sanitize($_GET['message_id']);

$message = new Contact();
$message->delete($id);