
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>    <meta charset="utf-8">  </head>
<body>
<p>Task id: <?php echo $element[0]['id']; ?></p>

    <form action="" method="post">

          <p><input type="text" name="email"  value="<?php echo $element[0]['email']; ?>"></p>
        <p>   <input type="text" name="text" value="<?php echo $element[0]['text']; ?>"></p>
        <p>     <a href = 'index.php/admin/edit/<?php echo $element[0]['id'];?>'>Сохранить</a></p>
    </form>
        <form action='/index.php/admin/delete/<?php echo $element[0]['id'];?>' method='post'>
            <button type='submit' value =<?php echo $element[0]['id'];?>>Удалить</button>
        </form>

</table>

</form>
</body>
</html>