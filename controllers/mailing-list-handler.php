<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Newsletter.php';
    
    $nl = new MyApp\Classes\Newsletter();

    if(isset($_POST['add_to_mailing_list'])) {
        $nl->add_to_mailing_list();
    }
?>