<?php require_once './News.php'; 

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    header("location: /articles/section.php?category=$category");
}

?>

<h2>Main</h2>

<div class="content">

    <!-- Меню с категориями -->
    <div class="main_category">
        <ul>
            <li><a href="?category=1">Sport</a></li>
            <li><a href="?category=2">Nature</a></li>
            <li><a href="?category=3">Politics</a></li>
            <li><a href="?category=4">Animals</a></li>
            <li><a href="?category=5">Technologies</a></li>
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

        $counter = 0;   // Счётчик постов (для пагинации)


        foreach ($postsTable as $arPosts) {
            $counter += 1;                                                           // Счётчик постов (для пагинации)

            $author = $news->getAuthor($arPosts['author_id']);

            $coun = ceil($counter / 5);                                              // Номер страницы (на одной странице 5 постов)

            if ((isset($_GET['page']) && $_GET['page'] == $coun) || (!isset($_GET['page']) && $coun == 1)) { ?>

                <!-- Вывод превью статей -->
                <table class="main_post_path">
                    <tr>
                        <td colspan="3">
                            <a href="./detail.php?category=<?= $arPosts['category_id'] ?>&post=<?= $arPosts['id'] ?>">
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
                        
            <?php } 
        }?>



        </div>

        <!-- Форма для пагинации -->
        <div class="pages_pagination">
            <?php 
            if (isset($coun) && $coun > 0) { ?>
                Страница: 
                <?php
                for ($i = 1; $i <= $coun; $i++) {
                    $link = $_SERVER['PHP_SELF']."?page=$i"; ?>
                    <a href="<?= $link ?>"><?= $i ?></a>
                <?php 
                }
            }
            else echo 'Постов нет'; ?>



        </div>

    </div>

</div>