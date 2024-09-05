<?php
    include './header.php';
    // require 'vendor/autoload.php';
?>

<style>
    .card {
        max-width: 900px;
    }
    @media screen and (max-width: 576px) {
        .card {
            max-width: 90%;
        }
        .d-none {
            display: none;
        }
    }
</style>






<!-- DELETE POPUP -->
<div id='deletePopup' class='hide_popup popup'>
    
</div>









<div class='wrapper'>

    <?php
        include './sidebar.php';
    ?>

    <div class='main'>
        <?php
            include './topbar.php';
        ?>
        <div class='admin-form-outer'>
            <div class='admin-form-wrapper'>

                    

                <?php
                    $user = new MyApp\Classes\User;
                    $user->user_details($_GET['uid']);
                ?>

                   
 



            </div>
        </div>
    </div>



</div>



<?php
    include './footer.php';
?>
