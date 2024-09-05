<?php
    include './partials/header.php';
?>







<style>
    .page-wrapper {
        padding: 20px 20px 50px 20px;
        min-height: 100vh;
        width: 100%;
        background: rgba(29, 37, 52, .8);
    }

    .logo-outer {
        max-width: 1440px;
        margin: 0px auto 50px auto;
        display: flex;
        /* text-align: center; */
        flex-flow: column nowrap;
        justify-content: space-between;
        align-items: center;
    }
    .logo-outer .logo {
        max-width: 250px;
        margin-left: -20px;
    }
    .dt-now {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 15px;
        margin-left: 35px;
        color: rgba(255, 255, 255, 1);
    }

    .section-num {
        display: none;
        font-size: 25px;
        font-weight: 300;
        color: #fff;    
        margin-top: 55px;
        margin-right: 95px;
        /* margin-bottom: 120px; */
    }
    @media screen and (min-width: 1280px) {
        .logo-outer {
            max-width: 1440px;
            margin: 0px auto 50px auto;
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
            /* width: 100%;
            padding: 0px 100px 0px 100px; */
        }
        .logo-outer .logo {
            max-width: 300px;
            margin-left: 0px;
        }
        .dt-now {
            font-size: 18px;
            font-weight: 500;
            line-height: 1.35;
            margin-top: 10px;
            margin-left: 25px;
            color: rgba(255, 255, 255, 1);
        }

        
        .section-num {
            display: block;
            
            margin-top: 74px;

            margin-right: 160px;
        }
    }
</style>


<style>
    .news-outer {
        max-width: 1400px;
        margin: 0px auto;
    }
    .news-sections {
        max-width: 1400px;
        margin: 0px auto;
        margin-top: 100px;
        /* margin: 50px auto; */
    }
    
    .news-section {
        display: flex;
        flex-flow: column nowrap;
    }
    .news-section .col-right {
        margin-left: 0px;
    }
    .news-section .images-wrapper {
        width: 100%;
        height: 100%;
        border-radius: 30px;
        overflow: hidden;
    }
    .news-section .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .news-section .images-wrapper .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .news-section-title {
        width: 100%;
        padding: 0;
        font-weight: 600;
        margin-bottom: 0px;
    }
    .news-section h2 {
        font-size: 23px;
        font-weight: 600;
        line-height: 1.5;
        margin-top: 35px;
        margin-bottom: 5px;
        color: rgba(255, 255, 255, 1);
    }
    .news-section .text-row {
        flex: 0 1 100%;
        padding: 20px 0px 50px 0px;
    }
    .news-section .text-row p {
        margin: 0;
        font-weight: 400;
        font-size: 16px;
        line-height: 2;
        letter-spacing: -0.006em;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
    }

    @media screen and (min-width: 576px) {
        .news-section .images-wrapper {
            width: 100%;
            height: 543px;
            border-radius: 30px;
        }
        .news-section h2 {
            font-size: 32px;
        }
        /* .news-section .col-right {
            margin-left: 30px;
        }
        .news-section h2 {
            margin-top: 0px;
        } */
    }
    @media screen and (min-width: 1280px) {    
        .news-sections {
            margin-top: 0px;
        }
    
        .news-section {
            display: flex;
            flex-flow: row nowrap;
        }
        .news-section .col-right {
            margin-left: 80px;
        }
        .news-section .images-wrapper {
            width: 538px;
            height: 543px;
            border-radius: 30px;
        }
        .news-section h2 {
            margin-top: 35px;
        }
    }
</style>

<!-- Carousel -->
<style>
    .owl-carousel {
        position: relative;
    }
    .images-wrapper > .owl-nav {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        pointer-events: none;
    }

    .images-wrapper > .owl-nav button {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        cursor: pointer;
        pointer-events: all;
        height: 100%;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        padding: 20px;
    }
    .images-wrapper > .owl-nav .owl-prev button {
        top: 0;
        left: 0;
    }
    .images-wrapper > .owl-nav .owl-next button {
        top: 0;
        right: 0;
    }
    .images-wrapper > .owl-nav button img {
        width: 20px;
    }
    .images-wrapper > .owl-nav .owl-next button img {
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

<div class='page-wrapper'>

    <div class='logo-outer'>
        <div class="logo float-left">
            <a href="./">
                <!-- Logo -->
                <img src="assets/logo.png?v=1" alt="" class="img-fluid">
            </a>
            <div class='dt-now'>03/17/2024 1:33am DMV</div>
        </div>

        
        <div class='section-num'>
            <?php
                $news = new MyApp\Classes\News();
                $news->news_slide_count();
            ?>
        </div>
    </div>

    <div class='news-outer'>
        
        <?php
            $news->news();
        ?>

        <?php
            include './partials/bottom-menu.php';
        ?>
    </div>



</div>

<script src="js/owl.carousel.min.js"></script>
<script defer>
    var pageCarousel = function () {
        $('.images-wrapper').owlCarousel({
            center: true,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            smartSpeed: 1000,
            autoplay: false,
            pauseOnHover: false,
            nav: true,
            navText: [
                '<button type="button" role="presentation" class="owl-prev"><img src="assets/heroicons_arrow-up-16-solid.svg" alt="Previous"></button>',
                '<button type="button" role="presentation" class="owl-next"><img src="assets/heroicons_arrow-up-16-solid.svg" alt="Next"></button>'
            ]
        });
    };
    pageCarousel();
    var pageCarousel2 = function () {
        // Initialize news-sections carousel
        $('.news-sections').owlCarousel({
            center: true,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            smartSpeed: 1000,
            autoplay: false,
            pauseOnHover: false,
            nav: true,
            navText: [
                '<button onclick="updateSectionNum()" type="button" role="presentation" class="owl-prev"><img src="assets/heroicons_arrow-up-16-solid.svg" alt="Previous"></button>',
                '<button onclick="updateSectionNum()" type="button" role="presentation" class="owl-next"><img src="assets/arrow-right.svg" alt="Next"></button>'
            ]
        });

    };
    pageCarousel2();

    
    // Function to update the .section-num element
    function updateSectionNum() {
        setTimeout(() => {
            var dataNum = $('.news-sections .owl-item.active .news-section').data('num');
            console.log(dataNum);
            $('.section-num').text(dataNum);
        }, 500);
    }
</script>
    



<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>