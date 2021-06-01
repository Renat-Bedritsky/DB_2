<?php 
require_once './header.php';
require_once './News.php';                       // Подключение к базе данных с новостями
?>



<div class="title">

    <h2>Add post</h2>

</div>

<?php


if (isset($_POST['title'])) {

    $news = new News();
    $idSql = $news->getPosts(0);                 // Получение количества строк в таблице

    $users = new Users();
    $author = $users->CheckCookieLogin();        // Определение действующего пользователя

    date_default_timezone_set('Europe/Minsk');   // Назначение временой зоны (Минск)

    $id = $idSql[0]['COUNT(*)'] + 1;             // Количество строк в таблице + 1
    $active = 0;                                 // Активность в новости
    $title = $_POST['title'];                    // Заголовок новости
    $code = $id;                                 // Символьный код для URL
    $content = $_POST['content'];                // Сама новость
    $category_id = $_POST['category_id'];        // ID категории
    $author_id = $author['author_id'];           // ID автора
    $date = date("Y-m-d H:i:s");                 // Дата создания поста

    $data = array(
                'id' => $id, 
                'active' => $active, 
                'title' => $title, 
                'code' => $code, 
                'content' => $content, 
                'category_id' => $category_id, 
                'author_id' => $author_id, 
                'date' => $date

            );

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

    $news->setPosts($data);

    header("location: /articles/index.php");     // Перенаправление на главную страницу

}

?>





<div class="add_product">
    <form method="POST" name="add_product">
        Оглавление:             <br><textarea rows="10" cols="80" name="title" value="" required></textarea><br>
        Контент:                <br><textarea rows="10" cols="80" name="content" value="" required></textarea><br>
        Категория:              <select name="category_id">
                                    <option value="1">Sports</option>
                                    <option value="2">Nature</option>
                                    <option value="3">Politics</option>
                                    <option value="4">Animals</option>
                                    <option value="5">Tehnologies</option>
                                </select><br>
        <button>Добавить</button>
    </form>
</div>




<?php require_once './footer.php';