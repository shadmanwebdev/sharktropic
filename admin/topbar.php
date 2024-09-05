<style>
    .mobile-elem {
        
        display: flex;
    }
    .desktop-elem {

        display: none;
    }
    @media screen and (min-width: 1200px) {
        .mobile-elem {
            display: none !important;
        }
        .desktop-elem {
            display: flex;
        }
    }
</style>

<div class="col-12 top-bar">

        <div class='page-title' style='color: #fff;'>
            <?php
            
                $pages = array(
                    'index' => 'Dashboard',
                    '' => 'Dashboard',
                    'orders' => 'Orders',
                    'products' => 'Products',
                    'news' => 'News'
                );

                $pagename = get_pagename();

                if (array_key_exists($pagename, $pages)) {
                    echo $pages[$pagename];
                } else {
                    echo 'Page not found';
                }
            ?>
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
                position: relative;
                margin-left: 0px;
            }
            .profile-dropdown {
                width: 240px;
                height: auto;
                background: rgba(47, 64, 95, 1);
                border-radius: 12px;
                padding: 20px;
                color: #ffffff;
                display: flex;
                flex-flow: row wrap;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                // if(isset($_SESSION['user'])) {  
                //     $pht = get_user_photo();

                //     if(!empty($pht)) {
                //         $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$pht}' />";
                //     } else {     
                //         $fname = get_firstname();
                //         $fChar = $fname[0];
                //         $photo = "<div class='user-no-picture' style='font-size: 15px;'>$fChar</div>";
                //     }
                // } else {
                    // $pht = get_user_photo();

                    // if(!empty($pht)) {
                        $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/admin.png' />";
                    // } else {     
                    //     $fname = get_firstname();
                    //     $fChar = $fname[0];
                    //     $photo = "<div class='user-no-picture' style='font-size: 15px;'>$fChar</div>";
                    // }
                // }
                echo $photo;
            }
            
            ?>


        <div class='menu-icons desktop-elem'>
            <?php
                // if(isset($_SESSION['user'])) {          
            ?>

            
                <div class='profile-dropdown-wrapper'>
                    <div class='profile-btn'>
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






        <style>
            .notification-btn {
                display: flex;
                align-items: center;    
                margin-right: 0px;
            }
            .notification-btn .name {
                height: 43px;
                color: #fff;
                display: flex;
                align-items: center;
                margin-right: 15px;
                font-size: 14px;
            }
            .notification-btn .icon {
                display: flex;
                align-items: center;
            }
            .notification-btn .bell {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 43px;
                height: 43px;
                border-radius: 100%;
                overflow: hidden;
                background-color: transparent !important;
            }
            .notification-btn .bell img {
                width: 26px;
                height: 35px;
            }
            .notification-dropdown-wrapper {
                float: right;
                position: relative;
            }
            .notification-dropdown {
                width: 240px;
                height: auto;
                background: rgba(47, 64, 95, 1);
                border-radius: 12px;
                padding: 20px;
                color: #ffffff;
                display: flex;
                flex-flow: row wrap;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: .3s;

                display: none;
                position: absolute;
                z-index: 2;
                right: -20px;
            }
            .notification-dropdown.show-notification-dropdown {
                display: block;
                position: absolute;
                top: 130%;
                z-index: 1000;
            }
            .notification-dropdown .item {
                display: flex;
                align-items: center;
                border-radius: 5px;
                transition: .3s;
                font-weight: 600;
                font-size: 14px;
            }
            .notification-dropdown .item a {
                font-size: 14px;
                color: #fff;
                display: block;
                padding: 10px 20px;
            }
            .notification-dropdown .item:hover {
                background-color: #718AB417;
                cursor: pointer;
            }

            /* Change bell icon color on scroll */
            #header.header-scrolled .bell i {
                color: #000;
            }

            @media screen and (min-width: 1280px) {
                .notification-dropdown-wrapper {
                    margin-left: 20px;
                    margin-top: 0px;
                }
            }
        </style>

    
        <div class='notification-dropdown-wrapper'>
            <div class='notification-btn'>
                <div class='icon' style='width: 38px; height: 38px; cursor: pointer;'>
                    <div class='bell'>
                        <img src='./assets/notification.svg' />
                    </div>
                </div>
            </div>
            <div class='notification-dropdown'>
                <div class='item'>
                    <a href="#">Notification 1</a>
                </div>
                <div class='item'>
                    <a href="#">Notification 2</a>
                </div>
            </div>
        </div>

        <script defer>
            function closeNotificationDropdown() {
                const notificationTrigger = document.querySelector('.notification-btn');
                const notificationDropdown = document.querySelector('.notification-dropdown');
                if (notificationDropdown) {
                    notificationDropdown.classList.remove('show-notification-dropdown');
                }
                if (notificationTrigger) {
                    notificationTrigger.classList.remove('show-notification-dropdown');
                }
            }


            function notificationDropdown() {
                const notificationTrigger = document.querySelector('.notification-btn');
                if (notificationTrigger) {
                    notificationTrigger.addEventListener('click', function () {
                        const notificationDropdown = document.querySelector('.notification-dropdown');
                        if (notificationDropdown) {
                            notificationDropdown.classList.toggle('show-notification-dropdown');
                            notificationTrigger.classList.toggle('show-notification-dropdown');
                        }
                    });
                }
            }

            document.body.addEventListener('click', function (event) {
                const notificationTrigger = document.querySelector('.notification-btn');
                const notificationDropdown = document.querySelector('.notification-dropdown');
                if (notificationTrigger && notificationDropdown) {
                    if (!notificationTrigger.contains(event.target) && !notificationDropdown.contains(event.target)) {
                        closeNotificationDropdown();
                    }
                }
            });

            notificationDropdown();
        </script>

<?php
            include 'search-form.php';
            ?>

    </div>


    <div class='mobile-elem' id="navBtn" onclick='toggleSidebar()'>
        <span></span>
        <span></span>
        <span></span>
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
                notificationDropdown();
                accountPopUpContainer.innerHTML = response;
                popup('accountPopUpContainer');
            })
            .catch(error => console.error('Error fetching messages:', error));  
    }

</script>