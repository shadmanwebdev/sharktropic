<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    
    include './functions.php';
    include './Classes/Db.php';
    include './Classes/Product.php';

    $product = new MyApp\Classes\Product();

    $product_id = $_GET['pid'];
    echo $product->product_images($product_id);
?>