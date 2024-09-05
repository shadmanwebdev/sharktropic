<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    error_reporting(E_ALL);
    ini_set("display_errors","On");

    if(!isset($_SESSION['v'])) { 
        $_SESSION['v'] = 10; 
        $v = $_SESSION['v'];
    } else {
        $v = floatval($_SESSION['v']) + 10;
        $_SESSION['v'] = $v;
    }

    $fileDir = dirname(__FILE__);
    // $parentDir = dirname($fileDir);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    include(ROOT_PATH.'functions.php');
    include(CLASSES_PATH.'Db.php');
    include(CLASSES_PATH.'SiteSettings.php');
    include(CLASSES_PATH.'User.php');
    include(CLASSES_PATH.'MyAccount.php');
    include(CLASSES_PATH.'Product.php');
    include(CLASSES_PATH.'Cart.php');
    include(CLASSES_PATH.'News.php');
    include(CLASSES_PATH.'Order.php');
    include(CLASSES_PATH.'StripePayment.php');

    $stgs = new MyApp\Classes\SiteSettings;

    // if(isset($_SESSION['user'])) {
    //     echo "<h2>{$_SESSION['user']}</h2>";
    // }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $stgs->sitename(); ?></title>
    <meta name='title' content='<?= $stgs->title_tag(); ?>'>
    <meta name='description' content='<?= $stgs->meta_description(); ?>'>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/ionicons.min.css"> -->
    <!-- <link rel="stylesheet" href="css/bootstrap-alt.css"> -->
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Owl Carousel -->

    <link rel="stylesheet" href="css/default.css?v=5">
    <link rel="stylesheet" href="css/owl.carousel.min.css?v=1000">
    <link rel="stylesheet" href="css/owl.theme.default.min.css?v=1000">

    <!-- <link rel="stylesheet" href="css/announcement.css?v=300"> -->
    <link rel="stylesheet" href="css/style.css?v=65">
    <link rel="stylesheet" href="css/popup.css?v=62">
    <link rel="stylesheet" href="css/loader.css?v=63">
    <link rel="stylesheet" href="css/form-response.css?v=63"> 

    <!-- <link rel="stylesheet" href="css/nav.css?v=36">
    <link rel="stylesheet" href="css/footer.css?v=26"> -->

    <!-- Logo -->
    <style>
        /* @font-face {
            font-family: 'ionicons';
            src: url('./font/ionicons.woff') format('woff');
        } */
    </style>


    <style>
        
        .error {
            color: #ff6060;
            font-size: 14px;
            line-height: 2;
            padding: 0 4px;
        }
        .ms-response .error {
            text-align: center;
            line-height: 2.5;
            font-size: 14px;
            color: #ff6060;
        }
        .ms-response .success {
            text-align: center;
            line-height: 2.5;
            font-size: 14px;
            color: #00af4e;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>

    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    
    <script src="js/main.js"></script>
    <script src="js/popup.js"></script>
    <script src="js/form.js"></script>
    <script src="js/user.js?v=20"></script>
    <script src="js/product.js?v=35"></script>


    <!-- mCustomScrollbar CSS from CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- mCustomScrollbar JS from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <style>
        .scrollable-div {
            max-width: 100%;
            width: 100%;
            overflow-y: hidden;
        }
        /* .scrollable-div .content {
            min-width: 900px;
            width: 100%;
        } */
        /* Custom scrollbar styles */
        .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
            background-color: #3498db; /* Custom color for the scrollbar */
        }
        .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,
        .mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar {
            background-color: #2980b9; /* Custom color for hover and active states */
        }
    </style>

    <script defer>
        $(document).ready(function(){
            $(".scrollable-div").mCustomScrollbar({
                axis: "x", // Enable horizontal scrolling only
                theme: "minimal"
            });
        });
    </script>
</head>
<body id='m'>

<?php
    include(ROOT_PATH.'partials/page-loader.php');
?>

<div id='loader'></div>

<div id='popBg' onclick='closePopup();'></div>
<!-- An error occurred while processing your request. -->

<div style='background-color: transparent; padding: 0; top: 50px; margin-top: 0 !important;' class='popup hide_popup' id='accountPopUpContainer'>

</div>