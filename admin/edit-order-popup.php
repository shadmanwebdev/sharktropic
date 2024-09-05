<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    $type = $_GET['type'];
    $id = $_GET['id'];

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Order.php';
?>





<?php
    
    $o = new MyApp\Classes\Order();
    $o->order_details($id);
    
?>