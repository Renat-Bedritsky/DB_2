<?php 

require_once './header.php';

$users = new Users();

if (isset($_POST['enter'])) {
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    if ($users->autorization($login, $password) == 'autorizationON') {
        setcookie('login', md5($_POST['login']));
        header("location: /articles/index.php");
    }
    else echo 'Проверьте логин и пароль';
}

?>

<form method="POST">
    Логин
    <input type="text" name="login" value="">
    Пароль
    <input type="text" name="password" value="">
    <button name="enter">Войти</button>
</form>
    
<?php require_once './footer.php' ?>