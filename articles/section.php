<?php 

require_once 'header.php';
require_once 'database/News.php'; 

if (!isset($_GET['category'])) {
    header("location: /articles/index.php");
}

$news = new News();
$categories = $news->getPosts('categories');

?>

<h2>Main</h2>

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

        <div class="main_posts_wrapper">


        
        <?php

        $news = new News();

        // Получение массива с постами
        $postsTable = $news->getPosts('posts');
        $postsTable = (array)$postsTable;
        $postsTable = array_reverse($postsTable);

        $counter = 0;   // Счётчик постов


        foreach ($postsTable as $arPosts) {                                   // Перебор массива с постами
            if ($_GET['category'] == $arPosts['category_id']) {               // Вывод постов с выбранной категорией

                $counter += 1;                                                // Счётчик постов
                $coun = ceil($counter / 5);                                   // Номер страницы (на одной странице 5 постов)

                $author = $news->getAuthor($arPosts['author_id']); 
                
                if ((isset($_GET['page']) && $_GET['page'] == $coun) || (!isset($_GET['page']) && $coun == 1)) { ?>

                    <!-- Вывод превью статей -->
                    <table class="main_post_path">
                        <tr>
                            <td colspan="3">
                                <a href="detail.php?category=<?= $arPosts['category_id'] ?>&post=<?= $arPosts['id'] ?>">
                                    <?= $arPosts['title'] ?>                 <!-- Оглавление поста -->
                                </a>
                            </td>
                        </tr>

                        <tr><!-- Это надо --></tr>

                        <tr>
                            <td>Автор: <?= $author ?></td>                   <!-- Имя автора поста -->
                            <td>Просмотров: <?= $arPosts['active'] ?></td>   <!-- Активность поста -->
                            <td>Дата: <?= $arPosts['date'] ?></td>           <!-- Время публикации -->
                        </tr>
                    </table>
                                        
                <?php 
                } 
            }
        } ?>



        </div>

        <!-- Форма для пагинации -->
        <div class="pages_pagination">
            <?php 
            if (isset($coun) && $coun > 0) { ?>
                Страница: 
                <?php
                for ($i = 1; $i <= $coun; $i++) {
                    $link = $_SERVER['PHP_SELF']."?category=".$_GET['category']."&page=$i"; ?>
                    <a href="<?= $link ?>"><?= $i ?></a>
                <?php
                }
            }
            else echo 'Постов нет'; ?>
        </div>

    </div>

</div>

<?php require_once 'footer.php' ?>