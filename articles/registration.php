<?php 

require_once './header.php'; 

$users = new Users();

if (isset($_POST['enter'])) {
    if ($_POST['password_1'] != $_POST['password_2']) {
        echo '<style>.registration_title {display: none;}</style>';
        echo '<div class="registration_error">Пароли не совпадают</div>';
    }
    else {
        $allUsers = $users->allUser();
    }
}
$allUsers = $users->allUser();
echo '<pre>';
print_r($allUsers);
echo '</pre>';
$allUsers = $users->__construct();
echo '<pre>';
print_r($allUsers);
echo '</pre>';

?>

<div class="registration_title">
    Регистрация
</div>

<div class="registration">
    <form method="POST">
        Логин<br>
        <input type="text" name="login" value=""><br>
        Пароль<br>
        <input type="text" name="password_1" value=""><br>
        Ещё раз<br>
        <input type="text" name="password_2" value=""><br>
        <button name="enter">Регистрация</button>
    </form>
</div>
    
<?php require_once './footer.php' ?>