<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<?php
    // include './partials/announcement.php';
?>

<?php 
    // include './partials/navigation-2.php'; 
?>

<?php 
    // include './partials/cover-section.php'; 
?>





<style>
    .page-wrapper {
        padding: 20px 20px 50px 20px;
        min-height: 100vh;
        width: 100%;
        background: rgba(29, 37, 52, .8);
    }
    .logo-outer {
        width: 100%;
        padding: 0px 50px 0px 50px;
        margin-bottom: 50px;
    }
    .logo {
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
    }
    .dt-now {
        font-size: 18px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 10px;
        margin-left: 25px;
        color: rgba(255, 255, 255, 1);
    }
    @media screen and (min-width: 576px) { 
        .logo-outer {
            width: 100%;
            padding: 0px 100px 0px 100px;
            margin-bottom: 0px;
        }
 
        .logo {
            display: block;
        }
    }
</style>


<style>
    .about-sections {
        max-width: 1200px;
        margin: 0px auto;
        /* margin: 50px auto; */
    }
    
    .about-sections-title {
        width: 100%;
        padding: 0 25px;
        text-align: center;
        font-weight: 600;
        margin-bottom: 0px;
    }
    .about-sections h2 {
        font-size: 32px;
        font-weight: 600;
        line-height: 1.35;
        margin-top: 35px;
        margin-bottom: 5px;
        color: rgba(255, 255, 255, 1);
    }
    .about-sections .text-row {
        flex: 0 1 100%;
        padding: 20px 20px 50px 20px;
        text-align: center;
    }
    .about-sections .text-row p {
        margin: 0;
        font-weight: 400;
        font-size: 18px;
        line-height: 2;
        letter-spacing: -0.006em;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
    }
    @media screen and (min-width: 576px) { 
        .about-sections .text-row {
            padding: 20px 20px 50px 20px;
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
    </div>

    <div class="about-sections">
        <div class="about-sections-title">
            <h2>About Us</h2>
        </div>

        <div class="text-row">
            <p>April 1994, Supreme opened its doors on Lafayette Street in downtown Manhattan and became the home of New York City skate culture. At its core was a group of neighborhood kids, New York skaters, and local artists who became the store's staff, crew, and customers.</p>
            <p>Supreme grew to embody downtown culture, and play an integral part in its constant regeneration. Skaters, punks, hip-hop heads the young counter culture at large all gravitated toward Supreme. </p>
            <p>While it developed into a downtown institution, Supreme established itself as a brand known for its quality, style, and authenticity. </p>
            <p>Over 30 years, Supreme has expanded from its New York City origins into a global community; working with generations of artists, photographers, designers, musicians, filmmakers, and writers who defied conventions and contributed to its unique identity and attitude.</p>
        </div>
    </div>

    <?php
        include './partials/bottom-menu.php';
    ?>

</div>


    



<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>