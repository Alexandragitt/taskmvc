<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<form action="" method="post">
    <p>
        <label>Введите название товара</label>
        <input type="text" name="name" >
    </p>
    <p>
        <label>Введите email </label>
        <input type="text" name="email" >
    </p>
    <p>
        <label>Введите текст</label>
        <input type="text" name="text" >
    </p>
    <p>
        <input type="submit" name="" value="Добавить">
    </p></form>
<table>
    <tr>
        <th>ID </th>
        <th>Email</th>
        <th>Text</th>
    </tr>
<?php foreach ($arrayTasks as $key=> $array):?>
    <tr>
        <td> <p class="title"><?php echo $array['id'];?></p></td>
        <td> <p class="title"><?php echo $array['email'];?></p></td>
        <td> <p class="title"><?php echo $array['text'];?></p></td>

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

