<?php
require_once ('/models/Site.php');
class SiteController
{


    public function actionIndex($page = 1)
    {
        $numberPage = ($page - 1) * 3;
        $page = (int)$numberPage;
        $newCountTasks = Site::getCountTasks();
        $countPage = $newCountTasks[0] / 3;
        $countPage = ceil($countPage);
        $arrayTasks = array();
        $arrayTasks = Site::getArrayTasks($page);
        require_once('/../views/Site/index.php');
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

