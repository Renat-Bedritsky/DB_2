<?php 
require_once './header.php';
require_once './connect.php';   // Подключение к базе данных
?>



<div class="title">

    <h1>Add</h1>

</div>

<?php

if (isset($_POST['title'])) {

    $news = new News();
    $idSql = $news->getPosts(0);   // Получение количества строк в таблице

    $id = $idSql[0]['COUNT(*)'] + 1;   // Количество строк в таблице + 1
    $title = $_POST['title'];
    $content = $_POST['contenet'];
    $category = $_POST['category'];
    $images = $_POST['images'];

    $data = $shop->setPosts($id, 0, $title, $code, $content, $category_id, $autor_id, $date);

    header("location: /index.php");

}

?>





<div class="add_product">
    <form method="POST" name="add_product">
        Оглавление:             <br><textarea name="title" value="" required></textarea><br>
        Контент:                <br><textarea name="content" value="" required></textarea><br>
        Категория товара:       <br>
                                    <select name="category">
                                        <option value="sports">Sports</option>
                                        <option value="nature">Nature</option>
                                        <option value="politics">Politics</option>
                                        <option value="animals">Animals</option>
                                    </select><br>
        Ссылка на фотографию:   <br><input type="text" name="images" value="" required><br>
        <button>Добавить</button>
    </form>
</div>




<?php require_once './footer.php';