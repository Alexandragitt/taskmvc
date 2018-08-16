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
    public static function updateElment($id,$email,$text, $nameImage){
        $db=Db::getConnection();
        $result = $db->prepare("UPDATE mvc SET `email`=:email,`text`=:text,`img`=:name where id=:id");
        $result->bindParam(':email', $email );
        $result->bindParam(':text', $text );
        $result->bindParam(':id', $id );
        $result->bindParam(':name', $nameImage);
        $update=$result->execute();
        return true;
    }
    public static function deleteElement($id){
        $db=Db::getConnection();
        $result = $db->prepare("DELETE FROM `mvc` WHERE `id` = :id");
        $result->bindParam(':id', $id );
        $result->execute();
        return true;
    }
    public static function insertElement($data, $fileName){
        $db=Db::getConnection();
        $new= $db->prepare("INSERT INTO mvc (email, text, img) 
                            VALUES(:email, :text, :img)");
        $new->bindParam(':email', $data['email']);
        $new->bindParam(':text', $data['text']);
        $new->bindParam(':img', $filename);
        $result=$new->execute();
        return $result;



    }

}