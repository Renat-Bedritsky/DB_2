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
    else {
        echo '<style>.autorization_title {display: none;}</style>';
        echo '<div class="autorization_error">Проверьте логин и пароль</div>';
    }
}

if (isset($_POST['registration'])) {
    header("location: /articles/registration.php");
}

?>

<div class="autorization_title">
    Авторизация
</div>

<div class="autorization">

    <form method="POST">
        Логин<br>
        <input type="text" name="login" value=""><br>
        Пароль<br>
        <input type="password" name="password" value=""><br>
        <button name="enter">Войти</button>
        <button name="registration">Регистрация</button>
    </form>

</div>
    
<?php require_once './footer.php' ?>