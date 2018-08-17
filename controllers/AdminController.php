<?php
require_once ('/models/Admin.php');
class AdminController
{
    public function actionIndex(){
        $arrayTasks=Admin::getArrayTasks();
        require_once ('/../views/admin/index.php');
        if (!empty($_POST)) {
            $newTask= array();
            foreach ($_POST as $key => $value) {
                $value = htmlspecialchars($value);
                $value = stripcslashes($value);
                $newTask[$key] = $value;
            }
            if (!empty($_FILES)) {
                $uploadsDir = ROOT . '\uploads';
                $fileName = md5($_FILES["file"]["name"] . Uniqid());
                $targetFile = $uploadsDir . '\\' . $fileName . '.jpeg';
                var_dump($targetFile);
                if ($_FILES['file']['error'] == 0) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)
                        && is_writable($uploadsDir)) {
                        Admin::insertElement($newTask, $fileName);
                        echo 'Создана задача';
                    } else {
                        echo 'Не удалось осуществить создание задачи';
                    }
                }
            }
        return true;
    }}
    public function actionEdit($id){
        $element=array();
        $element= Admin::getElementByID($id);
        reset($element);
        //var_dump($element);
        if(!empty($_POST['email']) and !empty($_POST['text']) ){
            $post= $_POST;
            var_dump($_FILES);
        if(!empty($_FILES)) {
            $uploadsDir = ROOT . '\uploads';
            $fileName= md5($_FILES["file"]["name"] . Uniqid());
            $targetFile = $uploadsDir .'\\'. $fileName .'.jpeg';
            var_dump($targetFile);
            if ($_FILES['file']['error'] == 0) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)
                    && is_writable($uploadsDir)) {
                    Admin::updateElment($id, $post['email'], $post['text'], $fileName);
                    echo 'Данные сохранены';
                } else {
                    echo 'Не удалось осуществить сохранение файла';
                }
            }
        }
        }
        require_once ('/../views/admin/edit.php');
        return true;
    }
    public function actionDelete($id){

       if(Admin::deleteElement($id)) {
           header("Location: http://taskmvc/index.php?admin=1");
       }
       return true;

    }
}