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
        $result = $db->prepare('select m.id,m.email, m.text, m.img,  group_concat(a.name) as name
from task_author t_a
       join authors a on t_a.id_author = a.id
join mvc m on t_a.id_mvc = m.id group by m.id order by m.id
LIMIT 3 OFFSET :page');
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
        return $result;
    }
    public static function explodeType($string){
        $segments = explode('/', $string);
        return end($segments);
    }



}