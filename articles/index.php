<?php 
require_once './header.php';
require_once './connect.php'; 
?>

<h2>Main</h2>

<div class="content">

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

$categoryGet = '';
if(isset($_GET['category'])) {
    $categoryGet = $_GET['category'];
}





// Получение директории

$dir = $_GET['dir'] ?? '.\\';   // Если 'dir' существует, то принимает 'dir', иначе \
$dir = realpath($dir);          // Абсолютный путь к файлу
chdir($dir);                    // Изменяет текущий каталог на указанный




$news = new News();

$categoryTable = $news->getPosts('categories');
$categoryTable = (array)$categoryTable;

$postsTable = $news->getPosts('posts');
$postsTable = (array)$postsTable;

$authorsTable = $news->getPosts('authors');
$authorsTable = (array)$authorsTable;





if (isset($_GET['category'])) {
    foreach ($categoryTable as $category) {
        if ($_GET['category'] == $category['name']) {
            foreach ($postsTable as $arPosts) {

                $category_id = $category['id'];

                $cat = $news->getPosts('posts', $category_id);
                $cat = (array)$cat;

                foreach ($cat as $path) {
                    if ($path['title'] == $arPosts['title']) {

                        foreach ($authorsTable as $author) {
    
                            if (isset($_GET['post']) && $_GET['post'] == $arPosts['title']) {
                                viewPost($arPosts, $author['name']);
                            }
            
                            ?>
                        
                            <div class="main_post_path">
                                <p class="post"><a href="?<?php if (isset($_GET['category'])) { ?>category=<?= $_GET['category']; ?>&<?php } ?>post=<?= $arPosts['title'] ?>"><?= $arPosts['title'] ?></a></p>
                                <div class="main_date_name">
                                    <p class="post"><?= $author['name'] ?></p>
                                    <p class="post date"><?= $arPosts['date'] ?></p>
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
else {
    foreach ($postsTable as $arPosts) {

        foreach ($authorsTable as $author) {
    
            if (isset($_GET['post']) && $_GET['post'] == $arPosts['title']) {
                viewPost($arPosts, $author['name']);
            }
    
            ?>
        
            <div class="main_post_path">
                <p class="post"><a href="?post=<?= $arPosts['title'] ?>"><?= $arPosts['title'] ?></a></p>
                <div class="main_date_name">
                    <p class="post"><?= $author['name'] ?></p>
                    <p class="post date"><?= $arPosts['date'] ?></p>
                </div>
            </div>
        
            <?php
        }
    }
}





function viewPost($post, $author) { ?>
    <style>.main_post_path {display: none;}</style>
    <p><b><?= $post['title'] ?></b></p>
    <p class="main_post_text"><?= $post['content'] ?></p>
    <div class="main_date_name">
        <p><?= $author ?></p>
        <p class="date"><?= $post['date'] ?></p>
    </div>
    <?php
}

require_once './footer.php' 

?>





    </div>

</div>