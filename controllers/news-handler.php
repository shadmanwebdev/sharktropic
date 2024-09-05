<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/News.php';
    
    if(isset($_POST['create_news'])) {
        $p = new MyApp\Classes\News();
        $p->create_news();
    }
    if(isset($_POST['update_news'])) {
        $p = new MyApp\Classes\News();
        $p->update_news($_POST['news_id']);
    }
    if(isset($_POST['del'])) {
        $p = new MyApp\Classes\News();
        $p->delete_news($_POST['del_id']);
    }
?>