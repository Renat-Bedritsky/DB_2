<?php 

require_once './header.php';
require_once './News.php'; 

$news = new News();

// echo '<pre>';
// print_r($news->active(4));
// echo '</pre>';

$result = $news->active(4);
echo $result;

require_once './footer.php';