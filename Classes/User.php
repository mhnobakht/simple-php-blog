<?php


class User {

    protected $dbs;

    public function __construct() {
        $this->dbs = new Database();
    }

    public function getAll() {

        $users = $this->dbs->all('users');

        return $users;

    }


    public function create($formData) {

        $csrf_token = $formData['csrf_token'];

        if(!CsrfToken::validate($csrf_token)) {
            Semej::set('danger', 'Error', 'Missing CSRF Token');
            header('Location: dashboard.php?page=user-create');die;
        }


        $email = $formData['email'];
        $user = $this->dbs->select("users", "email = '$email'");

        if(count($user) != 0) {
            Semej::set('danger', 'error', "Email Exists");
            header('Location: dashboard.php?page=user-create');die;
        }

        $explodeEmail = explode('@', $email);
        $username = $explodeEmail[0];


        $password = md5($formData['password'].SALT);


        $data = [
            "firstname" => $formData['firstname'],
            "lastname" => $formData['lastname'],
            "email" => $formData['email'],
            "password" => $password,
            "username" => $username,
            "is_active" => (array_key_exists('is_active', $formData)) ? 1 : 0
        ];

        $result = $this->dbs->insert('users', $data);

        if($result != 1) {
            Semej::set('danger', 'Error', 'Create user failed');
            header('Location: dashboard.php?page=user-create');die;
        }

        Semej::set('success', 'OK', 'User created successfully.');
        header('Location: dashboard.php?page=users');die;

    }


    public function edit($id) {
        $user  = $this->dbs->select('users', "id = '$id'");
        return $user;
    }

    public function update($id, $formData) {

        $csrf_token = $formData['csrf_token'];

        if(!CsrfToken::validate($csrf_token)) {
            Semej::set('danger', 'Error', 'Missing CSRF Token');
            header('Location: dashboard.php?page=user-edit&user_id='.$id);die;
        }

        $user = $this->dbs->select('users', "id = '$id'");

        $password = (strlen($formData['password']) == 0) ? $user[0]['password'] : md5($formData['password'].SALT);

        $data = [
            "firstname" => $formData['firstname'],
            "lastname" => $formData['lastname'],
            "email" => $formData['email'],
            "password" => $password,
            "is_active" => (array_key_exists('is_active', $formData)) ? 1 : 0
        ];

        $this->dbs->update('users', $data, "id = '$id'");
        Semej::set('success', 'OK', 'User Updated Successfully.');
        header('Location: dashboard.php?page=users');die;
    }

    public function delete($id) {

        $this->dbs->delete('users', "id = '$id'");
        Semej::set('success', 'OK', 'User Deleted Successfully.');
        header('Location: dashboard.php?page=users');die;

    }


    public function getUser($id) {
        $user = $this->dbs->select('users', "id = $id");

        return $user[0];
    }
}