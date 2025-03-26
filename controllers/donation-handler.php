<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Donations.php';
    
    $donations = new MyApp\Classes\Donations();

    if(isset($_POST['create_donation'])) {
        $donations->create_donation();
    }
    
    if(isset($_POST['update_donation'])) {
        $donations->update_donation($_POST['donation_id']);
    }
?>