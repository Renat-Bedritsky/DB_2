<?php

class News {
    public $servername = 'localhost';
    public $username = 'root';
    public $password = '';
    public $dbname = 'news';

    
    // Общая функция для подключения к базе данных
    function general($sql) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);   // Установка соединения
        $string = $conn->query($sql);                                                             // Отправка запроса
        return $string;
    
        $conn->close();
    }


    // Функция для получения данных таблицы
    function getPosts($table) {
        $sql = "SELECT * FROM $table";                // Запрос для получения всей таблицы
        
        $string = $this->general($sql);               // Отправка запроса
        $result = [];                                 // Пустой массив для данных

        if($string) {
            while ($row = $string->fetch_assoc()) {   // fetch_assoc() извлекает запись
                array_push($result, $row);            // Добавление записи в массив
            }
            return $result;
        }
    }


    // Функция для получения записи из таблицы
    function getPost($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = $id"; // Запрос для получения одной записи из таблицы
        
        $string = $this->general($sql);               // Отправка запроса
        $result = [];                                 // Пустой массив для данных

        if($string) {
            $result = $string->fetch_assoc();         // fetch_assoc() извлекает запись
            return $result;
        }
    }


    // Функция для нахождения автора поста
    function getAuthor($id) {
        $sql = "SELECT name FROM authors WHERE id = $id";
        $string = $this->general($sql);
        $result = $string->fetch_assoc();
        $result = $result['name'];

        return $result;
    }


    // Функция для нахождения автора поста
    function getCategory($id) {

        $sql = "SELECT name FROM categories WHERE id = $id";
        $string = $this->general($sql);
        $result = $string->fetch_assoc();
        $result = $result['name'];

        return $result;
    }


    // Функция для получения количества строк
    function getLine($table) {
        $sql = "SELECT COUNT(*) FROM $table";
        $string = $this->general($sql);

        if($string) {
            $row = $string->fetch_assoc();
            return $row['COUNT(*)'];
        }
    }


    // Функция для изменения активности
    function active($id) {
        $sql = "UPDATE `posts` SET `active` = `active` + 1 WHERE `id` = $id";   // Запрос на изменение активности
        $this->general($sql);                                                   // Отправка запроса
    }


    // Функция для записи поста
    function setPosts($data) {
        date_default_timezone_set('Europe/Minsk');   // Назначение временой зоны (Минск)

        $id = $this->getLine('posts') + 1;           // Количество строк в таблице + 1
        $active = 0;                                 // Активность в новости
        $title = $data['title'];                     // Заголовок новости
        $code = $id;                                 // Символьный код для URL
        $content = $data['content'];                 // Сама новость
        $category_id = $data['category_id'];         // ID категории
        $author_id = $data['author_id'];             // ID автора
        $date = date("Y-m-d H:i:s");                 // Дата создания поста

        $sql = "INSERT INTO posts VALUES ('$id', '$active', '$title', $code, '$content', '$category_id', '$author_id', '$date')";
        $this->general($sql);
    }


    // Функция для добавления нового автора
    function setAuthor($name) {

        $id = $this->getLine('authors') + 1;

        $sql = "INSERT INTO authors VALUES ('$id', '$name')";
        $this->general($sql);
    }
}

?>