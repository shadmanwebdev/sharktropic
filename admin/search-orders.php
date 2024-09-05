<?php    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Order.php';
    
    
    $o = new MyApp\Classes\Order();


    $search = isset($_POST['search']) ? $_POST['search'] : ''; 
    $o->searched_orders($search);
?>