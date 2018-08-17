<?php
require_once ('/models/Site.php');
require_once ('/models/UploadForm.php');
class SiteController
{
    const COUNTELEMENT = 3;
    //public $typesElement= ['jpeg','jpg','png'];


    public function actionIndex($page = 1)
    {
        $page = (int)$page;
        $numberPage = ($page - 1) * self::COUNTELEMENT;
        $page = $numberPage;
        $newCountTasks = Site::getCountTasks();
        reset($newCountTasks);
        $countPage = $newCountTasks[0] / self::COUNTELEMENT;
        $countPage = ceil($countPage);
        $arrayTasks = Site::getArrayTasks($page);
        require_once('/../views/Site/index.php');
        if (!empty($_POST) and !empty($_FILES)) {
            $typesElement= ['jpeg','jpg','png'];
            $typeImage= Site::explodeType($_FILES["file"]["type"]);
                if (in_array($typeImage, $typesElement)){
                    $newTask = array();
            foreach ($_POST as $key => $value) {
                $value = htmlspecialchars(strip_tags(trim($value)));
                $newTask[$key] = $value;
            }
                $uploadsDir = ROOT . '\uploads';
                $fileName = UploadForm::hash($_FILES["file"]["name"]);
                $targetFile =UploadForm::getNewFileTarget($fileName, $uploadsDir);
                var_dump($_FILES);
                if ($_FILES['file']['error'] == 0) {
                    if (UploadForm::uploadFile($_FILES['file']['tmp_name'], $targetFile)) {
                        Site::insertTask($newTask, $fileName);
                        Site::explodeType($_FILES["file"]["type"]);
                        echo 'Создана задача';
                    } else {
                        echo 'Не удалось осуществить создание задачи';
                    }
                }
            }   else{
                    echo 'Выберите пожалуйста картинку';
                }

        }
    }
}

