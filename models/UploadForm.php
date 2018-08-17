<?php
class UploadForm{
    public static $typesElement= ['jpeg','jpg','png'];
    public static function hash($name){
        $fileName = md5($name . uniqid());
        return $fileName;

    }
    public static function getNewFileTarget($file, $dir){
        $targetFile = $dir . '\\' . $file . '.jpeg';
        return $targetFile;
    }
    public static function uploadFile($file, $fileName){
        $uploadsDir = ROOT.'\uploads';
        $targetFile = UploadForm::getNewFileTarget($fileName, $uploadsDir);
        return move_uploaded_file($file['file']['tmp_name'], $targetFile);
    }
    public static function checkExtension($type){
        $typeImage = explode('/',$type);
        return in_array(end($typeImage), self::$typesElement);
    }

}