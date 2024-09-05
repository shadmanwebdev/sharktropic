<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    include '../Classes/AdminAccount.php';
    
    $aa = new MyApp\Classes\AdminAccount();

    if(isset($_POST['update_password'])) {
        $aa->update_password();
    }
    if(isset($_POST['create_admin'])) {
        $aa->createAdmin();
    }
    if(isset($_POST['update_admin'])) {
        $aa->updateAdmin();
    }
    if(isset($_GET['deladmin'])) {
        $aa->delete($_GET['deladmin']);
    }
    if(isset($_POST['update_user_password'])) {
        $aa->update_user_password();
    }
    if(isset($_POST['update_email'])) {
        $aa->update_email();
    }
?>