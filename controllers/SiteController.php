<?php
require_once ('/models/Site.php');
require_once ('/models/UploadForm.php');
require_once ('/models/UploadString.php');
require_once ('/models/Author.php');
class SiteController
{
    const COUNTELEMENT = 3;

    public function actionIndex($page = 1)
    {
        $newTask = [];
        $page = (int)$page;
        $numberPage = ($page - 1) * self::COUNTELEMENT;
        $page = $numberPage;
        $newCountTasks = Site::getCountTasks();
        // reset($newCountTasks);
        $countPage = $newCountTasks[0] / self::COUNTELEMENT;
        $countPage = ceil($countPage);
        $order = 'id';
        $sortName= 'asc';
        $arrayTasks = Site::getArrayTasks($page);
        $arrayAuthors = Author::getAuthors($order, $sortName);
        require_once('/../views/Site/index.php');

        if (!empty($_POST) and !empty($_FILES)) {
            var_dump($_FILES["file"]["type"]);
            $typeImage = Site::explodeType($_FILES["file"]["type"]);
            if (UploadForm::checkExtension($_FILES["file"]["type"])) {
                foreach ($_POST as $key => $value) {
                    //$value = UploadString::cutString($value);
                    $newTask[$key] = $value;
                }
                $fileName = UploadForm::hash($_FILES["file"]["name"]);
                if (UploadForm::uploadFile($_FILES, $fileName) && Site::insertTask($newTask, $fileName)) {
                   // var_dump($newTask);
                    echo 'Создана задача';
                } else {
                    echo 'Не удалось осуществить создание задачи';
                }
            } else {
                echo 'Нужно выбрать картинку с форматом .jpeg, .png';
            }
        }
    }
}