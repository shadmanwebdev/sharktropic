<?php
    include './header.php';
?>

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
                .cards {
                    max-width: 90%;
                    margin: 20px auto;
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
                @media screen and (min-width: 768px) {
                    .cards {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }
                @media screen and (min-width: 1200px) {
                    .cards {
                        grid-template-columns: repeat(4, 1fr);
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


            <style>
                .charts-wrapper {
                    max-width: 90%;
                    margin: 30px auto;
                    display: grid;
                    grid-template-columns: 1fr;
                    column-gap: 15px;
                    row-gap: 15px;
                }
                #chart-container-1 {
                    width: 100%;
                }
                #chart-container-2 {
                    width: 100%;
                }
                @media screen and (min-width: 768px) {
                    .charts-wrapper {
                        grid-template-columns: 1fr;
                    }
                }
                @media screen and (min-width: 1200px) {
                    .charts-wrapper {
                        grid-template-columns: 2fr 1fr;
                    }
                }
            </style>

            <!-- Chart 1 (chart) -->
            <style>
                .chart-container {
                    background: rgba(47, 64, 95, 1);
                    box-shadow: 0px 18px 25px 0px rgba(0, 0, 0, 0.02);
                    padding: 30px;
                    color: #fff;
                    border-radius: 12px;
                }
                .header {
                    font-size: 16px;
                    font-weight: 600;
                    line-height: 21.12px;
                    text-align: left;
                    margin-bottom: 10px;
                }
                .revenue {
                    font-size: 25px;
                    font-weight: 700;
                    line-height: 33px;
                    text-align: left;

                    margin-bottom: 10px;
                }
                .increase {
                    color: #00ff00;
                }
            </style>

            <!-- Chart 2 (Html) -->
            <style>
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

            <div class="charts-wrapper">



                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                


                <div class="chart-container" id='chart-container-1'>
                    <div class="header">
                        Total Revenue
                    </div>
                    <div class="revenue">
                        $50.4K
                    </div>
                    <div class="increase">
                        ↑ 5% than last month
                    </div>
                    <canvas id="myChart"></canvas>
                </div>


 
                <div>
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
        


                <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [
                                {
                                    label: 'Profit',
                                    data: [90, 60, 80, 90, 60, 40, 50, 70, 50, 90, 70, 80],
                                    backgroundColor: 'rgba(125, 158, 176, 1)', // Blue
                                    borderColor: 'rgba(125, 158, 176, 1)',
                                    borderWidth: 1,
                                    barThickness: 10, // Customize bar width
                                    maxBarThickness: 10 // Max bar width
                                },
                                {
                                    label: 'Donation',
                                    data: [30, 40, 45, 60, 10, 20, 25, 55, 35, 40, 30, 50],
                                    backgroundColor: 'rgba(254, 250, 106, 1)', // Yellow
                                    borderColor: 'rgba(254, 250, 106, 1)',
                                    borderWidth: 1,
                                    barThickness: 10, // Customize bar width
                                    maxBarThickness: 10 // Max bar width
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: 'white'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white',
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                }
                            }
                        }
                    });
                </script>


            </div>



            <style>
                .products-and-news {
                    max-width: 90%;
                    margin: 0px auto;
                    column-gap: 15px;
                    row-gap: 15px;
                    margin-bottom: 100px;
                    overflow: hidden;

                }
                .collection {
                    width: 100%;
                    display: flex;
                    flex-flow: column nowrap;
                    margin-bottom: 30px;
                }
                .collection .scrollable-div .content {
                    min-width: 900px;
                    width: 100%;
                }
                .collection .head {
                    width: 100%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 15px;
                }
                .collection .content-wrapper {
                    width: 100%;
                    margin-right: 0;
                }
                .collection .content-main {
                    width: 100%;
                    background: rgba(47, 64, 95, 1);
                    box-shadow: 0px 18px 25px 0px rgba(0, 0, 0, 0.02);
                    padding: 30px;
                    color: #fff;
                    border-radius: 12px;
                }
                .collection .content-main > .title {
                    font-weight: 600;
                    font-size: 18px;
                    margin-bottom: 20px;
                    color: #FFFFFF;
                }
                .collection .header {
                    color: #fff;
                    width: 100%;
                    background: rgba(63, 87, 115, 1);
                    height: 50px;
                    display: flex;
                    align-items: center;
                    align-items: center;
                    
                    padding: 14px 20px 14px 20px;
                    font-size: 14px;
                }
                .collection .body {
                    width: 100%;
                    padding: 0px 20px 20px 20px;
                    font-size: 14px;
                }
                .collection .body .rows .c-row {
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    padding: 15px 0;
                    border-bottom: 1px solid #E6EBF31A;
                    color: #fff;
                }
                .collection .c-row .item {
                    padding-right: 20px;
                }
                .collection .header .item:nth-child(1),
                .collection .c-row .item:nth-child(1) {
                    width: 45%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                }
                .collection .c-row .item:first-child .thumbnail {
                    border-radius: 10px;
                    min-width: 51px;
                    min-height: 51px;
                    overflow: hidden;
                    margin-right: 20px;
                }
                .collection .c-row .item:first-child .thumbnail img {
                    
                    width: 51px;
                    height: 51px;
                    object-fit: cover;
                }
                .collection .header .item:nth-child(2),
                .collection .c-row .item:nth-child(2) {
                    height: 100%;
                    
                    width: 20%;
                    display: flex;
                    align-items: center;
                }
                .collection .header .item:nth-child(3),
                .collection .c-row .item:nth-child(3) {
                    height: 100%;
                    
                    width: 25%;
                }
                .collection .header .item:nth-child(4),
                .collection .c-row .item:nth-child(4) {
                    height: 100%;
                    
                    width: 20%;
                }
                @media screen and (min-width: 768px) {  
                } 
                @media screen and (min-width: 1280px) {   
                    .products-and-news {
                        display: grid;
                        grid-template-columns: 2fr 1fr;
                    }
                    .collection {
                        min-width: 100%;
                        width: 100%;
                        display: flex;
                        flex-flow: row nowrap;
                        margin-bottom: 0px;
                    }
      
                    /* .collection .content-main {
                        min-width: 100%;
                        width: 100%;
                    } */
                    .collection .scrollable-div .content {
                        min-width: 100%;
                        width: 100%;
                    }
                }
            </style>



            <!-- News -->
            <style>
                .news {
                    width: 100%;
                    display: flex;
                    flex-flow: column nowrap;
                }
                .news .scrollable-div .content {
                    min-width: 600px;
                    width: 100%;
                }
                .news .head {
                    width: 100%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 15px;
                }
                .news .news-inner-div {
                    width: 100%;
                    background: rgba(47, 64, 95, 1);
                    box-shadow: 0px 18px 25px 0px rgba(0, 0, 0, 0.02);
                    padding: 30px;
                    color: #fff;
                    border-radius: 12px;
                }
                .news .news-inner-div > .title {
                    font-weight: 600;
                    font-size: 18px;
                    margin-bottom: 20px;
                    color: #FFFFFF;
                }
                .news .item  {
                    width: 100%;
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    padding: 15px 0;
                    border-bottom: 1px solid #E6EBF31A;
                    color: #fff;
                }
                .news .item .thumbnail {
                    border-radius: 10px;
                    width: 51px;
                    height: 51px;
                    overflow: hidden;
                    margin-right: 20px;
                }
                .news .item .thumbnail img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .news .item .text .title {
                    font-size: 14px;
                    font-weight: 600;
                    line-height: 21px;
                    text-align: left;

                    margin-bottom: 5px;

                }
                .news .item .text .subtitle {
                    font-size: 12px;
                    font-weight: 400;
                    line-height: 18px;
                    text-align: left;

                }
                @media screen and (min-width: 1280px) {   
                    .news .scrollable-div .content {
                        min-width: 100%;
                        width: 100%;
                    }
                }
            </style>
             


            <div class='products-and-news'>

                <div class='collection'>
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
                                $products->products_admin();
                            ?>
                        </div>

                    </div>
                </div>

                <div class='news'>
                    <div class="news-inner-div">
                        <div class="head">
                            <div class="title">News</div>
                            <span class='btn admin-btn-1' onclick='get_popup_content_add_news()'>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_8006_1360)">
                                    <path d="M12 5V19" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 12H19" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_8006_1360">
                                    <rect width="24" height="24" fill="black"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                                Add News
                            </span>
                        </div>
                        <div class="content-inner scrollable-div">  
                            <?php
                                $n = new MyApp\Classes\News();
                                $n->newss_admin(true);
                            ?>
                        </div>
                    </div>
                </div>

            </div>






            </div>
        </div>

    </div>



</div>






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

            fetch('../controllers/user-handler.php', {
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
    include './footer.php';
?>