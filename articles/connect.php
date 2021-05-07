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


    // Функция для получения данных
    function getPosts($category) {
        if ($category != 1 && $category != 0) {
            $sql = "SELECT * FROM posts WHERE category = '$category'";       // Текст запроса с выбраноной категорией товаров
        }
        else if ($category == 1) {
            $sql = 'SELECT * FROM posts';                                    // Текст запроса без категории товаров (все товары)
        }
        else if ($category == 0) {
            $sql = 'SELECT COUNT(*) FROM posts';                             // Текст запроса для получения количества строк
        }
        
        $string = $this->general($sql);
        $result = [];                                                                             // Пустой массив для товаров

        if($string) {
            while ($row = $string->fetch_assoc()) {                                               // fetch_assoc() извлекает запись
                array_push($result, $row);                                                        // Добавление записи в массив
            }
            return $result;
        }
    }


    // Функция для записи данных
    function setPosts($sql) {
        $this->general($sql);
    }
}

?>