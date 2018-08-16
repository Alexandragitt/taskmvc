<?php
class UploadForm{

    public static function hash($name){
        $fileName = md5($name . Uniqid());
        return $fileName;

    }
    public static function getNewFileTarget($file, $dir){
        $targetFile = $dir . '\\' . $file . '.jpeg';
        return $targetFile;
    }
    public static function uploadFile($file, $newFile){
        move_uploaded_file($file, $newFile);
        return true;


    }

}