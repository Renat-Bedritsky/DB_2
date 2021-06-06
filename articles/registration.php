<?php 

require_once './header.php'; 
require_once './Users.php';

$users = new Users();
$usersLogin = $users->allUser();

if (isset($_POST['enter'])) {
    if ($_POST['password_1'] != $_POST['password_2']) {
        echo '<style>.registration_title {display: none;}</style>';
        echo '<div class="registration_error">Пароли не совпадают</div>';
    }
    else {
        $user = $users->checkLogin($_POST['login']);
        if ($user == 'User exist') {
            echo '<style>.registration_title {display: none;}</style>';
            echo '<div class="registration_error">Пользователь существует</div>';
        }
        else if ($user == 'User not exist') {
            $login = $_POST['login'];
            $password = md5($_POST['password_1']);
            $users->registrationUser($login, $password);
            setcookie('login', md5($login));
            header("location: /articles/index.php");
        }
    }
}

?>

<div class="registration_title">
    Регистрация
</div>

<div class="registration">
    <form method="POST">
        Логин<br>
        <input type="text" name="login" minlength="3" value="" required><br>
        Пароль<br>
        <input type="password" name="password_1" minlength="5" value="" required><br>
        Ещё раз<br>
        <input type="password" name="password_2" minlength="5" value="" required><br>
        <button name="enter">Регистрация</button>
    </form>
</div>
    
<?php require_once './footer.php' ?>