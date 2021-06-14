<?php

require_once 'News.php'; 

class Users {
    protected $servername = 'localhost';
    protected $username = 'root';
    protected $password = '';
    protected $dbname = 'users';

    
    // Общая функция для подключения к базе данных
    protected function general($sql) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   // Установка соединения
        $string = $conn->query($sql);                                                             // Отправка запроса
        return $string;
    
        $conn->close();
    }

    // Функция для получения всех логинов
    function allUser() {
        $sql = "SELECT `login` FROM `users`";
        $allLogin = $this->general($sql);
        $result = [];                                                           // Пустой массив для логинов

        if($allLogin) {
            while ($row = $allLogin->fetch_assoc()) {                           // fetch_assoc() извлекает запись
                array_push($result, $row['login']);                             // Добавление записи в массив
            }
            return $result;
        }
    }


    // Функция для получения всех логинов и паролей (для авторизации)
    protected function allLoginAndPass() {
        $sql = "SELECT id, login, password FROM users";
        $allLoginAndPass = $this->general($sql);
        $result = [];                                                           // Пустой массив для логинов

        if($allLoginAndPass) {
            while ($row = $allLoginAndPass->fetch_assoc()) {                    // fetch_assoc() извлекает запись
                array_push($result, $row);                                      // Добавление записи в массив
            }
            return $result;
        }
    }


    // Функция для проверки логина и пароля (для авторизации)
    function autorization($login, $password) {
        $listUsers = $this->allLoginAndPass();

        foreach($listUsers as $userOne) {
            if ($login == $userOne['login'] && $password == $userOne['password']) {
                return 'autorizationYES';
            }
            else return 'autorizationNO';
        }
    }


    // Функция для проверки существования логина (для регистрации)
    function checkLogin($login) {
        $allUsers = $this->allUser();

        foreach ($allUsers as $user) {
            if ($user == $login) {
                return 'User exist';
            }
        }
        return 'User not exist';
    }


    // Функция для сверки COOKIE с существующими пользователями
    function CheckCookieLogin() {
        $listUsers = $this->allLoginAndPass();

        foreach($listUsers as $user) {
            if ($_COOKIE['login'] == md5($user['login'])) {
                $userData = ['author_id' => $user['id'], 'login' => $user['login']];
                return $userData;
            }
        }
    }

    
    // Функция для добавления пользователя
    function registrationUser($login, $password) {

        $sql = "SELECT COUNT(*) FROM users";
        $enter = $this->general($sql);

        if($enter) {
            while ($row = $enter->fetch_assoc()) {
                $countUser = $row['COUNT(*)'];
            }
        }

        date_default_timezone_set('Europe/Minsk');   // Назначение временой зоны (Минск)

        $id = $countUser + 1;
        $date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO users VALUES ('$id', '$login', '$password', '$date')";
        $this->general($sql);
    }
}