<?php

class PostCategory {
    protected $dbs;
    protected $table = 'category_post';

    public function __construct() {
        $this->dbs = new Database();
    }

    public function attach($post_id, $category_id) {
        $data = [
            'category_id' => $category_id,
            'post_id' => $post_id
        ];
        $this->dbs->insert($this->table, $data);

        return true;
    }

    public function detach($post_id, $category_id) {
        $this->dbs->delete($this->table, "post_id = $post_id AND category_id = $category_id");

        return true;
    }

    public function sync($post_id, $category_ids) {

        $this->dbs->delete($this->table, "post_id = $post_id");

        foreach($category_ids as $category_id) {
            $post_id = Sanitizer::sanitize($post_id);
            $category_id = Sanitizer::sanitize($category_id);
            $this->attach($post_id, $category_id);
        }

        return true;
    }

    public function getCategories($post_id) {
        $categories = $this->dbs->select($this->table, "post_id = $post_id");
        return $categories;
    }
}