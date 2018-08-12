<?php
class Db
{
    public static function getConnection(){
        $db = new PDO('mysql:host=localhost;dbname=city', 'root','' );
        return $db;
    }
}
