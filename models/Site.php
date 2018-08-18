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
        $result = $db->prepare('select m.id, m.email, m.text,m.img, a.name from mvc m join authors a
                                                on m.id_author=a.id LIMIT 3 OFFSET :page');
        $result->bindParam(':page', $page, PDO::PARAM_INT );
        $arrayTasks=$result->execute();
        $arrayTasks = $result->fetchAll();
        return $arrayTasks;
    }
    public static function insertTask($data, $filename){
        $db=Db::getConnection();
        $new= $db->prepare("INSERT INTO mvc (email, text, img, id_author) 
                            VALUES(:email, :text, :img, :id_author)");
        $new->bindParam(':email', $data['email']);
        $new->bindParam(':text', $data['text']);
        $new->bindParam(':img', $filename);
        $new->bindParam(':id_author', $data['id_author']);
        $result=$new->execute();
        return $result;
    }
    public static function explodeType($string){
        $segments = explode('/', $string);
        return end($segments);
    }
    public static function getAuthors(){
        $db=Db::getConnection();
        $result = $db->query('SELECT * from authors ');
        $arrayAuthors = $result->fetchAll(PDO::FETCH_ASSOC);;
        return $arrayAuthors;

    }


}