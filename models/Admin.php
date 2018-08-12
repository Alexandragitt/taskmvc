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
        $result = $db->prepare('SELECT * FROM mvc L');
         $arrayTasks=$result->execute();
        $arrayTasks = $result->fetchAll();
        return $arrayTasks;
    }
}