<?php
//Front Controller
//1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));
require_once('components/Router.php');
//3.Установка сосединения с БД
require_once('components/Db.php');

if((!empty($_GET['admin'])) and ($_GET['admin']==1)){
    require_once('controllers/AdminController.php');
    $admin= new AdminController();
    $admin->actionAdmin();
} else{
    $router=new Router();
    $router->run();
}



