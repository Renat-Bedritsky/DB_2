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
        $sqlActive = "SELECT `active` FROM `posts` WHERE `id` = $id";      // Запрос для получения активности поста
        $active = $this->general($sqlActive);                              // Отправка запроса
        $active = $active->fetch_assoc();                                  // Распаковка данных
        $active = $active['active'] + 1;                                   // Активность поста + 1
        $sql = "UPDATE `posts` SET `active` = $active WHERE `id` = $id";   // Запрос на изменение активности
        $this->general($sql);                                              // Отправка запроса
    }


    // Функция для записи поста
    function setPosts($data) {
        
        $id = $data['id'];
        $active = $data['active'];
        $title = $data['title'];
        $code = $data['code'];
        $content = $data['content'];
        $category_id = $data['category_id'];
        $author_id = $data['author_id'];
        $date = $data['date'];

        $sql = "INSERT INTO Posts VALUES ('$id', '$active', '$title', $code, '$content', '$category_id', '$author_id', '$date')";
        $this->general($sql);
    }


    // Функция для добавления нового автора
    function setAuthor($author) {

    }
}

?>