<?php
require_once ('/models/Site.php');
require_once ('/models/UploadForm.php');
class SiteController
{
    const COUNTELEMENT = 3;


    public function actionIndex($page = 1)
    {
        $numberPage = (int) ($page - 1) * self::COUNTELEMENT;
        $page = $numberPage;
        $newCountTasks = Site::getCountTasks();
        $countPage = $newCountTasks[0] / self::COUNTELEMENT;
        $countPage = ceil($countPage);
        $arrayTasks = Site::getArrayTasks($page);
        require_once('/../views/Site/index.php');
        if (!empty($_POST)) {
            $newTask = array();
            foreach ($_POST as $key => $value) {
                $value = htmlspecialchars(strip_tags(trim($value)));
                $newTask[$key] = $value;
            }
            if (!empty($_FILES)) {
                $uploadsDir = ROOT . '\uploads';
                $fileName = UploadForm::hash($_FILES["file"]["name"]);
                $targetFile =UploadForm::getNewFileTarget($fileName, $uploadsDir);
                if ($_FILES['file']['error'] == 0) {
                    if (UploadForm::uploadFile($_FILES['file']['tmp_name'], $targetFile)) {
                        Site::insertTask($newTask, $fileName);
                        echo 'Создана задача';
                    } else {
                        echo 'Не удалось осуществить создание задачи';
                    }
                }
            }
        }

        return true;
    }
}

