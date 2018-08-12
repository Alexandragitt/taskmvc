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
}