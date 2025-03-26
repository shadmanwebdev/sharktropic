<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<style>
    .shop-section-outer {
        max-width: 1400px;
        margin: 80px auto;
    }
    @media screen and (min-width: 1280px) {
        .shop-section-outer {
            max-width: 1400px;
            margin: 0px auto;
        }
    }
</style>




<!-- Carousel -->
<style>
    .shop-section > .owl-nav {
        position: absolute;
        top: -60px;
        left: 50%;
        width: 90px;
        margin-left: -45px;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        pointer-events: none;
    }

    .shop-section > .owl-nav button {
        cursor: pointer;
        pointer-events: all;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        height: 40px;
        width: 40px;
    }
    .shop-section > .owl-nav .owl-prev button {
        background: rgba(255, 255, 255, 0);
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-right: 10px;
    }
    .shop-section > .owl-nav .owl-next button {
        background: yellow;
        border: 1px solid rgba(254, 250, 106, 1);
    }
    
    .shop-section > .owl-nav button img {
        width: 10px;
    }
    .shop-section > .owl-nav .owl-next button img {
        transform: rotate(0deg); /* Rotate for the left arrow */
    }

    
    @media screen and (min-width: 1280px) {
        .shop-section > .owl-nav {
            top: -110px;
            right: 0;
            left: auto;
            margin-left: 0;
            margin-right: 0;
        }
        .shop-section > .owl-nav button {
            height: 50px;
            width: 50px;
        }
        .shop-section > .owl-nav button img {
            width: 15px;
        }
    }
    /* @media screen and (min-width: 1200px) {
        .shop-section > .owl-nav {
            top: -100px;
        }
    } */
</style>


<style>
    .owl-carousel .owl-stage-outer  {   
        max-height: 425px; 
        border-radius: 20px;
        overflow: hidden;
    }
    .product { 
        max-height: 425px; 
        position: relative;
    }
    .product-meta {
        padding-top: 80px;
        padding-bottom: 20px;
        position: absolute;
        bottom: 0px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: linear-gradient(180deg, rgba(17, 17, 17, 0) 0%, #000000 100%);
    }
    .product .product-meta img {
        width: 43px !important;
        margin-bottom: 15px;
        height: auto;
    }
    .product .product-meta h4 {
        font-size: 16px;
        color: rgba(255, 255, 255, 1);
    }
    .product .product-meta p {
        font-size: 14px;
        color: rgba(254, 250, 106, 1);
    }

    @media screen and (min-width: 1200px) {
        .owl-carousel .owl-stage-outer {
            min-height: 565px;
            max-height: 565px;
        }
        .product {
            min-height: 565px;
            max-height: 565px;
        }
        .product .image {
            height: 565px;
        }
        .product .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;        
        }
    }

    /* Image */
    .image {
        height: 425px;
    }
    .owl-carousel .owl-item img {
        height: 100%;
        display: block;
        width: 100%;
        object-fit: cover;
    }
</style>


<div class='page-wrapper'>

    <?php
        include './header-with-preview-drop-countdown.php';
    ?>




    <div class='shop-section-outer'>
        <div class='shop-section owl-carousel'>
            <?php
                $product = new MyApp\Classes\Product();
                $product->products();
            ?>
        </div>

        <?php
            include './partials/bottom-menu.php';
        ?>
    </div>




</div>



<script src="js/owl.carousel.min.js"></script>
<script defer>
    var shopCarousel = function () {
        var $carousel = $('.shop-section');
        $carousel.owlCarousel({
            center: false,
            items: 6,
            loop: true,
            stagePadding: -1,
            margin: 0,
            slideBy: 3,
            startPosition: 0,
            autoplay: false,
            pauseOnHover: false,
            dots: false,
            nav: true,
            // animateIn: true, 
            navText: [
                '<button type="button" role="presentation" class="owl-prev"><img src="assets/heroicons_arrow-up-16-solid.svg" alt="Previous"></button>',
                '<button type="button" role="presentation" class="owl-next"><img src="assets/arrow-right.svg" alt="Next"></button>'
            ],
            responsive: {
                0: {
                    items: 1 // Display 1 item on screens smaller than 600px
                },
                500: {
                    items: 2 // Display 1 item on screens smaller than 600px
                },
                600: {
                    items: 3 // Display 3 items on screens between 600px and 900px
                },
                800: {
                    items: 4 // Display 3 items on screens between 600px and 900px
                },
                1200: {
                    items: 6 // Display 6 items on screens larger than 900px
                }
            }
        });
    };
    shopCarousel();
</script>
    





<?php
    include './partials/footer.php';
?>