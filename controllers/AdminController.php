<?php
require_once ('/models/Admin.php');
class AdminController
{
    public function actionIndex(){
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
            var_dump($_POST);
            Admin::updateElment($id, $post['email'], $post['text']);
        }
    }
    public function actionDelete($id){
       if(Admin::deleteElement($id)) {
           header("Location: http://taskmvc/index.php?admin=1");
       }

    }
}