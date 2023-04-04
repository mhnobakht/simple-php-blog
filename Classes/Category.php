<?php


class Category {

    protected $dbs;

    public function __construct() {
        $this->dbs = new Database();
    }

    public function getParents() {
        $parents = $this->dbs->select('categories', "parent_id = '0'");
        return $parents;
    }

    public function create($formData) {

        $csrf_token = $formData['csrf_token'];
        

        if(!CsrfToken::validate($csrf_token)) {
            Semej::set('danger', 'error', 'Missing CSRF Token');
            header('Location: dashboard.php?page=category-create');die;
        }

        $data = [
            'title' => $formData['title'],
            'parent_id' => $formData['parent_id']
        ];

        $result = $this->dbs->insert('categories', $data);

        if($result != 1) {
            Semej::set('danger', 'error', 'Failed create category.');
            header('Location: dashboard.php?page=category-create');die;
        }

        Semej::set('success', 'OK', 'Category created successfully.');
            header('Location: dashboard.php?page=categories');die;

    }

    public function getAll() {
        $categories = $this->dbs->all('categories');
        return $categories;
    }

    public function edit($id) {
        $category = $this->dbs->select('categories', "id = '$id'");
    
        return $category[0];
    }

    public function update($id, $formData) {

        $csrf_token = $formData['csrf_token'];
        

        if(!CsrfToken::validate($csrf_token)) {
            Semej::set('danger', 'error', 'Missing CSRF Token');
            header('Location: dashboard.php?page=category-edit&category_id='.$id);die;
        }

        $data = [
            'title' => $formData['title'],
            'parent_id' => $formData['parent_id']
        ];

        $result = $this->dbs->update('categories', $data, "id = '$id'");

        if($result != 1) {
            Semej::set('danger', 'error', 'update failed.');
            header('Location: dashboard.php?page=category-edit&category_id='.$id);die;
        }

        Semej::set('success', 'OK', 'category updated successfully.');
        header('Location: dashboard.php?page=categories');die;

    }


    public function delete($id) {
        $this->dbs->delete('categories', "id = '$id'");

        Semej::set('success', 'OK', 'category deleted successfully.');
        header('Location: dashboard.php?page=categories');die;
    }

}