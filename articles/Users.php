<?php

// echo $_SERVER['DOCUMENT_ROOT'];

class Users {
    // protected $file = $_SERVER['DOCUMENT_ROOT'].'/articles/users.json';
    protected $file = 'F:/server/xampp/htdocs/articles/users.json';
    public $data = [];


    // Функция для получения всех логинов
    function allUser() {
        if(file_exists($this->file)){
            $this->data = json_decode(file_get_contents($this->file), true);
            $allLogin = [];

            foreach ($this->data as $user) {
                array_push($allLogin, $user['login']);
            }
            return $allLogin;
        }
    }


    // Функция для получения всех логинов и паролей (для авторизации)
    public function __construct() {
        if(file_exists($this->file)){
            $this->data = json_decode(file_get_contents($this->file), true);
            return $this->data;
        }
    }


    // Функция для проверки логина и пароля (для авторизации)
    function autorization($login, $password) {
        $listUsers = $this->__construct();

        foreach($listUsers as $userOne) {
            if ($login == $userOne['login'] && $password == $userOne['password']) {
                return 'autorizationON';
            }
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
        $listUsers = $this->__construct();
        $author_id = 1;               // ID автора

        foreach($listUsers as $userOne) {
            if ($_COOKIE['login'] == md5($userOne['login'])) {
                $userData = ['login' => $userOne['login'], 'author_id' => $author_id];
                return $userData;
            }
            else $author_id += 1;
        }
    }

    function registrationUser($login, $password) {
        $json = '"login":"'.$login.'",'.'"password":"'.$password.'"';
        $file = fopen('users.json','a+');
        fwrite($file, $json);
        fclose($file);
    }
}