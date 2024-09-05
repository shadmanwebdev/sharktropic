<?php

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';

    $user = new MyApp\Classes\User();
    $user->logout();

?>