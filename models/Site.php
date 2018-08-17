<?php

class Site
{

    public static function getCountTasks(){
        $db=Db::getConnection();
        $result = $db->query('SELECT  count(*) from mvc ');
        $arraycount = $result->fetch();
        return $arraycount;

    }
    public static function getArrayTasks($page){
        $db=Db::getConnection();
        $result = $db->prepare('SELECT * FROM mvc LIMIT 3 OFFSET :page');
        $result->bindParam(':page', $page, PDO::PARAM_INT );
        $arrayTasks=$result->execute();
        $arrayTasks = $result->fetchAll();
        return $arrayTasks;
    }
    public static function insertTask($data, $filename){
        $db=Db::getConnection();
        $new= $db->prepare("INSERT INTO mvc (email, text, img) 
                            VALUES(:email, :text, :img)");
        $new->bindParam(':email', $data['email']);
        $new->bindParam(':text', $data['text']);
        $new->bindParam(':img', $filename);
        $result=$new->execute();
        //$result=$new->fetchAll();
        return $result;
    }
    public static function explodeType($string){
        $segments = explode('/', $string);
        return $segments[1];
    }

}