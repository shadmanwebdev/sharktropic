<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>


<!-- Logo -->
<style>
    .logo {
        padding: 0;
        width: 250px;
        margin-left: -11px;
        margin-bottom: 64px;
    }
    .logo-text {
        width: inherit;
    }
    .logo a {
        font-size: 20px;
        width: inherit;
        color:  #000;
    }
    .w-bg .logo a {
        color: #000;
    }
    .logo img {
        width: 100%; 
        height: auto;
    }
    .logo .m {
        font-size: 23px;
        letter-spacing: 1px;
        margin-bottom: 3px;
    }
    .logo .sub {
        font-size: 12px;
    }

    @media screen and (min-width: 576px) {
        .logo {
            margin-bottom: 72px;
        }
    }
    @media screen and (min-width: 1200px) {
        .logo {
            width: 300px;
            margin-bottom: 100px;
        }
    }
</style>

<style>
    /* Mobile Navigation */
    .main-menu {
        padding: 42px 60px 134px 60px;
    }
    .main-menu ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .main-menu .menu-item a {
        display: block;
        padding: 12px 0px;
        text-align: left;
        display: block;
        color: #fff;
        font-size: 20px;
        font-weight: 300;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .main-menu a:hover, .main-menu .active > a, .main-menu li:hover > a {
        color: #fff;
        text-decoration: none;
    }

    @media screen and (min-width: 576px) {
        .main-menu {
            padding: 44px 100px 134px 100px;
        }
        .main-menu .menu-item a {
            font-size: 28px;
        }
    }
    @media screen and (min-width: 1280px) {
        .main-menu {
            padding: 44px 182px 134px 182px;
        }
        #header {
            height: auto;
        }
    }
</style>

<!-- Login / Register -->
<style>
    .signup-btn {
        margin-top: 80px;
        margin-left: 0px;
        display: flex;
        flex-flow: column nowrap;
    }
    .signup-btn p {
        color: #fff;
        font-size: 14px;
        margin-bottom: 21px;
    }
    .signup-btn-inner {
        display: flex;
        flex-flow: row nowrap;
        align-items: flex-start;
    }

    #nav-login, #nav-register {
        font-size: 15px;
        border-radius: 30px;
        padding: 12px 20px;
        display: flex;
        flex-flow: row nowrap;
        text-align: center;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        font-weight: 300;
        border: none;
        /* font-weight: bold; */
    }
    #nav-login {
        width: 140px;
        margin: 0 10px 10px 0;

        color: #FFFFFF;
        background-color: transparent;
        border: 1px solid #FFFFFF4D;
    }
    #nav-register {
        width: 140px;
        margin: 0 0 10px 0;

        color: #111111;
        background-color: #FEFA6A;
        border: 1px solid #FEFA6A;
    }
    #nav-login:hover {
        color: #FFFFFF;
        background-color: transparent;
        border: 1px solid #FFFFFF4D;
    }
    #nav-register:hover {
        color: #111111;
        background-color: #FEFA6A;
        border: 1px solid #FEFA6A;
    }

    @media screen and (min-width: 576px) {
        .signup-btn {
            margin-top: 100px;
        }
    }
    @media screen and (min-width: 1280px) {
        #nav-login {
            /* width: auto; */
            margin-left: 0;
            margin-right: 10px;
            margin-bottom: 0px;
        }
        #nav-register {
            /* width: auto; */
            margin-left: 0;
            margin-right: 10px;
            margin-bottom: 0px;
        }
    }
</style>




<style>
    .donate-column {
        display: none;
        flex-direction: column;
        justify-content: space-between;
        max-width: 600px;
        min-height: 100vh;
        background-color: #718AB417;
        padding: 100px 50px;
        color: #fff;
        margin: 0 200px 0 auto;
    }
    .donate-column .middle {
        text-align: center;
    }
    .donate-column .middle p {
        color: #FEFA6A;
    }
    .donate-column .socials {
        width: 50%;
        margin: 0 auto;
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        align-items: center;
    }
    .donate-column .socials a {
        display: block;
        width: 100%;
        height: 100%;
    }
    .donate-column .socials svg {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
    }
    .donate-column .socials img:last-child {
        margin-right: 0px;
    }
    .donate-column svg {
        width: 100%;
    }
    @media screen and (min-width: 1280px) {
        .donate-column {
            display: flex;
        }
    }
</style>

<style>
    #drop-popup {
        position: absolute;
        padding: 30px;
        background: #394152;
        top: 100px;
        margin-top: 0;
        left: 50%;
        border-radius: 25px;
        width: 80%;
        margin-left: -40%;
    }
    #drop-popup .popup-inner {
        position: relative;
    }
    .popup-div {
        padding-top: 50px;
    }
    #cross {
        background: rgba(239, 244, 250, 10%);
        width: 40px;
        height: 40px;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        
        position: absolute;
        left: 0px;
        top: -7px;
        
        z-index: 1;
    }
    #cross img {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    @media (min-width: 576px) {
        #drop-popup {
            width: 500px;
            margin-left: -250px;
        }
    }
    @media (min-width: 768px) {
        #drop-popup {
            padding: 30px;
            top: 100px;
            width: 700px;
            margin-left: -350px;
        }
    }
</style>


<!-- Donation Popup -->
<style>
    .news-outer {
        max-width: 1400px;
        margin: 0px auto;
    }
    .drops {
        max-width: 1400px;
        margin: 0px auto;
        margin-top: 100px;
        /* margin: 50px auto; */
    }
    .drop {
        display: flex;
        flex-flow: column nowrap;
    }
    .drop .col-right {
        margin-left: 0px;
    }
    
    .drop-images .image {
        width: 250px;
        height: 250px;
        margin-bottom: 30px;
        border-radius: 30px;
        overflow: hidden;
    }
    .drop-images .image img {
        width: 250px;
        height: 250px;
        object-fit: cover;
    }
    .drop-title {
        width: 100%;
        padding: 0;
        font-weight: 600;
        margin-bottom: 0px;
    }
    .drop h2 {
        font-size: 23px;
        font-weight: 600;
        line-height: 1.5;
        margin-bottom: 10px;
        color: rgba(255, 255, 255, 1);
    }
    .drop .text-row {
        flex: 0 1 100%;
    }
    .drop .text-row p {
        margin: 0;
        font-weight: 400;
        font-size: 16px;
        line-height: 2;
        letter-spacing: -0.006em;
        color: rgba(255, 255, 255, 1);
        margin-bottom: 1.5rem;
    }
    @media screen and (min-width: 576px) {    
        .drops {
            margin-top: 0px;
        }
        .drop {
            display: flex;
            flex-flow: row nowrap;
        }
        .drop .col-right {
            margin-left: 40px;
        }
        .drop .drop-images {
            width: 250px;
            height: 250px;
            margin-bottom: 0px;
            border-radius: 30px;
        }
    }
</style>

<!-- Carousel -->
<style>
    .owl-carousel {
        position: relative;
    }
    .drop-images > .owl-nav {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        pointer-events: none;
    }
    .drop-images > .owl-nav button {
        background: rgba(255, 255, 255, 0);
        /* background: rgba(255, 255, 255, 0.2); */
        border: none;
        cursor: pointer;
        pointer-events: all;
        height: 100%;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        padding: 0px;
    }
    .drop-images > .owl-nav .owl-prev {
        top: 0;
        left: 0;
    }
    .drop-images > .owl-nav .owl-next {
        top: 0;
        right: 0;
    }
    .drop-images > .owl-nav button img {
        width: 15px;
    }
    .drop-images > .owl-nav .owl-next button img {
        transform: rotate(-180deg); /* Rotate for the left arrow */
    }
    .news-sections > .owl-nav {
        position: absolute;
        top: -67px;
        left: 50%;
        width: 90px;
        margin-left: -45px;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        pointer-events: none;
    }

    .news-sections > .owl-nav button {
        cursor: pointer;
        pointer-events: all;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        height: 40px;
        width: 40px;
    }
    .news-sections > .owl-nav .owl-prev button {
        background: rgba(255, 255, 255, 0);
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-right: 10px;
    }
    .news-sections > .owl-nav .owl-next button {
        background: yellow;
        border: 1px solid rgba(254, 250, 106, 1);
    }
    
    .news-sections > .owl-nav button img {
        width: 10px;
    }
    .news-sections > .owl-nav .owl-next button img {
        transform: rotate(0deg); /* Rotate for the left arrow */
    }

    
    .svg-image {
        filter: invert(50%); /* Example filter to modify color */
    }
    @media screen and (min-width: 1280px) {
        .news-sections > .owl-nav {
            top: -110px;
            right: 0;
            left: auto;
            margin-left: 0;
            margin-right: 0;
        }
        .news-sections > .owl-nav button {
            height: 50px;
            width: 50px;
        }
        .news-sections > .owl-nav button img {
            width: 15px;
        }
    }
</style>

<!-- Chart -->
<style>
    .chart-container {
        position: relative;
        width: 50%;
        margin: 0 auto 30px auto;
        /* height: 200px; */
    }
    /* .chart-container::before {
        content: "$57.50";
        position: absolute;
        top: 0px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        font-weight: 500;
        font-size: 16px;
    } */
    .yellow-curve {
        fill: none;
        stroke: #ffeb3b;
        stroke-width: 2;
    }
    .gray-curve {
        fill: none;
        stroke: #cfcfcf;
        stroke-width: 2;
    }
    .middle-circle {
        fill: #ffeb3b;
        stroke: #ffeb3b;
        stroke-width: 4;
    }

    .chart-outer {
        display: flex;
        flex-flow: row nowrap;
        position: relative;
    }
    .chart-outer .from {
        position: absolute;
        bottom: 47px;
        left: 12px;
    }
    .chart-outer .to {
        position: absolute;
        top: 4px;
        right: 30px;
    }
    .chart-outer .arrow {
        position: absolute;
        top: -19px;
        left: 33%;
        font-size: 20px;
    }
    .chart-outer .arrow img {
        margin-right: 10px;
    }
</style>

<div id='drop-popup-wrapper'>

</div>


<div class='home'>
    <nav class="main-menu">
        <div class="logo float-left">
            <a href="./">
                <img src="assets/logo-new.svg?v=1" alt="" class="img-fluid">
            </a>
        </div>
        <ul>
            <li class="menu-item"><a href="./shop">Shop</a></li>
            <li class="menu-item"><a href="./about">About</a></li>
            <li class="menu-item"><a href="./collections">Collections</a></li>
            <li class="menu-item"><a href="./news">News</a></li>
            <li class="menu-item"><a href="./mailing-list">Mailing list</a></li>

            <?php
                if(!isset($_SESSION['user'])) {
            ?>
            
                <li class='signup-btn'>
                    <p>Create an account or Log In</p>
                    <div class='signup-btn-inner'>
                        <a href='./login' id='nav-login'>Log In</a>
                        <a href='./signup' id='nav-register'>Sign Up</a>
                    </div>
                </li>

            <?php          
                    
                } else {
            ?>

                <li class="menu-item"><a href="./my-collection">Your Collection</a></li>
                <li class='signup-btn'>
                    <div class='signup-btn-inner'>
                        <a href='./controllers/logout-handler' id='nav-register'>Log Out</a>
                    </div>
                </li>

            <?php          
                    
                }
            ?>


        </ul>
    </nav>

    <div class='donate-column'>
        <div class='title' style='text-align: center;'>
            <h3 id="currentDateTime">Loading...</h3>
        </div>

        <div class='middle'>

            <div class="chart-outer">
                <span class='arrow'>
                    <img src="./assets/logo8.svg" alt="">$57.50
                </span>
                <span class='from'>From</span>
                <div class="chart-container">
                    <svg width="268" height="142" viewBox="0 0 268 142" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="1" d="M1 138.66C1 138.66 55.4187 145.401 83 128.648C94.0093 121.961 96.519 112.961 108 107.123C119.614 101.217 129.316 106.299 140.5 99.614C159.032 88.5375 147.511 60.3424 167 51.0573C181.282 44.2532 192.37 55.6721 207.5 51.0573" stroke="yellow" stroke-width="4"/>
                        <path opacity="0.2" d="M 207.5 51.0573 C226.258 45.3359 232.343 33.0622 247 20.0211C254.64 13.2235 266 2 266 2" stroke="white" stroke-width="4"/>
                    </svg>


                    <!-- <svg viewBox="0 0 100 100" width="100%" height="100%">
                        <path d="m 0 100 t 12 -2 t 11 -16 t 14 -17 t 18 -9 t 8 -14" class="yellow-curve" />
                        <path d="M 63 42 t 19 -9 t 17 -32" class="gray-curve" />
                        <circle cx="63" cy="42" r="2.5" class="middle-circle" />
                    </svg> -->
                </div>
                <span class='to'>
                    <img src="./assets/infinite.svg" alt="">
                </span>
            </div>
            <!-- <h2>SAVE THE SHARKS</h2> -->
            <h2>SPREAD THE GOSPEL</h2>
            <p>RAISED: $57.50</p>
        </div>
        <!-- <div class='credits'>
            <img src="./assets/credits.png" alt="">
        </div> -->

        <style>
            #credit-carousel .item {
                display: block;
                width: 100%;
                /* overflow: hidden; */
            }
            #credit-carousel .item img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
            }
        </style>

        <div class="credits">
            <div class="owl-carousel owl-theme" id="credit-carousel">
                <?php
                    $donations = new MyApp\Classes\Donations();
                    $donations->donation_credit_items();
                ?>
                <!-- <div onclick='get_donation_credit_popup("2")' class="item"><img src="./assets/credit-2.png" alt="Slide 2"></div>
                <div onclick='get_donation_credit_popup("3")' class="item"><img src="./assets/credit-3.png" alt="Slide 3"></div>
                <div onclick='get_donation_credit_popup("4")' class="item"><img src="./assets/credit-4.png" alt="Slide 4"></div>
                <div onclick='get_donation_credit_popup("5")' class="item"><img src="./assets/credit-5.png" alt="Slide 4"></div> -->
            </div>
        </div>



        <div class='socials'>
            <!-- <a target='_blank' href="https://open.spotify.com/">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M15.9 8.9C12.7 7 7.35 6.8 4.3 7.75C3.8 7.9 3.3 7.6 3.15 7.15C3 6.65 3.3 6.15 3.75 6C7.3 4.95 13.15 5.15 16.85 7.35C17.3 7.6 17.45 8.2 17.2 8.65C16.95 9 16.35 9.15 15.9 8.9ZM15.8 11.7C15.55 12.05 15.1 12.2 14.75 11.95C12.05 10.3 7.95 9.8 4.8 10.8C4.4 10.9 3.95 10.7 3.85 10.3C3.75 9.9 3.95 9.45 4.35 9.35C8 8.25 12.5 8.8 15.6 10.7C15.9 10.85 16.05 11.35 15.8 11.7ZM14.6 14.45C14.4 14.75 14.05 14.85 13.75 14.65C11.4 13.2 8.45 12.9 4.95 13.7C4.6 13.8 4.3 13.55 4.2 13.25C4.1 12.9 4.35 12.6 4.65 12.5C8.45 11.65 11.75 12 14.35 13.6C14.7 13.75 14.75 14.15 14.6 14.45ZM10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C3.85752 17.9997 4.95991 18.7362 6.17317 19.2388C7.38642 19.7413 8.68678 20 10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0Z" fill="rgb(176,180,187)"/>
                </svg>
            </a> -->
            <a target='_blank' href="https://www.apple.com/app-store/">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12.5 2C6.69969 2 2 6.69969 2 12.5C2 18.3003 6.69969 23 12.5 23C18.3003 23 23 18.3003 23 12.5C23 6.69969 18.3003 2 12.5 2ZM8.51562 17.0886C8.45119 17.1985 8.35896 17.2895 8.24821 17.3524C8.13745 17.4154 8.01208 17.4481 7.88469 17.4472C7.75485 17.4483 7.62727 17.4133 7.51625 17.3459C7.43359 17.298 7.3612 17.2343 7.30324 17.1583C7.24528 17.0824 7.20288 16.9957 7.17849 16.9034C7.1541 16.811 7.1482 16.7147 7.16111 16.62C7.17403 16.5254 7.20551 16.4342 7.25375 16.3517L7.97047 15.1602C8.00669 15.0987 8.05836 15.0477 8.12036 15.0123C8.18236 14.977 8.25253 14.9585 8.32391 14.9586H8.42984C8.94969 14.9586 9.31344 15.2712 9.41937 15.5741L8.51562 17.0886ZM14.5836 14.7448L9.89 14.75H6.77047C6.67232 14.7504 6.57511 14.7309 6.48474 14.6926C6.39436 14.6543 6.3127 14.5981 6.24472 14.5273C6.17673 14.4565 6.12384 14.3726 6.08924 14.2808C6.05464 14.1889 6.03906 14.091 6.04344 13.993C6.05844 13.5992 6.40203 13.3011 6.79344 13.3011H9.05469L11.7355 8.73781L10.8673 7.25891C10.6719 6.92188 10.7586 6.4775 11.0938 6.26562C11.1764 6.21219 11.269 6.17601 11.3659 6.15927C11.4629 6.14253 11.5622 6.14557 11.658 6.1682C11.7538 6.19084 11.844 6.23261 11.9232 6.291C12.0024 6.34939 12.069 6.42319 12.1189 6.50797L12.583 7.30062H12.5881L13.0527 6.50797C13.1027 6.42363 13.1691 6.35022 13.2481 6.29213C13.3271 6.23403 13.417 6.19244 13.5124 6.16982C13.6078 6.1472 13.7068 6.14403 13.8034 6.16049C13.9001 6.17695 13.9925 6.21271 14.075 6.26562C14.4083 6.4775 14.4941 6.92188 14.2972 7.26031L13.4291 8.73922L12.5853 10.1778L10.753 13.3025V13.3077H13.4534C13.7919 13.3077 14.2161 13.4895 14.3877 13.782L14.4027 13.8125C14.5541 14.0698 14.6398 14.2466 14.6398 14.5039C14.6374 14.5875 14.6187 14.6698 14.585 14.7463L14.5836 14.7448ZM18.2281 14.75H16.9573V14.7552L17.8864 16.3353C17.9863 16.5017 18.0169 16.7007 17.9716 16.8895C17.9263 17.0782 17.8087 17.2416 17.6441 17.3445C17.53 17.4141 17.3989 17.4509 17.2653 17.4509C17.1383 17.4509 17.0134 17.418 16.9028 17.3554C16.7923 17.2928 16.6998 17.2027 16.6344 17.0938L15.2614 14.7566L14.4083 13.3034L13.3077 11.4219C13.1482 11.1532 13.0616 10.8476 13.0562 10.5353C13.0509 10.2229 13.1271 9.91458 13.2772 9.64062C13.4947 9.25672 13.6611 9.15594 13.6611 9.15594L16.1094 13.2969H18.2145C18.6083 13.2969 18.9463 13.5997 18.9645 13.9883C18.9683 14.0871 18.9521 14.1856 18.9168 14.278C18.8816 14.3704 18.828 14.4546 18.7594 14.5258C18.6907 14.5969 18.6084 14.6535 18.5174 14.692C18.4263 14.7305 18.3284 14.7503 18.2295 14.75H18.2281Z" fill="rgb(176,180,187)"/>
                </svg>
            </a>
            

            <!-- <a target='_blank' href="https://www.wechat.com/">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15.8787 8.33037C16.2623 8.33037 16.6361 8.36148 17 8.41333C16.3311 5.33333 13.2623 3 9.57377 3C5.39344 3 2 5.98667 2 9.66815C2 11.7941 3.13115 13.6711 4.8918 14.8948L3.89836 17L6.61311 15.7659C7.19344 15.9837 7.80328 16.16 8.45246 16.2533C8.36393 15.8489 8.31475 15.4341 8.31475 14.9985C8.30492 11.3274 11.6984 8.33037 15.8787 8.33037ZM12.0918 5.99704C12.2158 5.99704 12.3386 6.02279 12.4532 6.07282C12.5677 6.12285 12.6718 6.19618 12.7595 6.28863C12.8472 6.38107 12.9167 6.49082 12.9642 6.61161C13.0116 6.7324 13.0361 6.86185 13.0361 6.99259C13.0361 7.12333 13.0116 7.25279 12.9642 7.37358C12.9167 7.49436 12.8472 7.60411 12.7595 7.69656C12.6718 7.789 12.5677 7.86233 12.4532 7.91237C12.3386 7.9624 12.2158 7.98815 12.0918 7.98815C11.8414 7.98815 11.6012 7.88326 11.4241 7.69656C11.247 7.50985 11.1475 7.25663 11.1475 6.99259C11.1475 6.72855 11.247 6.47533 11.4241 6.28863C11.6012 6.10193 11.8414 5.99704 12.0918 5.99704ZM7.0459 7.99852C6.79547 7.99852 6.55529 7.89363 6.37821 7.70693C6.20112 7.52022 6.10164 7.267 6.10164 7.00296C6.10164 6.73893 6.20112 6.4857 6.37821 6.299C6.55529 6.1123 6.79547 6.00741 7.0459 6.00741C7.29634 6.00741 7.53651 6.1123 7.7136 6.299C7.89068 6.4857 7.99016 6.73893 7.99016 7.00296C7.99016 7.267 7.89068 7.52022 7.7136 7.70693C7.53651 7.89363 7.29634 7.99852 7.0459 7.99852Z" fill="rgb(176,180,187)"/>
            <path d="M22 14.331C22 11.3855 19.0897 9 15.5 9C11.9103 9 9 11.3855 9 14.331C9 17.2766 11.9103 19.6621 15.5 19.6621C16.0881 19.6621 16.656 19.5791 17.1934 19.4546L20.702 21L19.4852 18.5108C21.0062 17.5359 22 16.0424 22 14.331ZM13.5429 13.9991C13.3504 13.9991 13.1622 13.9407 13.0021 13.8313C12.842 13.7219 12.7172 13.5664 12.6435 13.3845C12.5698 13.2026 12.5506 13.0024 12.5881 12.8092C12.6257 12.6161 12.7184 12.4387 12.8545 12.2994C12.9907 12.1602 13.1641 12.0653 13.353 12.0269C13.5418 11.9885 13.7376 12.0082 13.9154 12.0836C14.0933 12.1589 14.2454 12.2865 14.3523 12.4503C14.4593 12.614 14.5164 12.8065 14.5164 13.0035C14.5265 13.5532 14.0803 13.9991 13.5429 13.9991ZM17.447 13.9991C17.1888 13.9991 16.9412 13.8942 16.7586 13.7075C16.576 13.5208 16.4735 13.2675 16.4735 13.0035C16.4735 12.7394 16.576 12.4861 16.7586 12.2994C16.9412 12.1127 17.1888 12.0078 17.447 12.0078C17.7051 12.0078 17.9527 12.1127 18.1353 12.2994C18.3179 12.4861 18.4204 12.7394 18.4204 13.0035C18.4204 13.2675 18.3179 13.5208 18.1353 13.7075C17.9527 13.8942 17.7051 13.9991 17.447 13.9991Z" fill="rgb(176,180,187)"/>
            </svg>
            </a> -->

            <a target='_blank' href="https://www.facebook.com/">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M22 12.0251C22 6.49123 17.52 2 12 2C6.48 2 2 6.49123 2 12.0251C2 16.8772 5.44 20.9173 10 21.8496V15.0326H8V12.0251H10V9.5188C10 7.58396 11.57 6.01003 13.5 6.01003H16V9.01754H14C13.45 9.01754 13 9.46867 13 10.0201V12.0251H16V15.0326H13V22C18.05 21.4987 22 17.2281 22 12.0251Z" fill="rgb(176,180,187)"/>
            </svg>
            </a>

            <a target='_blank' href="https://www.instagram.com/">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M13.028 2C14.153 2.003 14.7239 2.009 15.2169 2.023L15.4109 2.03C15.6349 2.038 15.8559 2.048 16.1229 2.06C17.1868 2.11 17.9128 2.27799 18.5497 2.52499C19.2097 2.77898 19.7657 3.12297 20.3216 3.67796C20.8301 4.17785 21.2235 4.78252 21.4746 5.44992C21.7216 6.0869 21.8896 6.81289 21.9396 7.87786C21.9516 8.14386 21.9616 8.36485 21.9696 8.58985L21.9756 8.78384C21.9906 9.27583 21.9966 9.84682 21.9986 10.9718L21.9996 11.7178V13.0277C22.002 13.7571 21.9943 14.4865 21.9766 15.2157L21.9706 15.4097C21.9626 15.6347 21.9526 15.8557 21.9406 16.1217C21.8906 17.1866 21.7206 17.9116 21.4746 18.5496C21.2243 19.2174 20.8307 19.8222 20.3216 20.3216C19.8216 20.8299 19.217 21.2233 18.5497 21.4745C17.9128 21.7215 17.1868 21.8895 16.1229 21.9395C15.8856 21.9507 15.6483 21.9607 15.4109 21.9695L15.2169 21.9755C14.7239 21.9895 14.153 21.9965 13.028 21.9985L12.2821 21.9995H10.9731C10.2434 22.0021 9.51372 21.9944 8.78423 21.9765L8.59024 21.9705C8.35286 21.9615 8.11554 21.9512 7.87828 21.9395C6.81433 21.8895 6.08837 21.7215 5.4504 21.4745C4.7831 21.2239 4.17868 20.8304 3.67949 20.3216C3.17056 19.8219 2.77676 19.2172 2.52555 18.5496C2.27856 17.9126 2.11057 17.1866 2.06057 16.1217C2.04943 15.8844 2.03943 15.6471 2.03058 15.4097L2.02558 15.2157C2.00715 14.4865 1.99881 13.7571 2.00058 13.0277V10.9718C1.99779 10.2424 2.00512 9.51302 2.02258 8.78384L2.02958 8.58985C2.03758 8.36485 2.04757 8.14386 2.05957 7.87786C2.10957 6.81289 2.27756 6.0879 2.52455 5.44992C2.77565 4.78184 3.17024 4.17697 3.68049 3.67796C4.17956 3.16945 4.78358 2.77597 5.4504 2.52499C6.08837 2.27799 6.81333 2.11 7.87828 2.06C8.14426 2.048 8.36625 2.038 8.59024 2.03L8.78423 2.024C9.51338 2.00623 10.2428 1.99857 10.9721 2.001L13.028 2ZM12.0001 6.99988C10.6741 6.99988 9.40235 7.52666 8.46471 8.46431C7.52708 9.40198 7.00032 10.6737 7.00032 11.9998C7.00032 13.3258 7.52708 14.5976 8.46471 15.5352C9.40235 16.4729 10.6741 16.9996 12.0001 16.9996C13.3261 16.9997 14.5978 16.4729 15.5354 15.5352C16.4731 14.5976 16.9998 13.3258 16.9998 11.9998C16.9998 10.6737 16.4731 9.40198 15.5354 8.46431C14.5978 7.52666 13.3261 6.99988 12.0001 6.99988ZM12.0001 8.99984C12.394 8.99977 12.7841 9.0773 13.1481 9.228C13.5121 9.3787 13.8428 9.59962 14.1214 9.87814C14.4 10.1567 14.6211 10.4873 14.7719 10.8513C14.9227 11.2152 15.0003 11.6053 15.0004 11.9993C15.0005 12.3932 14.9229 12.7833 14.7723 13.1473C14.6216 13.5113 14.4006 13.8421 14.1221 14.1207C13.8436 14.3993 13.513 14.6203 13.149 14.7711C12.7851 14.922 12.395 14.9996 12.0011 14.9997C11.2055 14.9997 10.4424 14.6836 9.87985 14.121C9.31727 13.5584 9.00122 12.7954 9.00122 11.9998C9.00122 11.2041 9.31727 10.4411 9.87985 9.8785C10.4424 9.3159 11.2055 8.99984 12.0011 8.99984M17.2508 5.49992C16.9193 5.49992 16.6014 5.63161 16.367 5.86603C16.1326 6.10044 16.0009 6.41838 16.0009 6.74989C16.0009 7.0814 16.1326 7.39934 16.367 7.63375C16.6014 7.86817 16.9193 7.99986 17.2508 7.99986C17.5823 7.99986 17.9002 7.86817 18.1346 7.63375C18.369 7.39934 18.5007 7.0814 18.5007 6.74989C18.5007 6.41838 18.369 6.10044 18.1346 5.86603C17.9002 5.63161 17.5823 5.49992 17.2508 5.49992Z" fill="rgb(176,180,187)"/>
            </svg>
            </a>

            <a target='_blank' href="https://www.youtube.com/">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M10 15L15.19 12L10 9V15ZM21.56 7.17C21.69 7.64 21.78 8.27 21.84 9.07C21.91 9.87 21.94 10.56 21.94 11.16L22 12C22 14.19 21.84 15.8 21.56 16.83C21.31 17.73 20.73 18.31 19.83 18.56C19.36 18.69 18.5 18.78 17.18 18.84C15.88 18.91 14.69 18.94 13.59 18.94L12 19C7.81 19 5.2 18.84 4.17 18.56C3.27 18.31 2.69 17.73 2.44 16.83C2.31 16.36 2.22 15.73 2.16 14.93C2.09 14.13 2.06 13.44 2.06 12.84L2 12C2 9.81 2.16 8.2 2.44 7.17C2.69 6.27 3.27 5.69 4.17 5.44C4.64 5.31 5.5 5.22 6.82 5.16C8.12 5.09 9.31 5.06 10.41 5.06L12 5C16.19 5 18.8 5.16 19.83 5.44C20.73 5.69 21.31 6.27 21.56 7.17Z" fill="rgb(176,180,187)"/>
            </svg>
            </a>

            <a target='_blank' href="https://www.tiktok.com/">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="rgb(176,180,187)" d="M10.9428 0.75H11.0572C13.2479 0.74999 14.9686 0.74998 16.312 0.93059C17.6886 1.11568 18.7809 1.50271 19.6391 2.36091C20.4973 3.21911 20.8843 4.31137 21.0694 5.68802C21.25 7.03144 21.25 8.75214 21.25 10.9428V11.0572C21.25 13.2479 21.25 14.9686 21.0694 16.312C20.8843 17.6886 20.4973 18.7809 19.6391 19.6391C18.7809 20.4973 17.6886 20.8843 16.312 21.0694C14.9686 21.25 13.2479 21.25 11.0572 21.25H10.9428C8.7521 21.25 7.03144 21.25 5.68802 21.0694C4.31137 20.8843 3.21911 20.4973 2.36091 19.6391C1.50272 18.7809 1.11568 17.6886 0.93059 16.312C0.74998 14.9686 0.74999 13.2479 0.75 11.0572V10.9428C0.74999 8.75211 0.74998 7.03144 0.93059 5.68802C1.11568 4.31137 1.50272 3.21911 2.36091 2.36091C3.21911 1.50271 4.31137 1.11568 5.68802 0.93059C7.03143 0.74998 8.75214 0.74999 10.9428 0.75ZM13.3077 5.42857C13.3077 4.91574 12.8944 4.5 12.3846 4.5C11.8748 4.5 11.4615 4.91574 11.4615 5.42857V13.3214C11.4615 14.6035 10.4283 15.6429 9.1538 15.6429C7.87934 15.6429 6.84615 14.6035 6.84615 13.3214C6.84615 12.0393 7.87934 11 9.1538 11C9.2667 11 9.3771 11.0081 9.4847 11.0236C9.9893 11.0962 10.457 10.7435 10.5292 10.2358C10.6013 9.7282 10.2508 9.2577 9.7461 9.1851C9.5522 9.1572 9.3544 9.1429 9.1538 9.1429C6.85974 9.1429 5 11.0137 5 13.3214C5 15.6292 6.85974 17.5 9.1538 17.5C11.448 17.5 13.3077 15.6292 13.3077 13.3214V8.69915C14.1074 9.2617 15.0922 9.6071 16.0769 9.6071C16.5867 9.6071 17 9.1914 17 8.67857C17 8.16574 16.5867 7.75 16.0769 7.75C15.421 7.75 14.7034 7.47606 14.1534 7.01397C13.6041 6.55253 13.3077 5.98166 13.3077 5.42857Z" fill="white"/>
            </svg>
            </a>

            <!-- <a target='_blank' href="https://www.weibo.com">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <mask id="mask0_2005_562" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="1" width="21" height="20">
                    <path d="M6.432 8.17383C4.80446 9.80002 1.37077 14.5465 3.90114 17.942C6.432 21.337 13.5963 20.0275 16.554 17.6353C19.5117 15.2435 19.2196 13.7654 18.5786 13.1139C17.9372 12.463 16.0658 13.121 15.5416 12.2348C15.0179 11.3492 16.4746 9.13503 15.233 8.43452C13.992 7.734 11.8485 10.2609 10.8805 9.60437C9.91192 8.94789 11.9459 6.80432 10.8805 6.18687C9.81458 5.56892 8.05953 6.54763 6.432 8.17383Z" fill="rgb(176,180,187)" stroke="rgb(176,180,187)" stroke-linejoin="round"/>
                    <path d="M22 7.79802C21.8891 6.32074 21.2615 4.92969 20.2273 3.86892C19.2244 2.83517 17.8979 2.17567 16.4682 2M19.0372 8C18.974 7.20182 18.6152 6.48297 18.0638 5.94225C17.5033 5.39639 16.7774 5.05227 16 4.96398" stroke="rgb(176,180,187)" stroke-linecap="round"/>
                    <path d="M13 15C13 16.105 11.657 17 10 17C8.343 17 7 16.105 7 15C7 13.895 8.343 13 10 13C11.657 13 13 13.895 13 15Z" fill="black"/>
                    </mask>
                    <g mask="url(#mask0_2005_562)">
                    <path d="M0 0H24V24H0V0Z" fill="rgb(176,180,187)"/>
                    </g>
                </svg>
            </a> -->

        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script defer>
    $(document).ready(function(){
        $("#credit-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>

<script>
    function get_donation_credit_popup(donation_id) {
        console.log(donation_id);

        fetch('./drop-popup.php?id='+donation_id)
        .then(response => response.text())
        .then(response => {
            // console.log(response);
            // setTimeout(function() {
                // Insert Content
                $('#drop-popup-wrapper').html(response);
                // Show Pop Up
                popup('drop-popup');
            // }, 500);
        })
        .catch( err => console.log(err));
    }
</script>

<script defer>
    function updateDateTime() {
        const now = new Date();
        const formattedDate = now.toLocaleString('en-US', {
            month: 'short',
            day: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true,
            timeZone: 'America/New_York' // Explicitly set to EST/EDT
        });

        document.getElementById("currentDateTime").textContent = formattedDate;
    }

    // Update the date and time immediately, then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>



<?php
    include './partials/footer.php';
?>