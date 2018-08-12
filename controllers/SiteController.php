<?php
require_once ('/models/Site.php');
class SiteController
{


    public function actionIndex($page=1){
        $numberPage= ($page-1)*3;
        $page = (int) $numberPage;
        $newCountTasks=Site::getCountTasks();
        $countPage=$newCountTasks[0]/3;
        $countPage= ceil ($countPage);
        $arrayTasks=array();
        $arrayTasks=Site::getArrayTasks($page);
        require_once ('/../views/Site/index.php');
        return true;


    }



}