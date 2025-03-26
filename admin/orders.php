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


<!-- Order Details -->

<style>
    
    .li-group-item .c-left {
        
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .li-group-item:nth-child(1) {
        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
        border-top: 1px solid #E6EBF31A;
    }
    .li-group-item:first-child .thumbnail {
        border-radius: 10px;
        width: 50px;
        height: 50px;
        overflow: hidden;
        margin-right: 20px;
    }
    .li-group-item:first-child .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media screen and (min-width: 1200px) {
        .li-group-item {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
        }    
        .li-group-item:first-child .c0left {
            margin-bottom: 0px;
        }   
        .li-group-item:first-child .thumbnail {
            width: 50px;
            height: 50px;
            margin-right: 20px;
            margin-bottom: 0px;
        }
    }
</style>



<!-- DELETE POPUP -->
<div id='deletePopup' class='hide_popup popup'>
    
</div>




<script defer>
    function get_popup_content_order(id) {
        // console.log(id);

        fetch('./confirm-delete-popup-order.php?type=order&id='+id)
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
    function confirm_delete_order() {
        var formData = new FormData();

        const del_id = $('#del_id').val();

        formData.append('del', 'true');
        formData.append('del_id', del_id);

        const url = '../controllers/order-handler.php';
        const return_url = './';

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            // console.log(response);
            if(response == '1') {
                // setTimeout(function() {
                    $('#message-response-1').html("<div class='error'>The Item was Deleted!</div>");
                    setTimeout(function() {
                        // Reload Page
                        window.location.href = return_url;
                    }, 1000);
                // }, 500);
            } else {
                $('#message-response-1').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    }
</script>


<script defer>
    function get_popup_content_edit(id) {
        // console.log(id);
        closePopup();

        fetch('./edit-order-popup?type=order&id='+id)
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
                .mCustomScrollBox {
                    overflow: visible !important;
                }
                .mCustomScrollBox .mCSB_container {
                    overflow: visible !important;
                }
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
                    padding: 30px;
                    color: #fff;
                    border-radius: 12px;
                }
                .orders .content-main > .title {
                    font-weight: 600;
                    font-size: 18px;
                    margin-bottom: 20px;
                    color: #FFFFFF;
                }
                .orders .content-inner {
                    overflow: hidden !important;
                    
                    padding-bottom: 120px !important;
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
                    width: 25%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                }
                .orders .c-row .item:first-child .thumbnail {
                    border-radius: 10px;
                    width: 30px;
                    height: 30px;

                    overflow: hidden;
                    margin-right: 10px;
                }
                .orders .c-row .item:first-child .thumbnail img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .orders .header .item:nth-child(2),
                .orders .c-row .item:nth-child(2) {
                    height: 100%;
                    width: 12%;
                    display: flex;
                    align-items: center;
                }
                .orders .header .item:nth-child(3),
                .orders .c-row .item:nth-child(3) {
                    width: 12%;
                }
                .orders .header .item:nth-child(4),
                .orders .c-row .item:nth-child(4) {
                    width: 10%;
                }
                .orders .header .item:nth-child(5),
                .orders .c-row .item:nth-child(5) {
                    height: 100%;
                    width: 15%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                }
                .orders .header .item:nth-child(6),
                .orders .c-row .item:nth-child(6) {
                    width: 20%;
                }
                .orders .header .item:nth-child(7),
                .orders .c-row .item:nth-child(7) {
                    width: 10%;
                }
                
                .orders .header .item:nth-child(8),
                .orders .c-row .item:nth-child(8) {
                    width: 6%;
                }

                .img-notify {
                    width: 12px;
                    height: 12px;
                }

                .content-main {
                    max-width: 100%;
                }
                .orders .scrollable-div .content {
                    min-width: 900px;
                    width: 100%;
                }
                @media screen and (min-width: 768px) {  
                    /* .orders-and-stats {
                        grid-template-columns: 1fr;
                    } */
                } 
                @media screen and (min-width: 1280px) {   
                    .orders-and-stats {
                        display: grid;
                        grid-template-columns: 3fr 1fr;
                    }
                    .orders {
                        display: flex;
                        flex-flow: row nowrap;
                    }
                    .orders .content-wrapper {
                        width: 100%;
                    }
                }
            </style>


            <div class='orders-and-stats'>

                <div class='orders'>
                    <div class="content-main">
                        <div class="head">
                            <div class="title">Orders</div>
                            <span class='btn admin-btn-2' onclick='get_popup_content_add()'>
                                Drops | Products
                            </span>
                        </div>
                        
                        <style>
                            .custom-select-2 {
                                position: relative;
                                display: inline-block;
                                width: 100%;
                                min-width: 120px;

                                                                            
                                font-size: 12px;
                                font-weight: 500;
                                line-height: 18px;
                                text-align: left;
                            }
                            .custom-select-2 select {
                                display: none; /* Hide the default dropdown */
                            }
                            .select-selected {
                                background: #FFFFFF0D;
                                padding: 10px;


                                border-radius: 25px;
                                cursor: pointer;
                                user-select: none;
                            }
                            .select-selected:after {
                                content: url('./assets/chevron-down.svg'); 
                                float: right;
                                margin-left: 10px;
                            }
                            .select-items div, .select-selected {
                                color: white;
                                padding: 10px;
                                cursor: pointer;
                            }
                            .select-items {
                                width: 100%;
                                position: absolute;
                                display: none;
                                z-index: 1;

                                padding: 10px;
                                border-radius: 25px;
                                background: rgba(47, 64, 95, 1);
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            }
                            .select-items div:hover {
                                background-color: #576C91;
                            }
                            .custom-select-2 .shipped { color: #4CE13F; }
                            .custom-select-2 .paid { color: #FEFA6A; }
                            .custom-select-2 .delivered { color: #FCAF51; }
                        </style>
                                
                        <?php
                            $order = new MyApp\Classes\Order;
                            $order->orders_admin();
                        ?>

                                    
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
                            .icon-wrapper {
                                width: 45px;
                                height: 45px; 
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                border-radius: 50%;
                                overflow: hidden;
                                background-color: #394A67;
                            }
                            .card .icon {
                                background-color: transparent;
                                width: 25px;
                                height: 25px;
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

                        <?php
                            $order = new MyApp\Classes\Order;
                            $order->order_cards();
                        ?>

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

                            </div>
                        </div>

                    </div>
                </div>

            </div>






            </div>
        </div>

    </div>



</div>




<script defer>
    const selected = document.querySelector('.select-selected');
    const items = document.querySelector('.select-items');
    const options = document.querySelectorAll('.select-items div');

    selected.addEventListener('click', () => {
        items.style.display = items.style.display === 'block' ? 'none' : 'block';
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            selected.innerText = option.innerText;
            selected.style.color = window.getComputedStyle(option).color;
            items.style.display = 'none';
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.custom-select-2')) {
            items.style.display = 'none';
        }
    });
</script>



<script>
    function update_order_status(el, status, id) {
        if(status) {
            var formData = new FormData();
            
            formData.append('update_order_status', 'true');
            formData.append('order_id', id);
            formData.append('order_status', status);

            fetch('../controllers/order-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                console.log(response);
            })
            .catch( err => console.log(err));
        }
    }
</script>


<?php
    include './footer.php';
?>