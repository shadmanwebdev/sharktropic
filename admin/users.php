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


            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Users</h5>
                    </div>
                        
                    <?php
                        $user = new MyApp\Classes\User;
                        $user->users_admin();
                    ?>
                </div>
            </div>



            </div>
        </div>
    </div>



</div>




<?php
    include './footer.php';
?>