<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $fileDir = dirname(__FILE__); // $parentDir = dirname($fileDir);
    
    if(!isset($_SESSION['v'])) { 
        $_SESSION['v'] = 1; 
        $v = $_SESSION['v'];
    } else {
        $v = floatval($_SESSION['v']) + 200;
        $_SESSION['v'] = $v;
    }

    include '../functions.php';
    include '../Classes/Db.php';
    include('../Classes/SiteSettings.php');
    include('../Classes/ContactMessage.php');
    include('../Classes/User.php');
    include('../Classes/AdminAccount.php');
    include('../Classes/Product.php');
    include('../Classes/News.php');
    include('../Classes/Order.php');
    include('../Classes/Newsletter.php');
    include('../Classes/Coupon.php');
    include('../Classes/Donations.php');
    $s = new MyApp\Classes\SiteSettings;


    
    if(isset($_SESSION['user'])) {
        $logged_in = is_logged_in();
        if($logged_in != '1') {
            header('location: ../login');
        } else {
            // var_dump($_SESSION['user']);
        }
    } else {
        header('location: ../login');
    }

    // include '../Classes/User.php';
    // Classes
    // spl_autoload_register('load_class');

    // $settings = new MyApp\Classes\SiteSettings();
    // $home = new Home();
    // $faq = new Faq();
    // $user = new MyApp\Classes\User();
    // // $user->check_user_session();
    // if(isset($_GET['page'])) {
    //     $_SESSION['previous_data'] = $_GET['page'];
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<title><?= $s->sitename(); ?></title>
    <meta name='title' content='<?= $s->title_tag(); ?>'>
    <meta name='description' content='<?= $s->meta_description(); ?>'>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../fonts/icomoon/style.css?v=100">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css?v=5">
    <link rel="stylesheet" href="./css/table.css?v=16">
    <link rel="stylesheet" href="./css/form.css?v=18">
    <link rel="stylesheet" href="./css/form-response.css?v=16">
    <link rel="stylesheet" href="./css/paging.css?v=21">
    <link rel="stylesheet" href="./css/loader.css?v=21">
    <link rel="stylesheet" href="./css/popup.css?v=26">
    <link rel="stylesheet" href="./css/details-popup.css?v=<?= $v; ?>">
    <link rel="stylesheet" href="./css/delete-popup.css?v=28">
    <link rel="stylesheet" href="./css/popup-form.css?v=5000">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {  
            /* background-color: #f7f7fc; */
            
            font-family: Poppins, Arial, sans-serif;
            /* font-family: sans-serif; */
            font-size: 16px;
            box-sizing: border-box;
            letter-spacing: 1px;
            font-weight: 400;
            background: linear-gradient(180deg, rgba(31, 48, 75, 0.95) 0%, rgba(14, 22, 35, 0.9) 100%);
        }
        input, textarea {  
            font-family: Poppins, Arial, sans-serif;
            font-size: 16px;
        }
        .error {
            color: #ff6060;
            font-size: 14px;
            line-height: 2;
            padding: 0 4px;
        }
        .wrapper {
            align-items: stretch;
            display: flex;
            width: 100%;
            background: #222e3c;
        }
        .main {
            display: flex;
            width: 100%;
            min-width: 0;
            min-height: 100vh;
            transition: margin-left 0.35s ease-in-out, left 0.35s ease-in-out, margin-right 0.35s ease-in-out, right 0.35s ease-in-out;
            
            flex-direction: column;
            overflow: hidden;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }


        /* Sidebar & topbar */
        .top-bar {
            width: 100%;
            padding: 20px 30px;
            background: transparent;
            /* box-shadow: 0 0 2rem 0 rgba(33, 37, 41, 0.1); */
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .top-bar .page-title {
            font-size: 28px;
            font-weight: 600;
            line-height: 42px;
            text-align: left;

        }
        .menu-icons {
            display: flex;
            flex-flow: row-reverse nowrap;
            align-items: center;
            justify-content: flex-end;
        }
        #navBtn {
            /* display: grid; */
            margin-left: auto;
        }
        .show_sidebar {
            animation: .5s pull ease-in-out forwards;
        }
        .hide_sidebar {
            animation: .5s push ease-in-out forwards;
        }
        
        @keyframes pull {
            
            0% {
                margin-left: -260px;
            }
            100% {
                margin-left: 0;
            }
        }
        @keyframes push {
            0% {
                margin-left: 0;
            }
            100% {
                margin-left: -260px;
            }
        }
        #navBtn {
            display: grid;
            grid-template-rows: auto;
            grid-template-columns: 1fr;
            row-gap: 7px;
            cursor: pointer;
            width: 28px;
            height: 19px;
            position: relative;
            z-index: 0;
        }
        #navBtn span {
            width: 28px;
            height: 2px;
            background-color: #ffffff;
        }


        .delete-link {
            color: red;
        }
    </style>


    <!-- Buttons -->
    <style>
		.admin-btn-1 {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            justify-content: center;
			font-size: 14px;
            min-width: 145px;
			height: 50px;
			padding: 16px 20px 16px 20px;
			gap: 10px;
			border-radius: 1000px;
			background: #FEFA6A;
			border: 1px solid #FEFA6A;
			color: #111111;
			font-weight: 600;
            cursor: pointer;
		}
        .admin-btn-1 svg {
            margin-right: 1px;
		}

        .admin-btn-2 {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            justify-content: center;
			font-size: 14px;
			min-width: 145px;
			height: 50px;
			padding: 16px 20px 16px 20px;
			gap: 10px;
			border-radius: 1000px;
			background: transparent;
			border: 1px solid #44577A;
			color: #FFFFFF;
			font-weight: 600;
            cursor: pointer;
		}
        .admin-btn-2 svg {
            margin-right: 1px;
		}
    </style>


    <!-- Admin Logo -->
    <style>
        .logo {
            margin: 0px auto 20px auto;
            max-width: 250px;
        }
        @media screen and (min-width: 1280px) {
            .logo {
                max-width: 300px;
            }
        }
    </style>

    <!-- JQUERY -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <!-- JQUERY UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- JS -->
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>
    <script src="./js/admin.js?v=15" defer></script>
    <script src="./js/faq.js?v=15" defer></script>
    <script src="./js/popup.js?v=15" defer></script>
    <script src="./js/delete-popup.js?v=17" defer></script>
    <script src="./js/admin-account.js?v=17" defer></script>
    <script src="./js/product.js?v=23" defer></script>
    <script src="./js/news.js?v=23" defer></script>

    
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


        .scrollable-div-y {
            max-height: 70vh; /* Set a max-height for the scrollable area */
            /* width: 100%; */
            overflow-x: hidden;
            overflow-y: auto; /* Enable vertical scrolling */
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
    <!-- TinyMCE -->
    <!-- <script src="https://cdn.tiny.cloud/1/93uwww3rarc2konkzn8yvxhx6748irjh3szcgde1rrzzaway/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
</head>
<body>

    <div id="popBg" onclick='closePopup();'></div>
    <div id="bgOverlay"></div>

    <div id='msg-alert'></div>
    <div id='loader'></div>

    <div style='background-color: transparent; padding: 0; top: 50px; margin-top: 0 !important;' class='popup hide_popup' id='accountPopUpContainer'>

    </div>