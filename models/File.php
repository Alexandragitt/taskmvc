<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 21.08.2018
 * Time: 11:19
 */

class File
{
    public static $typesFile= ['vnd.ms-excel'];
    public static function checkExtension($file){
        $typeUploadedFile = explode('/',$file['fileToUpload']['type']);
        return in_array(end($typeUploadedFile), self::$typesFile);
    }
    public static function getDataFile($file){
        $handle = fopen($file['fileToUpload']['tmp_name'], "r+");

        $row = 1;
        $forDB = [];
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);
            $row++;
            $forDB[] = $data;

        }
       return $forDB;

    }
    public static function insertData($array)
    {
        $db = Db::getConnection();
        $countTasks = $db->prepare('SELECT count(id_mvc) as count from task_example where id_mvc = :id_mvc');
        $result = $db->prepare('INSERT INTO task_example (id_author,id_mvc) VALUES (:id_author, :id_mvc)');
        foreach ($array as $item) {
            $countTasks->bindParam(':id_mvc', $item[0], PDO::PARAM_INT);
            $count = $countTasks->execute();
            $count = $countTasks->fetch();
            if($count['count'] < 2 || $count['count'] == 0 ){
            $result->bindParam(':id_mvc', $item[0], PDO::PARAM_INT);
        $result->bindParam(':id_author', $item[1], PDO::PARAM_INT);
        $getElement = $result->execute();
            }
        }
    }

}