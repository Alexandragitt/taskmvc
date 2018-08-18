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
        $result = $db->query('select m.id, m.email, m.text,m.img, a.name from mvc m join authors a
                                                on m.id_author=a.id ');

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
        $result = $db->prepare("UPDATE mvc SET `email`=:email,`text`=:text,`img`=:img,`id_author`=:name  where id=:id");
        $result->bindParam(':email', $data['email'] );
        $result->bindParam(':text', $data['text'] );
        $result->bindParam(':id', $data['id']  );
        $result->bindParam(':img', $nameImage);
        $result->bindParam(':name', $data['id_author'] );
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
        $new= $db->prepare("INSERT INTO mvc (email, text, img, id_author) 
                            VALUES(:email, :text, :img, :id_author)");
        $new->bindParam(':email', $data['email']);
        $new->bindParam(':text', $data['text']);
        $new->bindParam(':img', $fileName);
        $new->bindParam(':id_author', $data['id_author']);
        return $new->execute();
    }
    public static function explodeType($string){
        $segments = explode('/', $string);
        return end($segments);
    }
    public static function getAuthors(){
        $db=Db::getConnection();
        $result = $db->query('SELECT * from authors ');
        $arrayAuthors = $result->fetchAll(PDO::FETCH_ASSOC);
        return $arrayAuthors;

    }
    public static function createAuthor($string){
        $db=Db::getConnection();
        $new= $db->prepare("INSERT INTO authors (name) 
                            VALUES(:name)");
        $new->bindParam(':name', $string);
        return $new->execute();
    }



}