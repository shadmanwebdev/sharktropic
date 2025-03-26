<?php
    include './partials/header.php';
?>




<style>
    
    .collection-container {
        max-width: 95%;
        margin: 0px auto;
        display: grid;
        grid-template-columns: 100%;
    }
    .collection-inner {
        width: 100%;
        margin: 30px auto 0 auto;
        display: grid;
        grid-template-columns: 100%;
        column-gap: 15px;
        row-gap: 15px;
        padding: 10px;
    }
    .collection {
        max-width: 100%;
        margin: 30px auto 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        column-gap: 15px;
        row-gap: 15px;
        padding: 10px;
    }
    .c-item {
        width: 100%;
        position: relative;
        z-index: 2;
        border-radius: 15px;
        overflow: hidden;
        display: grid;
        cursor: pointer;
    }
    .thumbnail {
        width: 100%;
        max-height: 120px;
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
    .c-item:hover .thumbnail img {
        width: 100%;
        height: 100%;
        transform: scale(1.3);
        transition: .4s;
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

    
    .images-wrapper {
        width: 100%;
    height: 350px;
    border-radius: 30px;
    overflow: hidden;
    }
    .images-wrapper .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .images-wrapper .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .images-wrapper .image:hover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.3);
        transition: .4s;
        object-fit: cover;
    }
    .col-bottom {
        padding: 0px 10px 0px 10px;
    }
    .product-title {
        width: 100%;
        padding: 0;
        font-weight: 600;
        margin-bottom: 0px;
    }
    .product-title h2 {
        font-size: 23px;
        font-weight: 600;
        line-height: 1.5;
        margin-top: 35px;
        margin-bottom: 5px;
        color: rgba(255, 255, 255, 1);
    }
    .col-bottom .product-description {
        flex: 0 1 100%;
        padding: 20px 0px 0px 0px;
    }
    .col-bottom .product-description p {
        margin: 0;
        font-weight: 400;
        font-size: 16px;
        line-height: 2;
        letter-spacing: -0.006em;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
    }
    @media screen and (min-width: 576px) {
        .collection-container {
            width: 100%;
        }
        .collection {
            grid-template-columns: repeat(2, 1fr);
        }
        .images-wrapper  {
            width: 100%;
            height: 400px;
        }
    }
    @media screen and (min-width: 768px) {
        .collection-container {
            width: 700px;
        }
        .collection {
            grid-template-columns: repeat(3, 1fr);
        }
        .images-wrapper  {
            width: 100%;
            height: 400px;
        }
        .thumbnail {
            width: 100%;
            max-height: 140px;
        }
    }
    @media screen and (min-width: 991px) {
        .collection-container {
            width: 700px;
        }
        .collection {
            grid-template-columns: repeat(3, 1fr);
        }
        .images-wrapper  {
            width: 100%;
            height: 500px;
        }
    }
    @media screen and (min-width: 1400px) {
        .collection-container {
            width: 1280px;
        }
        .collection-inner {
            width: 1280px;
            margin: 30px auto 0 auto;
            grid-template-columns: 520px calc(100% - (520px + 50px));
            column-gap: 50px;
        }
        .collection {
            width: 100%;
            grid-template-columns: repeat(4, 1fr);
        }
        .images-wrapper {
            width: 520px;
            height: 400px;
        }
        .collection {
            max-width: 100%;
            margin: 0px auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            column-gap: 15px;
            row-gap: 15px;
            padding: 10px;
        }
        .thumbnail {
            width: 100%;
            height: 120px;
        }
    }
 
</style>

<!-- Owl Carousel -->
<style>
    .owl-carousel {
        position: relative;
    }
    .owl-stage-outer {
        height: 100%;
    }
    .owl-stage {
        height: 100%;
    }
    .owl-item {
        height: 100%;
    }
    .owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled {
        display: flex;
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
    
</style>

<style>
    .images-wrapper-outer {
        position: relative;
        z-index: 100;
    }
    .product-details-overlay {
        position: absolute;
        z-index: 100;
        top: 10px;
        left: 10px;
        width: calc(100% - 20px);
        height: calc(100% - 20px);

        padding: 20px;
        color:  #fff;
        background: rgba(35, 46, 66, .72);
        opacity: 0;
        visibility: hidden;
        pointer-events: none; /* Prevents interaction when hidden */
        transition: opacity 0.3s ease, visibility 0s 0.3s;
    }
    /* Initially hide the details */
    .product-details-overlay.hide-details {
        opacity: 0;
        visibility: hidden;
        pointer-events: none; /* Prevents interaction when hidden */
        transition: opacity 0.3s ease, visibility 0s 0.3s;
    }

    /* When mouse is over the image wrapper, show the details */
    .product-details-overlay.display-details {
        opacity: 1;
        visibility: visible;
        pointer-events: auto; /* Allows interaction when visible */
        transition: opacity 0.3s ease, visibility 0s;
    }

    @media screen and (min-width: 768px) {
        .product-details-overlay {
            top: 40px;
            left: 40px;
            width: calc(100% - 80px);
            height: calc(100% - 80px);
        }
    }

</style>


<style>
        
    .stock-theme {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: rgba(255,255,255,0.7);
    }
    
    .stock-status {
        color: rgba(255,255,255,0.7);
    }
    
    .pdt-theme {
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        text-align: left;
        color: rgba(254, 250, 106, 1);    
        margin-bottom: 1rem;
    }
    .product-title {
        margin-top: 0;
    }
    
    .product-title h2 {
        font-size: 28px;
        font-weight: 600;
        color: #ffffff;
        margin-top: 20px;
    }
    
    .pdt-title {
        font-size: 23px;
        color: rgba(255,255,255);
        margin-bottom: 15px;
        font-weight: normal;
    }
    .pdt-serial {
        font-size: 16px;
        color: rgba(255,255,255);
        margin-bottom: 15px;
        font-weight: normal;
    }
    
    .pdt-text p {
        font-size: 16px;
        color: rgba(255,255,255);
        line-height: 1.4;
        margin-bottom: 15px;
    }
</style>


<div class='page-wrapper'>

    <div class='logo-outer'>
        <!-- <div class="logo-container"> -->
            <?php
                include './logo-with-datetime.php';
            ?>

            <style>
                .new-drop-button {
                    display: none;
                    color: white;
                    padding: 15px 60px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 24px;
                    border-radius: 25px;
                    background-color: rgba(255, 255, 255, .1);
                    border: 1px solid rgba(255, 255, 255, .3);
                    margin: 20px;
                }
                @media screen and (min-width: 1280px) {
                    .new-drop-button {
                        display: inline-block;
                    }
                }
            </style>

            <div class="new-drop-button">Shark Week Drops</div>

        <!-- </div> -->
        
        
        <style>
            .pagination-wrapper { 
                margin-top: 30px;
            }
            .page-num-current {
                display: block;
                margin-right: 20px;
                font-size: 25px;
                font-weight: 300;
                color: #fff;
            }
            .page-num.arrow {
                height: 50px;
                width: 50px;
                margin-right: 10px;
                cursor: pointer;
                pointer-events: all;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
            }
            .page-num.arrow.arrow-prev {
                background: rgba(255, 255, 255, 0);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .page-num.arrow.arrow-next {
                background: rgba(254, 250, 106, 1);
                border: 1px solid rgba(254, 250, 106, 1);
                margin-right: 0;
            }


            .pagination > a img {
                width: 15px;
            }
            
            @media screen and (min-width: 1400px) {
                .pagination-wrapper { 
                    margin-top: 0px;
                }
            }
        </style>

        
        <div class='pagination-wrapper'>
            <div class='page-num-current'>
                <span></span>
            </div>
            <div class='pagination'>
                <div>
                    <a class='page-num arrow arrow-prev' onclick="page(event, 'prev')">
                        <img src="assets/heroicons_arrow-up-16-solid.svg" alt="Previous">
                    </a>
                </div>
                <div>
                    <a class='page-num arrow arrow-next' onclick="page(event, 'next')">
                        <img src="assets/arrow-right.svg" alt="Next">
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- 
        1. Single product (slide of product images) 
            displayed on the left
        2. Collection displayed on the right
        3. Ajax request sent when collection item is clicked
            to get single product
    -->

    <div class='collection-container'>
        <?php
            $product_id = $_GET['pid'];
            $product = new MyApp\Classes\Product();
            // $product->collection_new();
            $product->display_product_drop($product_id);
        ?>

    </div>


    <?php
        include './partials/bottom-menu.php';
    ?>


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
</script>

<script defer>

    function page(event, direction) {
        event.preventDefault();

        const curPage = parseInt($('.current-page').val());

        const queryString = `?page=${curPage}&direction=${direction}`;

        fetch(`./get-product-drop.php${queryString}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(response => {
            // console.log(response);
            $('.collection-container').html(response);
            
            pageCarousel();
        });
    }
    

    function single_product(event, pid) {
        event.preventDefault();

        const queryString = `?pid=${pid}`;

        fetch(`./get-product.php${queryString}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(response => { 
            // console.log(response);
            $('.product-images').replaceWith(response);
            
            pageCarousel();
            
        });
    }
</script>


<script defer>
    // Select the image wrapper and the overlay
    const imagesWrapper = document.querySelector('.images-wrapper-outer'); // Replace with the actual class for your image wrapper
    const overlay = document.querySelector('.product-details-overlay');

    // Mouseover event: show the details and remove the hide class
    imagesWrapper.addEventListener('mouseover', () => {
        overlay.classList.add('display-details');
        overlay.classList.remove('hide-details');
    });

    // Mouseout event: hide the details and add the hide class
    imagesWrapper.addEventListener('mouseout', () => {
        overlay.classList.remove('display-details');
        overlay.classList.add('hide-details');
    });
</script>



<?php
    include './partials/footer.php';
?>