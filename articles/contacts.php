<?php require_once 'header.php' ?>

<h2>Users</h2>

<div class="all_users">

    <?php  

    $users = new Users();

    $counUsers = 0;

    foreach ($users->allUser() as $UserLogin) {
        $counUsers += 1;
        echo $counUsers.': '.$UserLogin.'<br>';
    }


    ?>

</div>
    
<?php require_once 'footer.php' ?>