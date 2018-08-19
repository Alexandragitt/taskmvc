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
        $id_authors = [];
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
            $typeImage = Site::explodeType($_FILES["file"]["type"]);
            if (UploadForm::checkExtension($_FILES["file"]["type"])) {
                foreach ($_POST as $key => $value) {
                    if($key == 'id_author'){
                        $id_authors[] = $value ;
                    }else {
                        $value = UploadString::cutString($value);
                        $newTask[$key] = $value;
                    }
                }
                $fileName = UploadForm::hash($_FILES["file"]["name"]);
                if (UploadForm::uploadFile($_FILES, $fileName) && Site::insertTask($newTask, $fileName)){
                Author::insertRelationTaskAuthor($id_authors);
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