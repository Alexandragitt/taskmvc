<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 17.08.2018
 * Time: 14:15
 */

class UploadString
{
    public static function hash($string){
        $result= md5($string . Uniqid());
        return $result;
    }
    public static function cutString($string){
        $result = htmlspecialchars(strip_tags(trim($string)));
        return $result;
    }

}