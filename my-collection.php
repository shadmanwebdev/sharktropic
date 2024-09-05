<?php
    include './partials/header.php';
?>


    <!-- mCustomScrollbar CSS from CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- mCustomScrollbar JS from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>




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
        
        flex-flow: column nowrap;
        justify-content: space-between;
        align-items: center;
        /* width: 100%;
        padding: 0px 100px 0px 100px; */
    }
    .logo-outer .logo {
        max-width: 220px;
    }
    .dt-now {
        font-size: 13px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 10px;
        margin-left: 25px;
        color: rgba(255, 255, 255, 1);
    }
    @media screen and (min-width: 1280px) {
        .logo-outer {
            flex-flow: row nowrap;
        }
        .section-num {
            font-size: 25px;
            margin-top: 90px;
            margin-right: 160px;
        }
        .logo-outer .logo {
            max-width: 220px;
        }    
        .dt-now {
            font-size: 18px;
        }
    }

</style>


<style>
    .collection-outer {
        max-width: 1200px;
        margin: 0px auto;
    }
    .collection {
        display: flex;
        flex-flow: column nowrap;
        margin-top: 50px;
        margin-bottom: 100px;
    }
    .collection-outer .content-wrapper {
        width: 100%;
        margin-right: 0;
    }
    .collection-outer .content-main {
        width: 100%;
        background: #718AB417;
        border-radius: 16px;
        padding: 20px 20px 50px 20px;
    }
    .collection-outer .content-main > .title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 20px;
        color: #FFFFFF;
    }
    .collection-outer .header {
        color: #fff;
        width: 100%;
        background: #535B69A6;
        height: 50px;
        display: flex;
        align-items: center;
        align-items: center;
        padding: 14px 30px;
        font-size: 16px;
    }
    .collection-outer .header .item:first-child {
        width: 50%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .collection-outer .header .item:nth-child(2) {
        height: 100%;
        width: 25%;
        display: flex;
        align-items: center;
    }
    .collection-outer .header .item:nth-child(3) {
        height: 100%;
        width: 25%;
        display: flex;
        align-items: center;
    }
    .collection-outer .body {
        width: 100%;
        padding: 0px 20px 20px 20px;
    }
    .collection-outer .body .rows .c-row {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #E6EBF31A;
        color: #fff;
    }
    .collection-outer .c-row .item:first-child {
        width: 50%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .collection-outer .c-row .item:first-child .thumbnail {
        border-radius: 10px;
        width: 51px;
        height: 51px;
        overflow: hidden;
        margin-right: 20px;
    }
    .collection-outer .c-row .item:first-child .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .collection-outer .c-row .item:nth-child(2) {
        height: 100%;
        width: 25%;
        display: flex;
        align-items: center;
    }
    .collection-outer .c-row .item:nth-child(3) {
        height: 100%;
        width: 25%;
    }
    
    .content-main {
        max-width: 100%;
    }
    .content-main .content {
        min-width: 700px;
    }


    .my-donation {
        margin-top: 20px;
        width: 100%;
        padding: 15px;
        background: #718AB417;
    }
    .my-donation .title {
        
        font-weight: 600;
        font-size: 20px;
        color: #FFFFFF;
        font-size: 20px;
    }
    .my-donation .image-wrapper {
        width: 50%;
        height: auto;
        margin: 20px auto;
    }
    .my-donation .image-wrapper img {
        width: 100%;
        height: auto;
    }
    .my-donation .middle {
        text-align: center;
    }
    .my-donation .middle h2 {
        font-size: 26px;
        color: #FFFFFF;
    }
    .my-donation .middle p {
        font-size: 16px;
        color: #FEFA6A;
    }
    @media screen and (min-width: 768px) {  
        .content-main {
            overflow-x: visible;
        }
        .my-donation .image-wrapper {
            width: 30%;
        }
    } 
    @media screen and (min-width: 1280px) {   
        .collection {
            display: flex;
            flex-flow: row nowrap;
            margin-top: 50px;
            margin-bottom: 100px;
        }
        .collection-outer .content-wrapper {
            width: 68%;
            margin-right: 2%;
        }
        .my-donation {
            width: 30%;
            margin-top: 0px;
        }
        .my-donation .image-wrapper {
            width: 70%;
        }
    }
</style>


<style>
    /* Custom scrollbar styles */
    .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
        background-color: #3498db; /* Custom color for the scrollbar */
    }
    .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,
    .mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar {
        background-color: #2980b9; /* Custom color for hover and active states */
    }
</style>



<style>
    /* Custom CSS for the content and scrollbar */
    .content-main {
        width: 100%;
        overflow-y: hidden;
    }
</style>
<script defer>
    $(document).ready(function(){
        $(".content-main").mCustomScrollbar({
            axis: "x", // Enable horizontal scrolling only
            theme: "minimal"
        });
    });
</script>




<!-- Bottom Menu -->
<style>
    .bottom-menu {
        margin-top: 100px;
    }
    .bottom-menu .inner-div {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        border-top: 1px solid rgba(255, 255, 255, .2);
    }
    .bottom-menu ul {
        margin: 0;
        padding: 0;
        display: flex;
        flex-flow: row nowrap;
    }
    .bottom-menu ul.list-1 {
        justify-content: flex-start;
    }
    .bottom-menu ul.list-2 {
        justify-content: flex-end;
    }
    .bottom-menu ul > li {
        white-space: nowrap;
        margin-right: 30px;
    }
    .bottom-menu ul > li:last-child {
        white-space: nowrap;
        margin-right: 0px;
    }
    .bottom-menu ul > li > a {
        display: block;
        color: #FFFFFF;
        font-size: 20px;
        font-weight: 300;
        padding: 20px 2px 0 2px;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .bottom-menu ul > li.active > a {
        font-weight: 700;
        color: #FEFA6A;
        border-top: 2px solid #FEFA6A;
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

        
        
        
        <!-- Profile dropdown -->
        <style>
            .profile-btn {
                /* padding-top: 5px; */
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .profile-btn .name {
                /* width: 120px; */
                height: 43px;
                color: #fff;
                display: flex;
                align-items: center;
                margin-right: 15px;
                font-size: 14px;
            }
            .profile-btn .avatar {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .profile-btn .picture {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                width: 43px;
                height: 43px;
                -webkit-border-radius: 100%;
                border-radius: 100%;
                overflow: hidden;
                color: #fff;
                background-color: rgb(255,145,77) !important;
            }
            .profile-btn .user-no-picture {
                font-size: 40px;
                width: 100%;
                height: 100%;
                /* background-color: rgb(255,145,77); */
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                -webkit-border-radius: 100%;
                border-radius: 100%;
                overflow: hidden;
                color: #fff;
            }
            .profile-dropdown-wrapper {
                float: right;
                /* width: 38px; */
                position: relative;
                margin-left: 0px;
                margin-top: 50px;
                /* min-width: 100px; */
            }
            .profile-dropdown {
                width: 240px;
                height: auto;
                -webkit-border-radius: 24px;
                border-radius: 16px;
                /* display: block; */
                /* background-color: #fff; */
                background: #718AB417;
                -webkit-transition: all 0.3s ease;
                transition: all 0.3s ease;
                padding: 15px 10px;
                /* border: 1px solid #d9d9d9; */
                border: 1px solid #E6EBF31A;
                transition: .3s;

                display: none;
                position: absolute;
                z-index: 2;
                right: -20px;
            }
            .profile-dropdown.show-profile-dropdown {
                display: block;
                position: absolute;
                top: 130%;
                z-index: 1000;
            }
            .profile-dropdown .item {
                display: flex;
                align-items: center;
                border-radius: 5px;
                transition: .3s;
                font-weight: 600;
                font-size: 14px;
            }
            .profile-dropdown .item a {
                font-size: 14px;
                color: #fff;
                display: block;
                padding: 0;
                padding: 10px 20px 10px 20px;
            }
            .profile-dropdown .item:hover {
                background-color: #718AB417;
                cursor: pointer;
            }
            .profile-dropdown .item:hover a {
                color: #fff;
            }

            

            /* Change user icon color on scroll */
            #header.header-scrolled .picture i  {
                color: #000;
            }


            @media screen and (min-width: 1280px) {
                .profile-dropdown-wrapper {
                    margin-left: 20px;
                    margin-top: 0px;
                }
            }
        </style>



        <?php
            function profile_image() {
                if(isset($_SESSION['user'])) {  
                    $pht = get_user_photo();

                    if(!empty($pht)) {
                        $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$pht}' />";
                    } else {     
                        $fname = get_fullname();
                        $fChar = $fname[0];
                        $photo = "<div class='user-no-picture' style='font-size: 15px;'>$fChar</div>";
                    }
                } else {
                    // $pht = get_user_photo();

                    // if(!empty($pht)) {
                        $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/admin.png' />";
                    // } else {     
                    //     $fname = get_firstname();
                    //     $fChar = $fname[0];
                    //     $photo = "<div class='user-no-picture' style='font-size: 15px;'>$fChar</div>";
                    // }
                }
                echo $photo;
            }
            
        ?>




        <?php
            // if(isset($_SESSION['user'])) {          
        ?>

            <div class='menu-icons'>
                <div class='profile-dropdown-wrapper'>
                    <div class='profile-btn'>
                        <div class='name'><?= $fullname = get_fullname(); ?></div>
                        <div class='avatar' style='width: 38px; height: 38px; cursor: pointer;'>
                            <div class='picture'>
                                <?php
                                    profile_image();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class='profile-dropdown'>
                        <div class='item'>
                            <a onclick='user_account_popup(event)'>My Account</a>
                        </div>
                        <div class='item'>
                            <a href="./controllers/logout-handler">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php     
            // }
        ?>


        <!-- Profile Dropdown -->
        <script defer>
            function closeProfileDropdown() {
                const profileTrigger = document.querySelector('.profile-btn');
                const profileDropdown = document.querySelector('.profile-dropdown');
                if(profileDropdown && profileDropdown != null) {
                    if (profileDropdown.classList.contains('show-profile-dropdown')) {
                        profileDropdown.classList.remove('show-profile-dropdown');
                    }
                } else {
                    console.log('profile dropdown not found');
                }
                if(profileTrigger && profileTrigger != null) {
                    if (profileTrigger.classList.contains('show-profile-dropdown')) {
                        profileTrigger.classList.remove('show-profile-dropdown');
                    }
                } else {
                    console.log('profile button not found');
                }
            }
            function profileDropdown() { 
                const profileTrigger = document.querySelector('.profile-btn'); 
                if(profileTrigger && profileTrigger != null) {
                    profileTrigger.addEventListener('click', function (event) {
                        const profileDropdown = document.querySelector('.profile-dropdown');      
                        if(profileDropdown && profileDropdown != null) {
                            if (profileDropdown.classList.contains('show-profile-dropdown')) {
                                profileTrigger.classList.remove('show-profile-dropdown');
                                profileDropdown.classList.remove('show-profile-dropdown');
                            } else {
                                profileTrigger.classList.add('show-profile-dropdown');
                                profileDropdown.classList.add('show-profile-dropdown');
                            }
                        }
                    });
                }
            }
            
            const body = document.querySelector('body'); 
            body.addEventListener('click', function (event) {
                const profileTrigger = document.querySelector('.profile-btn'); 
                const profileDropdown = document.querySelector('.profile-dropdown');
                if(
                    profileTrigger && profileTrigger != null &&
                    profileDropdown && profileDropdown != null
                ) { 
                    // Check if the target is not the element or a descendant
                    if (!profileTrigger.contains(event.target) && !profileDropdown.contains(event.target)) {
                        // Close the dropdown
                        closeProfileDropdown();
                    }
                }
            });

            profileDropdown();
        </script>


            
    </div>

    <div class='collection-outer'>
        <div class='collection'>
            <div class="content-wrapper">
                <div class="content-main">
                    <div class="title">My Products</div>
                    <div class="content">
                        <div class="header">
                            <div class="item">Name</div>
                            <div class="item">Price</div>
                            <div class="item">Donate(%)</div>
                        </div>
                        <div class="body">
                            <div class="rows">
                                <?php
                                    $order = new MyApp\Classes\Order;
                                    $order->my_collection();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $order->my_donation();
            ?>

        </div>
        

        <?php
            include './partials/bottom-menu.php';
        ?>

    </div>




</div>

    

<script defer>
    function user_account_popup(event) {
        event.preventDefault();
        const accountPopUpContainer = document.getElementById('accountPopUpContainer');

        fetch(`./my-account-popup.php`)
            .then(response => response.text())
            .then(response => {
                closeProfileDropdown();
                accountPopUpContainer.innerHTML = response;
                popup('accountPopUpContainer');
            })
            .catch(error => console.error('Error fetching messages:', error));  
    }

</script>


<script defer>
    function update_account(event) {
        event.preventDefault();
        var formData = new FormData();

        const update_user = $('#update_user').val();
        const name = $('#name-field-1').val();
        const email = $('#email-field-3').val();
        const password = $('#pwd-field-2').val();
        const photo = $('input#image')[0].files[0];
        

        // console.log(email, password);

        if(
            name && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
        ) {

            $('#name-wrapper-1').removeClass('invalid');
            $('#name-error-1').html('');
            $('#email-wrapper-3').removeClass('invalid');
            $('#email-error-3').html('');
            $('#pwd-wrapper-2').removeClass('invalid');
            $('#pwd-error-2').html('');

            formData.append('update_user', update_user);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('photo', photo);

            fetch('./controllers/user-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    console.log(response);

                    if($.trim(response) == '1') {
                        $('#message-response-1').html("<div class='success'>Profile Updated!</div>");
                    } else {
                        $('#message-response-1').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Name error
            if(name) {
                $('#name-error-1').html('');
                $('#name-wrapper-1').removeClass('invalid');
            } else {
                $('#name-error-1').html('<div>The Name field is required</div>');
                $('#name-wrapper-1').addClass('invalid');
            }
            // Email error
            if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                $('#email-error-3').html('');
                $('#email-wrapper-3').removeClass('invalid');
            } else {
                if(email) {
                    $('#email-error-3').html('<div>Please enter a valid email address</div>');
                    $('#email-wrapper-3').addClass('invalid');
                } else {
                    $('#email-error-3').html('<div>The Email field is required</div>');
                    $('#email-wrapper-3').addClass('invalid');
                }
            }
            // Password error
            if(password) {
                $('#pwd-error-2').html('');
                $('#pwd-wrapper-2').removeClass('invalid');
            } else {
                $('#pwd-error-2').html('<div>The Password field is required</div>');
                $('#pwd-wrapper-2').addClass('invalid');
            }
        }
    }

</script>


<?php
    include './partials/footer.php';
?>