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

    function CheckCookieLogin($login) {
        $listUsers = $this->__construct();
        foreach($listUsers as $userOne) {
            if ($login == md5($userOne['login'])) {
                return $userOne['login'];
            }
        }
    }
}