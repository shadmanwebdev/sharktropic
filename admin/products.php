<?php
    include './header.php';
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


<style>
    .popup {
        background: #2F405F;
        color: #fff;
        box-shadow: 0px 4px 10px 0px #0000001A;
    }
    @media screen and (min-width: 576px) {
    }
</style>





<!-- DELETE POPUP -->
<div id='deletePopup' class='hide_popup popup'>
    
</div>




<script defer>
    function get_popup_content_edit(id) {
        // console.log(id);
        closePopup();

        fetch('./edit-product-popup?type=product&id='+id)
        .then(response => response.text())
        .then(response => {
            // console.log(response);
            // setTimeout(function() {
                // Insert Content
                $('#deletePopup').html(response);
                // Show Pop Up
                popup('deletePopup');
            // }, 500);
        })
        .catch( err => console.log(err));
    }
    function get_popup_content_add() {
        closePopup();

        fetch('./add-product-popup?type=product')
        .then(response => response.text())
        .then(response => {
            // console.log(response);
            // setTimeout(function() {
                // Insert Content
                $('#deletePopup').html(response);
                // Show Pop Up
                popup('deletePopup');
            // }, 500);
        })
        .catch( err => console.log(err));
    }
</script>

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






            <style>
                .orders-and-stats {
                    max-width: 95%;
                    margin: 0px auto;
                    column-gap: 15px;
                    row-gap: 15px;
                    margin-bottom: 100px;
                }
                .orders {
                    width: 100%;
                    display: flex;
                    flex-flow: column nowrap;
                    margin-bottom: 30px;
                }
                .orders .scrollable-div .content {
                    min-width: 600px;
                    width: 100%;
                }
                .orders .head {
                    width: 100%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 15px;


                }
                .orders .content-wrapper {
                    width: 100%;
                    margin-right: 0;

                }
                .orders .content-main {
                    width: 100%;
                    background: rgba(47, 64, 95, 1);
                    box-shadow: 0px 18px 25px 0px rgba(0, 0, 0, 0.02);
                    padding: 20px;
                    color: #fff;
                    border-radius: 12px;
                }
                .orders .content-main > .title {
                    font-weight: 600;
                    font-size: 18px;
                    margin-bottom: 20px;
                    color: #FFFFFF;
                }
                .orders .header {
                    color: #fff;
                    width: 100%;
                    background: rgba(63, 87, 115, 1);
                    height: 50px;
                    display: flex;
                    align-items: center;
                    align-items: center;
                    padding: 14px 30px;

                    
                    font-size: 12px;
                    font-weight: 500;
                    line-height: 18px;
                    text-align: left;

                }
                .orders .body {
                    width: 100%;
                    padding: 0px 20px 20px 20px;
                    
                    font-size: 12px;
                    font-weight: 500;
                    line-height: 18px;
                    text-align: left;

                }
                .orders .body .rows .c-row {
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    padding: 15px 0;
                    border-bottom: 1px solid #E6EBF31A;
                    color: #fff;
                }
                .orders .header .item,
                .orders .c-row .item {
                    height: 100%;
                    padding-right: 15px;
                }
                .orders .header .item:nth-child(1),
                .orders .c-row .item:nth-child(1) {
                    width: 40%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                }
                .orders .c-row .item:first-child .thumbnail {
                    border-radius: 10px;
                    width: 50px;
                    height: 50px;

                    overflow: hidden;
                    margin-right: 20px;
                }
                .orders .c-row .item:first-child .thumbnail img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .orders .header .item:nth-child(2),
                .orders .c-row .item:nth-child(2) {
                    height: 100%;
                    width: 20%;
                    display: flex;
                    align-items: center;
                }
                .orders .header .item:nth-child(3),
                .orders .c-row .item:nth-child(3) {
                    width: 30%;
                }
                .orders .header .item:nth-child(4),
                .orders .c-row .item:nth-child(4) {
                    width: 10%;
                }

                .img-notify {
                    width: 12px;
                    height: 12px;
                }

                .content-main {
                    max-width: 100%;
                }
                .content-main .content {
                    min-width: 100%;
                }
                @media screen and (min-width: 768px) {  
                } 
                @media screen and (min-width: 1280px) {   
                    .orders-and-stats {
                        display: grid;
                        grid-template-columns: 2fr 1fr;
                    }
                    .orders {
                        display: flex;
                        flex-flow: row nowrap;
                    }
                    .orders .content-wrapper {
                        width: 100%;
                    }
                    .orders .content-main {
                        padding: 30px;
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





             


            <div class='orders-and-stats'>

                <div class='orders'>
                    <div class="content-main">
                        <div class="head">
                            <div class="title">Products</div>
                            <span class='btn admin-btn-2' onclick='get_popup_content_add()'>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_8006_1360)">
                                    <path d="M12 5V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_8006_1360">
                                    <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                                Add Product
                            </span>
                        </div>
                        <div class="content-inner scrollable-div"> 
                            <?php
                                $products = new MyApp\Classes\Product();
                                $products->products_admin(false);
                            ?>
                        </div>
                    </div>
                </div>

                <div class='stats'>
                    <div class="stats-inner-div">
                        
                        <style>
                            .cards {
                                max-width: 100%;
                                margin: 0px auto 20px auto;
                                display: grid;
                                grid-template-columns: 1fr;
                                column-gap: 15px;
                                row-gap: 15px;
                            }
                            .cards .card {
                                background: rgba(47, 64, 95, 1);

                                border-radius: 12px;
                                padding: 20px;
                                min-width: 100%;
                                color: #ffffff;
                                display: flex;
                                flex-flow: row wrap;
                                justify-content: space-between;
                                align-items: center;
                                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                margin: 0;
                            }
                            .card .text {
                                font-family: Arial, sans-serif;
                            }
                            .card .text .title {
                                font-size: 13px;
                                font-weight: 400;
                                margin: 0;
                                margin-bottom: 15px;
                            }
                            .card .text .value {
                                font-size: 24px;
                                font-weight: bold;
                                margin: 0;
                            }
                            .card .icon {
                                background-color: #fef1e1;
                                border-radius: 50%;
                                width: 45px;
                                height: 45px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                overflow: hidden;
                            }
                            .card .icon img {
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                            }
                            @media screen and (min-width: 1280px) {   
                                .cards {
                                    max-width: 100%;
                                }
                            }
                        </style>

                        <div class="cards">
                            <div class="card">
                                <div class="text">
                                    <p class="title">Total Revenue</p>
                                    <p class="value">$45,980</p>
                                </div>
                                <div class="icon">
                                    <img src="assets/revenue.svg?v=2" alt="">
                                </div>
                            </div>
                            <div class="card">
                                <div class="text">
                                    <p class="title">Total Visitor</p>
                                    <p class="value">2,456</p>
                                </div>
                                <div class="icon">
                                    <img src="assets/users.svg" alt="">
                                </div>
                            </div>
                            <div class="card">
                                <div class="text">
                                    <p class="title">Total Products</p>
                                    <p class="value">358</p>
                                </div>
                                <div class="icon">
                                    <img src="assets/products.svg?v=2" alt="">
                                </div>
                            </div>
                            <div class="card">
                                <div class="text">
                                    <p class="title">Total News</p>
                                    <p class="value">243</p>
                                </div>
                                <div class="icon">
                                    <img src="assets/news.svg" alt="">
                                </div>
                            </div>
                        </div>


                        <!-- Bar Chart (Chart 2 in index.php) -->
                        <style>
                            .chart-container {
                                background: rgba(47, 64, 95, 1);
                                box-shadow: 0px 18px 25px 0px rgba(0, 0, 0, 0.02);
                                padding: 30px;
                                color: #fff;
                                border-radius: 12px;
                            }
                            .ch-title {
                                font-size: 16px;
                                font-weight: 600;
                                margin-bottom: 25px;
                            }
                            .ch-header {
                                font-size: 14px;
                                display: flex;
                                flex-flow: row nowrap;
                                justify-content: space-between;
                                margin-bottom: 20px;
                            }
                            .ch-row {
                                margin-bottom: 25px;
                            }
                            .bar-container {
                                width: 100%;
                                height: 7px;
                                background: rgba(55, 73, 103, 1);
                                border-radius: 5px;
                            }

                            .bar {
                                height: 7px;
                                background: rgba(125, 158, 176, 1);
                                border-radius: 5px;
                            }
                        </style>

                        <div class="chart-container" id='chart-container-2'>
                            <div class="ch-title">
                                Most Sold Items
                            </div>
                            <div class="html-chart">

                            <?php
                                $o = new MyApp\Classes\Order();
                                $o->top_sold_products();
                            ?>


                            <!--
                            <div class="ch-row">
                                <div class='ch-header'>
                                    <div class='ch-label'>
                                        Jeans
                                    </div>
                                    <div class='ch-value'>
                                        70%
                                    </div>
                                </div>
                
                                <div class="bar-container">
                                    <div class="bar" style='width: 70%;'></div>
                                </div>
                            </div>

                            <div class="ch-row">
                                <div class='ch-header'>
                                    <div class='ch-label'>
                                        Shirts
                                    </div>
                                    <div class='ch-value'>
                                        40%
                                    </div>
                                </div>
                
                                <div class="bar-container">
                                    <div class="bar" style='width: 40%;'></div>
                                </div>
                            </div>

                            <div class="ch-row">
                                <div class='ch-header'>
                                    <div class='ch-label'>
                                        T-shirts
                                    </div>
                                    <div class='ch-value'>
                                        60%
                                    </div>
                                </div>
                
                                <div class="bar-container">
                                    <div class="bar" style='width: 60%;'></div>
                                </div>
                            </div>

                            <div class="ch-row">
                                <div class='ch-header'>
                                    <div class='ch-label'>
                                        Jeans
                                    </div>
                                    <div class='ch-value'>
                                        70%
                                    </div>
                                </div>
                
                                <div class="bar-container">
                                    <div class="bar" style='width: 70%;'></div>
                                </div>
                            </div>

                            <div class="ch-row">
                                <div class='ch-header'>
                                    <div class='ch-label'>
                                        Shirts
                                    </div>
                                    <div class='ch-value'>
                                        40%
                                    </div>
                                </div>
                
                                <div class="bar-container">
                                    <div class="bar" style='width: 40%;'></div>
                                </div>
                            </div>
                            -->

                            </div>
                        </div>

                    </div>
                </div>

            </div>






            </div>
        </div>

    </div>



</div>




<?php
    include './footer.php';
?>