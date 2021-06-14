<?php 
require_once 'header.php';
require_once 'database/News.php';              // Подключение к базе данных с новостями
require_once 'database/Users.php';
?>



<div class="title">

    <h2>Add post</h2>

</div>

<?php


if (isset($_POST['enter'])) {

    $users = new Users();
    $author = $users->CheckCookieLogin();        // Определение действующего пользователя

    $title = $_POST['title'];                    // Заголовок новости
    $content = $_POST['content'];                // Сама новость
    $category_id = $_POST['category_id'];        // ID категории
    $author_id = $author['author_id'];           // ID автора

    $data = array( 
                'title' => $title, 
                'content' => $content, 
                'category_id' => $category_id, 
                'author_id' => $author_id 
            );

    $news = new News();
    $news->setPosts($data);

    header("location: /articles/index.php");     // Перенаправление на главную страницу

}

?>





<div class="add_product">
    <form method="POST" name="add_product">
        Оглавление:             <br><textarea rows="10" cols="80" minlength="5" name="title" value="" required></textarea><br>
        Контент:                <br><textarea rows="10" cols="80" minlength="5" name="content" value="" required></textarea><br>
        Категория:              <select name="category_id">
                                    <option value="1">Sports</option>
                                    <option value="2">Nature</option>
                                    <option value="3">Politics</option>
                                    <option value="4">Animals</option>
                                    <option value="5">Tehnologies</option>
                                </select><br>
        <button name="enter">Добавить</button>
    </form>
</div>




<?php require_once 'footer.php';