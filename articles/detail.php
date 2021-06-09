<?php 

require_once './header.php';
require_once './News.php'; 

// if (!isset($_GET['category']) || !isset($_GET['post'])) {
//     header("location: /articles/index.php");
// }

?>

<style>
    .main_posts {
        width: 100%;
        margin-left: 0;
        padding: 0 50px;
    }
</style>

<h2>Detail</h2>

<div class="content">

    <div class="main_posts">





    <?php

    $news = new News();

    // Получение массива с категориями
    $categoryTable = $news->getPosts('categories');
    $categoryTable = (array)$categoryTable;

    // Получение массива с авторами
    $authorsTable = $news->getPosts('authors');
    $authorsTable = (array)$authorsTable;

    $post = $news->getPost('posts', $_GET['post']);

    $author = $news->getAuthor($post['author_id']); ?>

        <!-- Вывод превью статей -->
        <table class="main_post_path">
            <tr>
                <td colspan="3">
                    <?= $post['title'] ?>                     <!-- Оглавление поста -->
                </td>
            </tr>

            <tr>                                  <!-- Содержимое поста -->
                <td colspan="3">Автор: <?= $post['content'] ?></td>
            </tr>

            <tr>
                <td>Автор: <?= $author ?></td>                <!-- Имя автора поста -->
                <td>Просмотров: <?= $post['active'] ?></td>   <!-- Активность поста -->
                <td>Дата: <?= $post['date'] ?></td>           <!-- Время публикации -->
            </tr>      <!-- Время публикации -->
        </table>

    </div>

</div>

<?php require_once './footer.php' ?>