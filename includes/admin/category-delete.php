<?php
if(!isset($_GET['category_id'])) {
    Semej::set('danger', 'error', 'Missing user id');
    header('Location: dashboard.php?page=categories');
}
$id = Sanitizer::sanitize($_GET['category_id']);

$category = new Category();
$category->delete($id);