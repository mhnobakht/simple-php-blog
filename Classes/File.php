<?php

class File {

    protected $valid_ext = ['jpg', 'jpeg', 'png'];
    protected $valid_mime = ['image/jpeg', 'image/png'];

    public function upload($file) {
        
        // check errors
        if($file['error'] != 0) {
            return false;
        }

        // check ext
        $name = Sanitizer::sanitize($file['name']);
        $name_array = explode('.', $name);
        $ext = end($name_array);

        if(!in_array($ext, $this->valid_ext)) {
            return false;
        }

        // check mime
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        if(!in_array($mime, $this->valid_mime)) {
            return false;
        }

        // create new name image.png
        $new_name = bin2hex(random_bytes(13)).'.'.$ext;

        // upload image
        $path = 'uploads/'.$new_name;

        if(move_uploaded_file($file['tmp_name'], $path)) {
            return $path;
        }else {
            return false;
        }

    }


    public function delete($path) {
        if(file_exists($path)) {
            unlink($path);
        }

        return true;
    }
}