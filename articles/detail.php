<?php 

require_once './header.php';
require_once './News.php'; 
require_once './Users.php'; 

$news = new News();
$users = new Users();

// echo '<pre>';
// print_r($news->getPosts('posts'));
// echo '</pre>';

// $result = $news->active(4);
// echo $result;

$alex = 'secret';
$user = $users->checkLogin($alex);
echo $user;

require_once './footer.php';