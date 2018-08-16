<?php
class UploadForm{

    public function hash($name){
        $fileName = md5($_FILES["file"]["name"] . Uniqid());
        return $fileName;

    }
    public function getNewFileTarget($file, $dir){
        $targetFile = $dir . '\\' . $file . '.jpeg';
        return $targetFile;
    }
    public function uploadFile($file, $newFile){
        move_uploaded_file($file, $newFile);
        return true;


    }

}