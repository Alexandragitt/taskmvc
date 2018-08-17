<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 12.08.2018
 * Time: 17:43
 */

class Admin
{
    public static function getArrayTasks(){
        $db=Db::getConnection();
        $result = $db->prepare('SELECT * FROM mvc ');
         $arrayTasks=$result->execute();
        $arrayTasks = $result->fetchAll();
        return $arrayTasks;
    }
    public static function getElementByID($id){
        $db=Db::getConnection();
        $result = $db->prepare('SELECT * FROM mvc where id=:id');
        $result->bindParam(':id', $id, PDO::PARAM_INT );
        $getElement=$result->execute();
        $getElement = $result->fetchAll();
        return $getElement;
    }
    public static function updateElement($data, $nameImage){
        $db=Db::getConnection();
        $result = $db->prepare("UPDATE mvc SET `email`=:email,`text`=:text,`img`=:name where id=:id");
        $result->bindParam(':email', $data['email'] );
        $result->bindParam(':text', $data['text'] );
        $result->bindParam(':id', $data['id']  );
        $result->bindParam(':name', $nameImage);
        return $result->execute();;
    }
    public static function deleteElement($id){
        $db=Db::getConnection();
        $result = $db->prepare("DELETE FROM `mvc` WHERE `id` = :id");
        $result->bindParam(':id', $id );
        return $result->execute();;
    }
    public static function insertElement($data, $fileName){
        $db=Db::getConnection();
        $new= $db->prepare("INSERT INTO mvc (email, text, img) 
                            VALUES(:email, :text, :img)");
        $new->bindParam(':email', $data['email']);
        $new->bindParam(':text', $data['text']);
        $new->bindParam(':img', $filename);
        return $new->execute();;
    }
    public static function explodeType($string){
        $segments = explode('/', $string);
        return end($segments);
    }

}