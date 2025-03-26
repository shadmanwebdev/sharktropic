<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once '../vendor/autoload.php';
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Newsletter.php';
    
    $nl = new MyApp\Classes\Newsletter();

    if(isset($_POST['add_to_mailing_list'])) {
        $nl->add_to_mailing_list();
    }
    if(isset($_POST['create_subscriber_message'])) {
        $nl->create_subscriber_message();
    }
    // if(isset($_POST['verify_phone'])) {
    //     $user->verify_email();+8801886898669
    // }
    if(isset($_POST['verify_phone'])) {
        $nl->verify_code();
    }
    if(isset($_GET['view_subscribers'], $_GET['type'])) {
        $nl->subscribers_admin($_GET['type']);
    }

?>