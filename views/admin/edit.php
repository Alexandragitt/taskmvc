
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>    <meta charset="utf-8">  </head>
<body>
<p>Task id: <?php echo $elements['id']; ?></p>

    <form  action='/index.php/admin/edit/<?php echo $elements['id'];?>' enctype='multipart/form-data' method='post'>

          <p><input type="text" name="email"  value="<?php echo $elements['email']; ?>"></p>
        <p>   <input type="text" name="text" value="<?php echo $elements['text']; ?>"></p>
         <img src="/uploads/<?php echo $elements['img'];?>.jpeg" width="100" height="100" alt="картинка">

        <input name="file" type="file"  >
        <p>       <button type='submit' value ='<?php echo $elements['id'];?>'>Сохранить</button></p>
    </form>
        <form action='/index.php/admin/delete/<?php echo $elements['id'];?>' method='post'>
            <button type='submit' value ='<?php echo $elements['id'];?>'>Удалить</button>
        </form>

</form>
</body>
</html>