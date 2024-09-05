<?php    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Product.php';
    
    
    $p = new MyApp\Classes\Product();


    $search = isset($_POST['search']) ? $_POST['search'] : ''; 
    $p->searched_products($search);
?>