<?php
if(!isset($_GET['post_id'])) {
    Semej::set('danger', 'error', 'Missing Post id');
    header('Location: dashboard.php?page=postss');
}
$id = Sanitizer::sanitize($_GET['post_id']);

$post = new Post();
$post->delete($id);