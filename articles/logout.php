<?php

setcookie('login', $_POST['login'], time()-10);         // Удаление COOKIE логин
header("location: /articles/index.php");                   // Выполняется перевод на текущую директорию

?>