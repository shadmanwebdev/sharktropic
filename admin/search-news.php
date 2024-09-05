<?php    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/News.php';
    
    
    $n = new MyApp\Classes\News();


    $search = isset($_POST['search']) ? $_POST['search'] : ''; 
    $n->searched_news($search);
?>