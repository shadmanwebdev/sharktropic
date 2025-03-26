<?php
    include './partials/header.php';
?>


    <!-- pic-wrap mCustomScrollbar CSS from CDN expand-arrow collection -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- mCustomScrollbar JS from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>




<style>
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
        margin-left: 8px;
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
        
        <?php
            include './logo-with-datetime.php';
        ?> 
        
        
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



    <link rel="stylesheet" href="lib/slick/slick.css">
    <link rel="stylesheet" href="lib/select2/select2.min.css">

    <style>
        #product-popup {
            padding: 30px;
            background: #394152;
            top: 20px;
            margin-top: 0;
            left: 50%;
            border-radius: 25px;

            
            width: 95%;
            margin-left: -47.5%;
        }
        .pic-wrap.pos-relative {
            height: 200px;
        }
        @media (min-width: 768px) {
            #product-popup {
                width: 500px;
                margin-left: -250px;
            }
            .pic-wrap.pos-relative {
                height: 200px;
            }
        }
        @media (min-width: 1200px) {
            #product-popup {
                padding: 30px;
                top: 20px;
                width: 900px;
                margin-left: -450px;
            }
            .pic-wrap.pos-relative {
                height: 350px;
            }
        }
    </style>


    <!-- Slick arrow -->
    <style>
        .slick-slider {
            position: relative;
        }
        .arrow-wrapper {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            pointer-events: none;

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
        .prev-slick3 {
            top: 0;
            left: 0;
            z-index: 5;
        }
        .next-slick3 {
            top: 0;
            right: 0;
            z-index: 5;
            transform: rotate(-180deg);
        }
        img.arrow-img {
            width: 20px;
        }
    </style>
    
	<style>
		.pdt-sold {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            text-align: left;
            color: #FFFFFF;

		}
		.pdt-serial {
			font-size: 18px;
			font-weight: 600;
            color:rgb(125, 157, 175);
			margin-bottom: 10px;
		}
		.pdt-name {
			font-size: 25px;
			line-height: 1.5;
			color: #fff;
			margin-bottom: 20px;
		}
		.pdt-text {
			padding-top: 23px;
		}
		.pdt-text p {
			font-size: 16px;
			line-height: 1.7;
			color: rgba(255, 255, 255, 0.8);
		}
		.pdt-price {
			display: flex;
			flex-flow: row nowrap;
			align-items: center;
		}
		.sale-price {
			font-size: 30px;
			line-height: 1.388888;
			margin-right: 10px;
		}
		.regular-price {
			font-size: 23px;
			line-height: 1.388888;
			text-decoration: line-through;
		}
		/* label */
		.input-label {
			width: 105px;
			justify-content: center;
			-ms-align-items: center;
			align-items: center;
		}
		/* select */
		.select-wrapper {
			width: calc(100% - 105px);
			border: 1px solid #e6e6e6;
		}
		.p-b-10, .p-tb-10, .p-all-10 {
			padding-bottom: 10px;
		}
		.size-203 {
			width: 105px;
		}
	  	.btns-group-bottom {
			display: flex; 
			flex-flow: column nowrap; 
		}
      	/* Number input */
	  	.wrap-num-product {
			width: 140px;
			height: 45px;
			border: 1px solid #e6e6e6;
			border-radius: 3px;
			overflow: hidden;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type=number]{
			-moz-appearance: textfield;
		}
		.m-r-20, .m-lr-20, .m-all-20 {
			margin-right: 20px;
		}
		.cl8 {
			color: #555;
		}

		.btn-num-product-up, .btn-num-product-down {
			width: 45px;
			height: 100%;
			cursor: pointer;
			background-color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		input.num-product {
			-moz-appearance: textfield;
			appearance: none;
			-webkit-appearance: none;
			border: none;
			outline: none;
		}

		.mtext-104 {
			font-size: 16px;
			line-height: 1.6;
		}
		.cl3 {
			color: #666;
		}
		.num-product {
			width: calc(100% - 90px);
			height: 100%;
			border-left: 1px solid #e6e6e6;
			border-right: 1px solid #e6e6e6;
			background-color: #f7f7f7;
		}
		.txt-center {
			text-align: center;
		}
		.wrap-num-product  {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			/* width: 100%; */
			
			flex-wrap: wrap;

			margin-top: 10px;
			margin-bottom: 10px;
			margin-right: 20px;

			width: 140px;
			height: 45px;
			overflow: hidden;

			border-width: 1px 1px 1px 1px;
			border-style: solid;
			border-color: #F0F0F0;
			background: transparent;
			border-radius: 1000px;
		}
		.btn-num-product-up, .btn-num-product-down {
			background: transparent;
		}
		.btn-num-product-up {
			border-left: 1px solid #F0F0F0;
		}
		.btn-num-product-down {
			border-right: 1px solid #F0F0F0;
		}
		input.num-product {
			background: transparent;
			color: #fff;
		}
		.btns {
			display: flex;
			flex-direction: row;
			margin-top: 20px;
		}
		.add-to-cart-btn {
			font-size: 16px;
			width: 145px;
			height: 50px;
			padding: 16px 20px 16px 20px;
			gap: 10px;
			border-radius: 1000px;
			border: 1px solid #FFFFFF4D;
			margin-right: 10px;
			cursor: pointer;

			display: flex;
			align-items: center;
			justify-content: center;
		}
		.buy-now-btn {
			font-size: 16px;
			width: 145px;
			height: 50px;
			padding: 16px 20px 16px 20px;
			gap: 10px;
			border-radius: 1000px;
			background: #FEFA6A;
			border: 1px solid #FEFA6A;
			color: #111111;
			font-weight: 600;
			cursor: pointer;

			display: flex;
			align-items: center;
			justify-content: center;
		}


		.error-text {
            color: #ff6060;
            font-size: 12px;
            line-height: 20px;
            padding: 15px 0 15px;
        }

		@media screen and (min-width: 1280px) {
			.shop-section-outer {
				max-width: 1400px;
				margin: 0px auto;
			}
			.btns-group-bottom {
				display: flex;
				flex-direction: row;
			}
			.btns {
				margin-top: 10px;
			}
		}
	</style>

    <style>
		.expand-arrow {
			display: none;
		}
      	/* flex */
      	.flex-r-m {
			justify-content: flex-end;
			-ms-align-items: center;
			align-items: center;
		}
		.flex-sb {
			justify-content: space-between;
		}
		.flex-w {
			-webkit-flex-wrap: wrap;
			-moz-flex-wrap: wrap;
			-ms-flex-wrap: wrap;
			-o-flex-wrap: wrap;
			flex-wrap: wrap;
		}
		.flex-w, .flex-l, .flex-r, .flex-c, .flex-sa, .flex-sb, .flex-t, .flex-b, .flex-m, .flex-str, .flex-c-m, .flex-c-t, .flex-c-b, .flex-c-str, .flex-l-m, .flex-r-m, .flex-sa-m, .flex-sb-m, .flex-col-l, .flex-col-r, .flex-col-c, .flex-col-str, .flex-col-t, .flex-col-b, .flex-col-m, .flex-col-sb, .flex-col-sa, .flex-col-c-m, .flex-col-l-m, .flex-col-r-m, .flex-col-str-m, .flex-col-c-t, .flex-col-c-b, .flex-col-c-sb, .flex-col-c-sa, .flex-col-l-sb, .flex-col-r-sb, .flex-row, .flex-row-rev, .flex-col, .flex-col-rev, .dis-flex {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			/* width: 100%; */
		}


		
    </style>


	<!-- SLICK SLIDER -->
	<style>
		
		@media (min-width: 1400px) {
			.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
				max-width: 1140px;
			}
		}
		.slick-slide img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		.wrap-slick3 {
			display: flex;
			flex-flow: column-reverse nowrap;
			position: relative;
		}

		.slick3 {
			width: 100%;
			overflow: hidden;
            border-radius: 25px;
		}
		.item-slick3.slick-active {
			width: 100%;
		}
		.pic-wrap.pos-relative {
			object-fit: cover;
		}
		button {
			outline: none;
			border: none;
			background: transparent;
			cursor: pointer;
		}


		/* Bottom Images */
		.wrap-slick3-dots {
			width: 100%;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		ul.slick3-dots {
			display: flex;
			flex-flow: row nowrap;
			column-gap: 10px;    
			border-radius: 0 0 25px 25px;
			overflow: hidden;
			padding-left: 0;
			margin-bottom: 0;
		}
		.slick3-dots li {
			display: block;
			position: relative;
			width: 100%;
			max-width: 100px;
			height: 100px;
			margin-bottom: 0;
		}
		.slick3-dots li img {
			width: 100%;
    		height: 100%;
			object-fit: cover;
		}
		.slick3-dot-overlay {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			cursor: pointer;
			border: 2px solid transparent;
			-webkit-transition: all 0.4s;
			-o-transition: all 0.4s;
			-moz-transition: all 0.4s;
			transition: all 0.4s;
		}
		.slick3-dot-overlay:hover {
			border-color: #ccc;
		}
		.slick3-dots .slick-active .slick3-dot-overlay {
			border-color: transparent;
		}
	</style>






    <div class='popup-wrapper'>

    </div>




    <script src="lib/select2/select2.min.js?v=5"></script>
    <script src="lib/slick/slick.min.js?v=5"></script>
    <script src="js/slick-custom.js?v=7"></script>

    
    <script defer>

        $(document).ready(function() {
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            });
        });



        $('.btn-num-product-down').on('click', function(){
            var numProduct = Number($(this).next().val());
            if(numProduct > 0) $(this).next().val(numProduct - 1);
        });

        $('.btn-num-product-up').on('click', function(){
            var numProduct = Number($(this).prev().val());
            $(this).prev().val(numProduct + 1);
        });


        // $('.qty-down').on('click', function(){
        // 	var numProduct = Number($(this).next().text());
        // 	if(numProduct > 0) $(this).next().text(numProduct - 1);
        // });

        // $('.qty-up').on('click', function(){
        // 	var numProduct = Number($(this).prev().text());
        // 	$(this).prev().text(numProduct + 1);
        // });

        </script>

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
                    $donations = new MyApp\Classes\Donations;
                    $donations->donations_widget();
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





<!-- Product Popup -->
<script defer>
    function slick_slider_3() {
        $('.wrap-slick3').each(function(){
            $(this).find('.slick3').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 6000,

                arrows: true,
                // appendArrows: $(this).find('.wrap-slick3-arrows'),
                prevArrow:"<div class='arrow-wrapper arrow-slick3 prev-slick3 '><img class='arrow-img filter-wh' src='assets/heroicons_arrow-up-16-solid.svg' alt='' /></div>",
                nextArrow:"<div class='arrow-wrapper arrow-slick3 next-slick3 '><img class='arrow-img filter-wh' src='assets/heroicons_arrow-up-16-solid.svg' alt='' /></div>",

                dots: true,
                appendDots: $(this).find('.wrap-slick3-dots'),
                dotsClass:'slick3-dots',
                customPaging: function(slick, index) {
                    var portrait = $(slick.$slides[index]).data('thumb');
                    console.log(portrait);
                    return '<img src="' + portrait + '"/><div class="slick3-dot-overlay"></div>';
                },  
            });
        });
    }
    function get_product_popup(event, pid) {
        event.preventDefault();

        const queryString = `?pid=${pid}`;

        fetch(`./get-product-popup.php${queryString}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(response => { 
            // console.log(response);
            $('.popup-wrapper').html(response);

            
            slick_slider_3();

            $('#product-popup').addClass('show_popup');
            $('#popBg').removeClass('light');
            $('#popBg').addClass('dark');
        });
    }
</script>


<?php
    include './partials/footer.php';
?>