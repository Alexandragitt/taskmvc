<?php
require_once ('/models/Admin.php');
class AdminController
{
    public function actionAdmin(){
        $arrayTasks=Admin::getArrayTasks();
        require_once ('/../views/admin/index.php');
        return true;
    }
    public function actionEdit($id){
$element=array();
        $element= Admin::getElementByID($id);
        //var_dump($element);
        require_once ('/../views/admin/edit.php');
        if(!empty($_POST)){
            $post= $_POST;
            Admin::updateElment($id, $post['email'], $post['text']);

        }


    }

}