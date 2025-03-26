<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    
    include './functions.php';
    include './Classes/Db.php';
    include './Classes/Product.php';

    $product = new MyApp\Classes\Product();
?>



<style>
    /* Reset and base styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: Arial, sans-serif;
    }
    
    .product-card {
        display: flex;
        background-color: #2d2d2d;
        border-radius: 10px;
        overflow: hidden;
        max-width: 800px;
        color: #ffffff;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }
    
    .product-slider-container {
        position: relative;
        width: 45%;
        background-color: #3d3d3d;
    }
    
    .product-slider {
        height: 100%;
    }
    
    .slide {
        height: 100%;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        z-index: 10;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .prev-btn {
        left: 10px;
    }
    
    .next-btn {
        right: 10px;
    }
    
    .product-info {
        padding: 16px 20px;
        width: 55%;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
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
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
    }
    
    .serial-number {
        font-size: 13px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 4px;
        font-weight: normal;
    }
    
    .product-description {
        font-size: 12px;
        color: rgba(255,255,255,0.7);
        line-height: 1.4;
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
        .product-card {
            flex-direction: column;
        }
        
        .product-slider-container,
        .product-info {
            width: 100%;
        }
        
        .product-slider-container {
            height: 300px;
        }
    }
</style>


<div class='popup hide_popup' id='product-popup'>
    <?php
        $product_id = $_GET['pid'];
        $product->my_collection_popup($product_id);
    ?>
</div>




<!-- Include jQuery and Slick JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="lib/slick/slick.min.js"></script>

<script>
    $(document).ready(function(){
        $('.product-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false,
            prevArrow: '<button type="button" class="slick-prev">&#10094;</button>',
            nextArrow: '<button type="button" class="slick-next">&#10095;</button>'
        });
    });
</script>