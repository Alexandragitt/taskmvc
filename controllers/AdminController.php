<?php
require_once ('/models/Admin.php');
class AdminController
{
    public function adminAction(){
        $arrayTasks=Admin::getArrayTasks();
        require_once ('/../views/admin/index.php');
        return true;
    }

}