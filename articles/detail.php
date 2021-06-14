<?php 

require_once 'header.php';
require_once 'database/News.php'; 

if (!isset($_GET['category']) || !isset($_GET['post'])) {
    header("location: /articles/index.php");
}

$news = new News();
$categories = $news->getPosts('categories');

// Обновление просмотров страницы
$news->active($_GET['post']);

?>

<style>
    table tr:nth-child(2) td {
        padding: 20px 10px 20px 0;
        font-size: 28px;
    }
</style>

<h2>Detail</h2>

<div class="content">

    <!-- Меню с категориями -->
    <div class="main_category">
		<button class="main_category_toggle"><label for="main_category_toggle"></label></button>
        <input type="checkbox" id="main_category_toggle">
        
        <ul> 
            <li>Categories:</li>
            <li><a href="index.php">All</a></li>
        
        <?php foreach ($categories as $path) { ?>

            <li><a href="section.php?category=<?= $path['id'] ?>"><?= $path['name'] ?></a></li>

        <?php } ?>

        </ul>
    </div>

    <div class="main_posts">





    <?php

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

<?php require_once 'footer.php' ?>