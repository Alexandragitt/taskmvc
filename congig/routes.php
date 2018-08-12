<?php
return array(
    //админка
    'index.php/admin/edit/([0-9]+)' =>'admin/edit/$1',
    'index.php?admin=1'=>'news/index',
    //главная стр
    'site'=> 'site/index',
    'index.php/[1-9]'=> 'site/index/$1'



);