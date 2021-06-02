<?php include 'Users.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            border: 1px solid red;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        td {
            width: 33.33%;
        }
        tr:nth-child(1) td {
            font-size: 28px;
            font-weight: 700;
        }
        tr:nth-child(2) td {
            padding: 0 30px;
        }
        .main_category ul {
            margin-left: 15px;
            font-size: 32px;
        }

        .pages_pagination a {
            padding: 0 5px;
        }

        .autorization,
        .registration {
            border: 3px solid black;
            padding: 10px;
            width: 400px;
            margin: 10% auto 0 auto;
            font-size: 32px;
            text-align: center;
        }

        .autorization_title,
        .autorization_error,
        .registration_title,
        .registration_error {
            font-size: 32px;
            width: 360px;
            text-align: center;
            margin: 10px auto 0 auto;
        }

        .autorization input,
        .registration input {
            width: 99%;
            height: 40px;
            font-size: 32px;
        }
        
        .autorization button,
        .registration button {
            margin-top: 10px;
            width: 190px;
            font-size: 28px;
        }
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