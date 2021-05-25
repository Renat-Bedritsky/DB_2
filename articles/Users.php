<?php

// echo $_SERVER['DOCUMENT_ROOT'];

class Users {
    // protected $file = $_SERVER['DOCUMENT_ROOT'].'/articles/users.json';
    protected $file = 'F:/server/xampp/htdocs/articles/users.json';
    public $data = [];

    function addUser() {
        if(file_exists($this->file)){
            $this->data = json_decode(file_get_contents($this->file), true);
        }
    }

    public function __construct() {
        if(file_exists($this->file)){
            $this->data = json_decode(file_get_contents($this->file), true);
            return $this->data;
        }
    }

    function autorization($login, $password) {
        $listUsers = $this->__construct();
        foreach($listUsers as $userOne) {
            if ($login == $userOne['login'] && $password == $userOne['password']) {
                return 'autorizationON';
            }
        }
    }

    function CheckCookieLogin() {
        $listUsers = $this->__construct();
        $author_id = 1;
        foreach($listUsers as $userOne) {
            if ($_COOKIE['login'] == md5($userOne['login'])) {
                $userData = ['login' => $userOne['login'], 'author_id' => $author_id];
                return $userData;
            }
            else $author_id += 1;
        }
    }
}