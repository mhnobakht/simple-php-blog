<?php


class Post {
    protected $dbs;

    public function __construct() {
        $this->dbs = new Database();
    }

    public function create($formData, $formFile) {

        // sanitize form data
        $formData = Sanitizer::sanitize($formData);

        // get user_id
        $user_id = Sanitizer::sanitize($_SESSION['auth_user']['id']);

        // upload image
        $file = new File();
        $image = $file->upload($formFile);

        if($image === false) {
            Semej::set('danger', 'Error', 'File upload error.');
            header('Location: dashboard.php?page=posts');die;
        }

        // save post
        $data = [
            "title" => $formData['title'],
            'description' => $formData['description'],
            'user_id' => $user_id,
            'image' => $image
        ];
        $this->dbs->insert('posts', $data);

        // add categories to post
        $post_id = $this->dbs->lastInsertId();
        $category_ids = $formData['categories'];
        $post_category = new PostCategory();
        if($post_category->sync($post_id, $category_ids)) {
            Semej::set('success', 'OK', 'Post Saved');
            header('Location: dashboard.php?page=posts');die;
        }

    }
}