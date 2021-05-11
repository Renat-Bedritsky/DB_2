<?php 
require_once './header.php';
require_once './connect.php'; 
?>

<h2>Main</h2>

<div class="main_content">

    <div class="main_category">
        <ul>
            <li>All</li>
            <li>Sport</li>
            <li>Nature</li>
            <li>Politics</li>
            <li>Animals</li>
        </ul>
    </div>

    <div class="main_posts">
  
<?php 

$news = new News();
$posts = $news->getPosts(1);
$posts = (array)$posts;
// echo '<pre>';
// print_r($posts);
// echo '</pre>';

foreach ($posts as $arPosts) {
    // echo '<pre>';
    // print_r($arPosts);
    // echo '</pre>';
    ?>

    <p><a href="#"><?= $arPosts['title'] ?></a></p>
    <p><?= $arPosts['content'] ?></p>
    <p><?= $arPosts['author_id'] ?></p>
    <p><?= $arPosts['date'] ?></p>

    <?php
}

require_once './footer.php' 

?>
    </div>

</div>