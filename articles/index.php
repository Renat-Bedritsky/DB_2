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
            <li><a href="?category=technologies">Technologies</a></li>
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

                                    $coun = ceil($counter / 5);                        // Номер страницы (на одной странице 5 постов)

                                    if($arPosts['author_id'] == $author['id']) {
            
                                    if (isset($_GET['post']) && $_GET['post'] == $arPosts['title']) {
                                        $linkBack = $_SERVER['PHP_SELF']."?category=".$category['name']."&page=$coun";
                                        viewPost($arPosts, $author['name'], $linkBack);           // Вызов функции для просмотра поста
                                    } ?>

                                    <!-- Вывод постов -->
                                    <table class="main_post_path" <?php if ((isset($_GET['page']) && $_GET['page'] != $coun) || (!isset($_GET['page']) && $coun != 1)) { ?> style="display: none;" <?php } ?>>
                                        <tr>
                                            <td colspan="3"><a href="?category=<?= $category['name'] ?>&post=<?= $arPosts['title'] ?>"><?= $arPosts['title'] ?></a></td> <!-- Оглавление поста -->
                                        </tr>
                                        <tr>
                                            <td>Автор: <?= $author['name'] ?></td>           <!-- Имя автора поста -->
                                            <td>Просмотров: <?= $arPosts['active'] ?></td>   <!-- Активность поста -->
                                            <td>Дата: <?= $arPosts['date'] ?></td>           <!-- Время публикации -->
                                        </tr>      <!-- Время публикации -->
                                    </table>
                                    
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

                    $coun = ceil($counter / 5);                                          // Номер страницы (на одной странице 5 постов)

                    if($arPosts['author_id'] == $author['id']) {
            
                    if (isset($_GET['post']) && $_GET['post'] == $arPosts['title']) {
                        $linkBack = $_SERVER['PHP_SELF']."?page=$coun";
                        viewPost($arPosts, $author['name'], $linkBack);                             // Вызов функции для просмотра поста
                    } ?>

                    <!-- Вывод постов -->
                    <table class="main_post_path" <?php if ((isset($_GET['page']) && $_GET['page'] != $coun) || (!isset($_GET['page']) && $coun != 1)) { ?> style="display: none;" <?php } ?>>
                        <tr>
                            <td colspan="3"><a href="?post=<?= $arPosts['title'] ?>"><?= $arPosts['title'] ?></a></td> <!-- Оглавление поста -->
                        </tr>
                        <tr>
                            <td>Автор: <?= $author['name'] ?></td>           <!-- Имя автора поста -->
                            <td>Просмотров: <?= $arPosts['active'] ?></td>   <!-- Активность поста -->
                            <td>Дата: <?= $arPosts['date'] ?></td>           <!-- Время публикации -->
                        </tr>      <!-- Время публикации -->
                    </table>
                    
                    <?php 
                    }
                }
            }
        }

        ?>



        </div>



        <!-- Форма для пагинации -->
        <div class="pages_pagination">
            <?php 
            if (isset($coun) && $coun > 0) { ?>
                Страница: 
                <?php
                for ($i = 1; $i <= $coun; $i++) {           // С категорией
                    if (isset($_GET['category'])) { 
                        $link = $_SERVER['PHP_SELF']."?category=".$_GET['category']."&page=$i"; ?>
                        <a href="<?= $link ?>"><?= $i ?></a>
                    <?php }
                    else if (!isset($_GET['category'])) {   // Без категории
                        $link = $_SERVER['PHP_SELF']."?page=$i"; ?>
                        <a href="<?= $link ?>"><?= $i ?></a>
                    <?php 
                    }
                }
            }
            else echo 'Постов нет'; ?>
        </div>




        <?php

        // Функция для просмотра поста
        function viewPost($post, $author, $linkBack) {
            
            $news = new News();
            $news->active($post['id']); ?>

            <style>.main_post_path {display: none;}.pages_pagination{display: none;}</style>

            <table>
                <tr>
                    <td colspan="3"><?= $post['title'] ?></td>
                </tr>                     <!-- Оглавление поста -->
                <tr>
                    <td colspan="3" class="view_post"><?= $post['content'] ?></td>
                </tr>   <!-- Содержимое поста -->
                <tr>
                    <td>Автор:      <?= $author ?></td>           <!-- Автор поста -->
                    <td>Просмотров: <?= $post['active'] ?></td>   <!-- Активность поста -->
                    <td>Дата:       <?= $post['date'] ?></td>     <!-- Дата создания поста -->
                </tr>
            </table>

            <a href="<?= $linkBack ?>">&#171; Back</a>
            
        <?php } ?>




    </div>

</div>

<?php

require_once './footer.php';