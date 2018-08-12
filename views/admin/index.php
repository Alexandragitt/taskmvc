<?php
header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>      <style>
        table, th, td{
            border: 0.1px solid black;
        }
    </style></head>
<body>
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

</form>
</body>
</html>