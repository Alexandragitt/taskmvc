<?php
require_once ('/models/Admin.php');

require_once ('/models/UploadString.php');
require_once ('/models/UploadForm.php');
class AdminController
{
    protected $newTask = [];
    protected $typesElement= ['jpeg','jpg','png'];
    public function actionIndex(){
        $arrayTasks=Admin::getArrayTasks();
        require_once ('/../views/admin/index.php');
        if (!empty($_POST) and !empty($_FILES)) {
            $typeImage= Site::explodeType($_FILES["file"]["type"]);
            if (in_array($typeImage, $this->typesElement)){

                foreach ($_POST as $key => $value) {
                    $value = UploadString::cutString($value);
                    $this->newTask[$key] = $value;
                }
                $uploadsDir = ROOT . '\uploads';
                $fileName = UploadForm::hash($_FILES["file"]["name"]);
                $targetFile = UploadForm::getNewFileTarget($fileName, $uploadsDir);

                if ($_FILES['file']['error'] == 0) {
                    if (UploadForm::uploadFile($_FILES['file']['tmp_name'], $targetFile)) {
                        Admin::insertElement($this->newTask, $fileName);
                        echo 'Создана задача';
                    } else {
                        echo 'Не удалось осуществить создание задачи';
                    }
                }
            }   else{
                echo 'Выберите файл формата .jpeg, .png';
            }

        }

    }
    public function actionEdit($id){
        $elements = Admin::getElementByID($id);
        $elements = reset($elements);
        require_once ('/../views/admin/edit.php');

        if (!empty($_POST) and !empty($_FILES)) {
            $typeImage= Admin::explodeType($_FILES["file"]["type"]);
            if (in_array($typeImage, $this->typesElement)){

                foreach ($_POST as $key => $value) {
                    $value = UploadString::cutString($value);
                    $this->newTask[$key] = $value;
                }
                $uploadsDir = ROOT . '\uploads';
                $fileName = UploadForm::hash($_FILES["file"]["name"]);
                $targetFile = UploadForm::getNewFileTarget($fileName, $uploadsDir);

                if ($_FILES['file']['error'] == 0) {
                    if (UploadForm::uploadFile($_FILES['file']['tmp_name'], $targetFile)) {
                        Admin::updateElement( $this->newTask, $fileName);
                        echo 'Задача изменена';
                    } else {
                        echo 'Не удалось осуществить создание задачи';
                    }
                }
            }   else{
                echo 'Выберите файл формата .jpeg, .png';
            }

        }
    }
    public function actionDelete($id){

       if(Admin::deleteElement($id)) {
           header("Location: http://taskmvc/index.php?admin=1");
       }
       return true;

    }
}