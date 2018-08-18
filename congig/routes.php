<?php
return array(
    //админка
    'index.php/admin/edit/([0-9]+)' =>'admin/edit/$1',
    'index.php?admin=1'=>'admin/index',
    'index.php/admin/delete/([0-9]+)' =>'admin/delete/$1',
    'index.php/admin/author' =>'admin/author' ,
    //главная стр
    'site'=> 'site/index',
    'index.php/site/([0-9]+)'=> 'site/index/$1',
    'index.php/([0-9]+)'=> 'site/index/$1',
    'index.php'=> 'site/index'

// ТАК ДОЛЖНО РАБОТАТЬ? и хули с роутингом проебала?

);