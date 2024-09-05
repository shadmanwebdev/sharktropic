<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Product.php';
    include '../Classes/Order.php';

    $order = new MyApp\Classes\Order;
    
    if(isset($_POST['inititate_order'])) {
        $order->inititate_order();
    }
    if(isset($_POST['create_order'])) {
        $order->create_order();
    }
    if(isset($_POST['update_order_status'])) {
        $order->update_order_status_admin($_POST['order_id'], $_POST['order_status']);
    }
?>