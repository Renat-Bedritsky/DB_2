<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        * {
        margin: 0;
        padding: 0;
        }

        html, body {
            height: 100%;
        }

        .window {
            margin: auto;
            width: 80%;
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .window_wrapper {
            flex: 1 0 auto;
        }

        h2 {
            text-align: center;
            font-size: 48px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            color: #222;
        }

        li {
            list-style-type: none;
        }

        .header {
            background-color: rgb(39, 123, 218);
            padding: 30px;
            display: flex;
        }

        .header_logo {
            width: 170px;
            height: 50px;
        }

        .header_nav {
            margin-left: 5%;
            padding-top: 15px;
        }

        .header_nav ul li {
            display: inline;
            font-size: 32px;
            text-transform: uppercase;
            margin-left: 20px;
            font-weight: 700;
        }

        .enter_account {
            margin-left: auto;
            font-size: 24px;
        }

        .content {
            display: flex;
            font-size: 24px;
        }

        .main_category {
            width: calc(20% - 15px);
            background-color: rgb(39, 123, 218);
            padding: 10px;
        }

        .main_posts {
            width: calc(80% - 15px);
            background-color: rgb(236, 232, 167);
            margin-left: 30px;
            padding: 10px;
        }

        .main_posts a {
            color: rgb(39, 123, 218);
        }

        .main_posts a:hover {
            color: black;
        }

        .main_post_path {
            margin: 15px 0;
        }

        .main_posts p:nth-child(1) {
            font-weight: 100;
            font-size: 24px;
        }

        .main_date_name {
            display: flex;
            margin-top: 5px;
        }

        .main_post_text {
            margin: 20px;
        }

        .pages_wrapper {
            display: flex;
        }
                
        .pages_wrapper div {
            display: flex;
            margin: 0 auto;
        }

        .pages_wrapper a {
            padding: 0 6px;
        }

        .main_pages {
            border: 1px solid black;
            width: 25px;
            height: 25px;
            text-align: center;
            margin: 0 4px;
        }

        .main_pages:hover {
            border: 1px solid rgb(39, 123, 218);
        }

        .date {
            margin-left: auto;
        }

        .gallery {
            width: 300px;
            height: 300px;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            background-color: #222;
            padding: 30px;
            color: white;
            flex: 0 0 auto;
        }

        .footer ul {
            margin-left: calc(100% - 600px);
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
                    <li><a href="./contacts.php">Contacts</a></li>
                </ul>
            </div>

            <div class="enter_account">
                <div><a href="./enter.php">Войти</a></div>
            </div>
        
        </div>