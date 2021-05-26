<?php 
require_once './header.php';
require_once './News.php'; 
?>

<h2>Main</h2>

<div class="content">
    <!-- Меню с категориями -->
    <div class="main_category">
        <ul>
            <li><a href="?category=sport">Sport</a></li>
            <li><a href="?category=nature">Nature</a></li>
            <li><a href="?category=politics">Politics</a></li>
            <li><a href="?category=animals">Animals</a></li>
        </ul>
    </div>

    <div class="main_posts">
        
        <?php

        $news = new News();

        // Получение массива с категориями
        $categoryTable = $news->getPosts('categories');
        $categoryTable = (array)$categoryTable;

        // Получение массива с постами
        $postsTable = $news->getPosts('posts');
        $postsTable = (array)$postsTable;
        $postsTable = array_reverse($postsTable);

        // Получение массива с авторами
        $authorsTable = $news->getPosts('authors');
        $authorsTable = (array)$authorsTable;

        $counter = 0;   // Счётчик постов


        ?>
        <div class="main_posts_wrapper">
        <?php


        if (isset($_GET['category'])) {                                                // Если пользователь выбрал категорию
            foreach ($categoryTable as $category) {                                    // Перебор массива с категориями
                if ($_GET['category'] == $category['name']) {
                    foreach ($postsTable as $arPosts) {                                // Перебор массива с постами

                        $category_id = $news->getPosts('posts', $category['id']);
                        $category_id = (array)$category_id;

                        foreach ($category_id as $path) {
                            if ($path['title'] == $arPosts['title']) {
                                $counter += 1;                                         // Счётчик постов

                                foreach ($authorsTable as $author) {                   // Перебор массива с авторами

                                    $coun = ceil($counter / 5);                        // Номер страници (на одной странице 5 постов)

                                    if($arPosts['author_id'] == $author['id']) {
            
                                    if (isset($_GET['post']) && $_GET['post'] == $arPosts['title']) {
                                        viewPost($arPosts, $author['name']);           // Вызов функции для просмотра поста
                                    } ?>

                                    <!-- Вывод постов -->
                                    <div class="main_post_path" <?php if ((isset($_GET['page']) && $_GET['page'] != $coun) || (!isset($_GET['page']) && $coun != 1)) { ?> style="display: none;" <?php } ?>>
                                        <p class="post"><a href="?post=<?= $arPosts['title'] ?>"><?= $arPosts['title'] ?></a></p> <!-- Оглавление поста -->
                                        <div class="main_date_name">
                                            <p class="post">Автор: <?= $author['name'] ?></p>           <!-- Имя автора поста -->
                                            <p class="post">Просмотров: <?= $arPosts['active'] ?></p>   <!-- Активность поста -->
                                            <p class="post date">Дата: <?= $arPosts['date'] ?></p>      <!-- Время публикации -->
                                        </div>
                                    </div>
                                    
                                    <?php
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        else {                                                                           // Если пользователь не выбрал категорию
            foreach ($postsTable as $arPosts) {
                $counter += 1;                                                           // Счётчик постов

                foreach ($authorsTable as $author) {

                    $coun = ceil($counter / 5);                                          // Номер страници (на одной странице 5 постов)

                    if($arPosts['author_id'] == $author['id']) {
            
                    if (isset($_GET['post']) && $_GET['post'] == $arPosts['title']) {
                        viewPost($arPosts, $author['name']);                             // Вызов функции для просмотра поста
                    } ?>

                    <!-- Вывод постов -->
                        <div class="main_post_path" <?php if ((isset($_GET['page']) && $_GET['page'] != $coun) || (!isset($_GET['page']) && $coun != 1)) { ?> style="display: none;" <?php } ?>>
                            <p class="post"><a href="?post=<?= $arPosts['title'] ?>"><?= $arPosts['title'] ?></a></p> <!-- Оглавление поста -->
                            <div class="main_date_name">
                                <p class="post">Автор: <?= $author['name'] ?></p>           <!-- Имя автора поста -->
                                <p class="post_view">Просмотров: <?= $arPosts['active'] ?></p>   <!-- Активность поста -->
                                <p class="post date">Дата: <?= $arPosts['date'] ?></p>      <!-- Время публикации -->
                            </div>
                        </div>
                    
                    <?php 
                    }
                }
            }
        }

        ?>


        </div>


        <!-- Форма для пагинации -->
        <form method="GET" class="pages_pagination">
            <?php 
            for ($i = 1; $i <= $coun; $i++) { ?>
                <button name="page" value="<?= $i ?>"><?= $i ?></button>
            <?php } ?>
        </form>




        <?php

        // Функция для просмотра поста
        function viewPost($post, $author) {
            
            $news = new News();
            $news->active($post['id']); ?>

            <style>.main_post_path {display: none;}.pages_pagination{display: none;}</style>
            <p><b><?= $post['title'] ?></b></p>                     <!-- Оглавление поста -->
            <p class="main_post_text"><?= $post['content'] ?></p>   <!-- Содержимое поста -->
            <div class="main_date_name">
                <p><?= $author ?></p>                               <!-- Автор поста -->
                <p><?= $post['active'] ?></p>                       <!-- Активность поста -->
                <p class="date"><?= $post['date'] ?></p>            <!-- Дата создания поста -->
            </div>
            
        <?php } ?>




    </div>

</div>

<?php

require_once './footer.php';