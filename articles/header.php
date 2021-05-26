<?php include 'Users.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
    </style>
</head>
<body>
    
<div class="window">

    <div class="window_wrapper">

        <div class="header">
        
            <div>
                <img src="./img/logo.png" class="header_logo" alt="logo">
            </div>

            <div class="header_nav">
                <ul>
                    <li><a href="./index.php">Main</a></li>
                    <li><a href="./gallery.php">Gallery</a></li>

                    <?php 
            
                    if (isset($_COOKIE['login'])) {
                        $listUsers = new Users();
                        $user = $listUsers->CheckCookieLogin();

                        if (md5($user['login']) == $_COOKIE['login']) { ?>

                            <li><a href="./addPost.php">Add post</a></li>

                        <?php 
                        }
                        else { ?>

                            <li><a href="./contacts.php">Users</a></li>
            
                        <?php 
                        }
                    }
                    else if (!isset($_COOKIE['login'])) {
                    
                    ?>

                        <li><a href="./contacts.php">Users</a></li>

                    <?php 
                    } ?>

                </ul>
            </div>

            <?php 
            
            if (isset($_COOKIE['login'])) {
                $listUsers = new Users();
                $user = $listUsers->CheckCookieLogin($_COOKIE['login']);

                if (md5($user['login']) == $_COOKIE['login']) { ?>

                    <div class="enter_account">
                        <div><a href="./logout.php">Logout</a></div>
                    </div>

                <?php 
                }
                else { ?>

                    <div class="enter_account">
                        <div><a href="./autorization.php">Login</a></div>
                    </div>
    
                <?php 
                }
            }
            else if (!isset($_COOKIE['login'])) {
            
            ?>

                <div class="enter_account">
                    <div><a href="./autorization.php">Login</a></div>
                </div>

            <?php 
            } ?>
        
        </div>