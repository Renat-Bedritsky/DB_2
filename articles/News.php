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
    function getPosts($table, $category_id = 0) {
        if ($category_id != 0) {
            $sql = "SELECT * FROM $table WHERE category_id = '$category_id'";       // Текст запроса с выбраноной категорией
        }
        else if ($table == 'authors') {
            $sql = 'SELECT * FROM authors';                                  // Текст запроса (К таблице с авторами)
        }
        else if ($table == 'categories') {
            $sql = 'SELECT * FROM categories';                               // Текст запроса (К таблице с авторами)
        }
        else if ($table == 'posts') {
            $sql = 'SELECT * FROM posts';                                    // Текст запроса (К таблице с постами)
        }
        else if ($table == 0) {
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
}

?>