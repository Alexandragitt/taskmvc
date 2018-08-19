<?php
require_once ('/models/Admin.php');

require_once ('/models/UploadString.php');
require_once ('/models/UploadForm.php');
class AdminController
{
    public function actionIndex(){
        $newTask = [];
        if(!empty($_GET['order']) &&  !empty($_GET['sort_by'])){
            $order = $_GET['order'];
            $sortName= $_GET['sort_by'];
        }else{
            $order = 'id';
            $sortName= 'asc';
        }
        $arrayTasks=Admin::getArrayTasks();
        $arrayAuthors =Admin::getAuthors($order, $sortName);
        require_once ('/../views/admin/index.php');

        if (!empty($_POST) and !empty($_FILES)) {
            if(UploadForm::checkExtension($_FILES["file"]["type"])){
                foreach ($_POST as $key => $value) {
                    $value = UploadString::cutString($value);
                    $newTask[$key] = $value;
                }
                    $fileName = UploadForm::hash($_FILES["file"]["name"]);
                    if (UploadForm::uploadFile($_FILES, $fileName) && Admin::insertElement($newTask, $fileName)) {
                        echo 'Создана задача';
                    } else {
                           echo 'Не удалось осуществить создание задачи';
                       }

                    } else{
                echo 'Нужно выбрать картинку с форматом .jpeg, .png';
                }
            }
        }


    public function actionEdit($id){
        $newTask = [];
        $order = 'id';
        $sortName= 'asc';
        $elements = Admin::getElementByID($id);
        $arrayAuthors = Admin::getAuthors($order, $sortName);
        $elements = reset($elements);
        require_once ('/../views/admin/edit.php');
        if (!empty($_POST) and !empty($_FILES)) {
            if(UploadForm::checkExtension($_FILES["file"]["type"])){
            foreach ($_POST as $key => $value) {
                $value = UploadString::cutString($value);
                $newTask[$key] = $value;
            }
            $fileName = UploadForm::hash($_FILES["file"]["name"]);
            if (UploadForm::uploadFile($_FILES, $fileName) && Admin::updateElement( $newTask, $fileName)) {
                echo 'Изменена задача';
            } else {
                echo 'Не удалось осуществить изменение задачи';
            }
        }
         else{
            echo 'Нужно выбрать картинку с форматом .jpeg, .png';
        }}
    }
    public function actionDelete($id){

       if(Admin::deleteElement($id)) {
           header("Location: http://taskmvc/index.php?admin=1");
       }
    }
    public function actionAuthor(){
        if(!empty($_POST)){
            $nameAuthor = UploadString::cutString($_POST['author']);
        if(Admin::createAuthor($nameAuthor)) {
            header("Location: http://taskmvc/index.php?admin=1");
        }
    }}
}