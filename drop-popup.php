<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include './functions.php';
    include './Classes/Db.php';
    include './Classes/Donations.php';

    $donations = new MyApp\Classes\Donations();
    $donations->donation_credit_popup($_GET['id']);
?>



<script src="js/owl.carousel.min.js"></script>
<script defer>
    var dropCarousel = function () {
        $('.drop-images').owlCarousel({
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
    dropCarousel();
</script>