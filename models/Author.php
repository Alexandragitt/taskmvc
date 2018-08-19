<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 19.08.2018
 * Time: 16:32
 */

class Author
{
    public static function createAuthor($string){
        $db=Db::getConnection();
        $new= $db->prepare("INSERT INTO authors (name) 
                            VALUES(:name)");
        $new->bindParam(':name', $string);
        return $new->execute();
    }
    public static function getAuthors($order, $sort){
        $db=Db::getConnection();
        $sortQuery = " ORDER BY ".$order .' '.$sort;
        $result = $db->query("SELECT * from authors ".$sortQuery);
        $arrayAuthors = $result->fetchAll(PDO::FETCH_ASSOC);
        return $arrayAuthors;

    }
    public static function insertRelationTaskAuthor($id_authors){
        $db=Db::getConnection();
        $taskMaxId = $db->query("SELECT max(id) from mvc ");
        $taskID =  $taskMaxId->fetch();
        $taskID = (int) reset($taskID);
        $id_authors = reset($id_authors);
        foreach ($id_authors as $key => $val) {
            $val = (int) $val;
            $new = $db->prepare("INSERT INTO task_author (id_author, id_mvc) 
                            VALUES(:id_author, :id_mvc)");
            $new->bindParam(':id_author', $val);
            $new->bindParam(':id_mvc', $taskID);
            $result = $new->execute();
            if($key == 2 ){
                break;
            }
        }

}
}