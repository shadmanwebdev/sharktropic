<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>



<style>
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
        max-width: 220px;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
    }
    .dt-now {
        font-size: 13px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 15px;
        margin-left: 8px;
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
            align-items: start;
        }
        .dt-now {
            font-size: 18px;
            font-weight: 500;
            line-height: 1.35;
            margin-top: 10px;
            margin-left: 8px;
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
    
    .collection-outer {
        padding: 0 10px;
        max-width: 1400px;
        margin: 100px auto;
    }
    .collection {
        max-width: 350px;
        margin: 50px auto;
    }
    .collection-section {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        column-gap: 15px;
        row-gap: 15px;
        padding: 10px;
        max-width: 100%;
        /* margin: 50px auto; */
    }
    .c-item {
        width: 100%;

        position: relative;
        z-index: 2;
        border-radius: 15px;
        overflow: hidden;
        display: grid;
    }
    .thumbnail {
        width: 100%;
        max-height: 160px;
        position: relative;
        z-index: 1;
        border-radius: 15px;
        overflow: hidden;
    }
    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .title {
        width: 100%;
        position: absolute;
        color: #fff;
        z-index: 2;
        align-self: flex-end;
        justify-self: center;
        text-align: center;
        font-weight: 600;
        padding-top: 40px;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%);
    }
    .title p {
        font-size: 15px;
        margin-bottom: 10px;
    }

    @media screen and (min-width: 576px) {
        .collection {
            max-width: 1400px;
            margin: 50px auto;
        }
        .collection-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media screen and (min-width: 768px) {
        .collection-section {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media screen and (min-width: 991px) {
        .collection-section {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    @media screen and (min-width: 1280px) {
        .collection-outer {    
            margin-top: 50px;
        }
        .collection-section {
            grid-template-columns: repeat(6, 1fr);
        }
    }
</style>


<!-- Carousel -->
<style>
    .collection > .owl-nav {
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

    .collection > .owl-nav button {
        cursor: pointer;
        pointer-events: all;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        height: 40px;
        width: 40px;
    }
    .collection > .owl-nav .owl-prev button {
        background: rgba(255, 255, 255, 0);
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-right: 10px;
    }
    .collection > .owl-nav .owl-next button {
        background: yellow;
        border: 1px solid rgba(254, 250, 106, 1);
    }
    
    .collection > .owl-nav button img {
        width: 10px;
    }
    .collection > .owl-nav .owl-next button img {
        transform: rotate(0deg); /* Rotate for the left arrow */
    }

    
    @media screen and (min-width: 1280px) {
        .collection > .owl-nav {
            top: -110px;
            right: 0;
            left: auto;
            margin-left: 0;
            margin-right: 0;
        }
        .collection > .owl-nav button {
            height: 50px;
            width: 50px;
        }
        .collection > .owl-nav button img {
            width: 15px;
        }
    }
</style>


<div class='page-wrapper'>

    <div class='logo-outer'>
        <div class="logo float-left">
            <a href="./">
                <!-- Logo -->
                <img src="assets/logo-new.svg?v=1" alt="" class="img-fluid">
            </a>
            <div class='dt-now'>03/17/2024 1:33am DMV</div>
        </div>

        <div class='section-num'></div>
    </div>

    

    <div class='collection-outer'>

        <div class="collection owl-carousel">
   
            <?php
                // $filenames = [
                //     "winter-drop-1a.jpg", "winter-drop-2a.jpg", "winter-drop-3a.jpg",
                //     "winter-drop-4a.jpg", "winter-drop-5a.jpg", "winter-drop-6a.jpg",
                //     "winter-drop-7a.jpg", "winter-drop-8a.jpg", "winter-drop-9a.jpg",
                //     "winter-drop-10a.jpg", "winter-drop-11a.jpg", "winter-drop-12a.jpg",
                //     "winter-drop-13a.jpg", "winter-drop-14a.jpg", "winter-drop-15a.jpg",
                //     "winter-drop-16a.jpg", "winter-drop-17a.jpg", "winter-drop-18a.jpg",
                //     "winter-drop-19a.jpg", "winter-drop-20a.jpg", "winter-drop-21a.jpg",
                //     "winter-drop-22a.jpg", "winter-drop-23a.jpg", "winter-drop-24a.jpg",
                //     "winter-drop-25a.jpg", "winter-drop-26a.jpg", "winter-drop-27a.jpg",
                //     "winter-drop-28a.jpg"
                // ];

                // foreach ($filenames as $index => $filename) {
                //     echo '<div class="c-item">';
                //     echo '    <div class="thumbnail">';
                //     echo '        <img src="./images/products/' . $filename . '" alt="Thumbnail ' . ($index + 1) . '">';
                //     echo '        <p>Title ' . ($index + 1) . '</p>';
                //     echo '    </div>';
                //     echo '    <div class="title">';
                //     echo '        <p>Winter Drop</p>';
                //     echo '    </div>';
                //     echo '</div>';
                // }

                $product = new MyApp\Classes\Product();
                $product->collection();
            ?>

        </div>

        <?php
            include './partials/bottom-menu.php';
        ?>
    </div>




</div>


    

<script src="js/owl.carousel.min.js"></script>
<script defer>
    var collectionCarousel2 = function () {
        // Initialize news-sections carousel
        $('.collection').owlCarousel({
            center: true,
            items: 1,
            loop: true,
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
    collectionCarousel2();

    
    // Function to update the .section-num element
    function updateSectionNum() {
        setTimeout(() => {
            var dataNum = $('.collection .owl-item.active .collection-section').data('num');
            console.log(dataNum);
            $('.section-num').text(dataNum);
        }, 500);
    }
</script>





<?php
    include './partials/footer.php';
?>