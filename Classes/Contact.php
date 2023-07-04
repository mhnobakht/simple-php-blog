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
}