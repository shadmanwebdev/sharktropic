<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    require '../functions.php';
    require '../vendor/autoload.php';

    require '../Classes/Db.php';
    require '../Classes/StripePayment.php';

    $sp = new MyApp\Classes\StripePayment();
    $sp->tip();

?>