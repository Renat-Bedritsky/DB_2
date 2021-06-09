<?php 

require_once './header.php';
require_once './News.php'; 
require_once './Users.php'; 

$news = new News();
$users = new Users();

echo '<pre>';
print_r($news->getPosts('posts'));
echo '</pre>';

// echo '<pre>';
// print_r($news->getCategory('3'));
// echo '</pre>';

// echo '<pre>';
// print_r($users->allUser());
// echo '</pre>';

// echo $users2->autorization('admin', 'e10adc3949ba59abbe56e057f20f883e');

require_once './footer.php'; ?>