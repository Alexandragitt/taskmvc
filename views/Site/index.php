
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head> <meta charset="utf-8">
    <style>
        table, th, td{
            border: 0.1px solid black;
        }
    </style></head>
<body>
<form action="/index.php"  enctype='multipart/form-data' method="post">
       <p>
        <label>Введите email </label>
        <input type="text" name="email" >
    </p>
    <p>
        <label>Введите текст</label>
        <input type="text" name="text" >
    </p>


   <select name="id_author">
       <option selected disabled>Выберите автора</option>
       <?php foreach ($arrayAuthors as $key=> $author):?>
       <option  value="<?php echo $author['id'];?>"><?php echo $author['name'];?></option>
       <?php endforeach; ?>
   </select>
    <input name="file" type="file"  >
    <p>
        <input type="submit" name="" value="Добавить">
    </p>
</form>
<table>
    <tr>
        <th>ID </th>
        <th>Email</th>
        <th>Text</th>
        <th>Image</th>
        <th>Author</th>
    </tr>
<?php foreach ($arrayTasks as $key=> $array):?>
    <tr>
        <td> <p class="title"><?php echo $array['id'];?></p></td>
        <td> <p class="title"><?php echo $array['email'];?></p></td>
        <td> <p class="title"><?php echo $array['text'];?></p></td>
        <td> <img src="/uploads/<?php echo $array['img'];?>.jpeg" width="100" height="100" alt="картинка"></td>
        <td> <p class="title"><?php echo $array['name'];?></p></td>
    </tr>
<?php endforeach; ?>

</table>
<form action="" method="get">
    <?php for($i=1;$i <= $countPage; $i++) : ?>

        <a href="http://taskmvc/index.php/<?= $i ?> "><?= $i ?></a>
    <?php endfor; ?>
</form>
</body>
</html>

