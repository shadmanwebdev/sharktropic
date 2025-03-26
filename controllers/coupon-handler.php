<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Coupon.php';
    
    $coupon = new MyApp\Classes\Coupon();

    if(isset($_POST['create_coupon'])) {
        $coupon->create_coupon();
    }
    
    if(isset($_POST['update_coupon'])) {
        $coupon->update_coupon();
    }
?>