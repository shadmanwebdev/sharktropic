<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Product.php';
    
    if(isset($_POST['create_product'])) {
        $p = new MyApp\Classes\Product();
        $p->create_product();
    }
    if(isset($_POST['update_product'])) {
        $p = new MyApp\Classes\Product();
        $p->update_product($_POST['product_id']);
    }
    if(isset($_POST['del'])) {
        $p = new MyApp\Classes\Product();
        $p->delete_product($_POST['del_id']);
    }
?>