<?php

class Contact {
    protected $dbs;

    public function __construct() {
        $this->dbs = new Database();
    }

    public function create($formData) {
        
        $result = $this->dbs->insert('messages', $formData);

        if($result != 1) {
            Semej::set('danger', 'error', 'Failed to send message.');
            header('Location: contact.php');die;
        }

        Semej::set('success', 'OK', 'Message sent successfully.');
        header('Location: contact.php');die;

    }

    public function getAll() {
        $messages = $this->dbs->all('messages');
        return $messages;
    }

    public function show($id) {
        $message = $this->dbs->select('messages', "id = '$id'");
        $this->read($id);
    
        return $message[0];
    }

    public function read($id) {
        $data = [
            'is_read' => 1
        ];

        $this->dbs->update('messages', $data, "id = '$id'");
    }

    public function delete($id) {
        $this->dbs->delete('messages', "id = '$id'");
        Semej::set('warning', 'Warning', 'message deleted successfully.');
        header('Location: dashboard.php?page=messages');die;
    }
}