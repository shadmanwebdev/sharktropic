

<style>

    .search-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .search-box {
        width: 250px;
        padding: 9px 20px 9px 40px;
        border-radius: 20px; /* Rounded corners */
        border: none;
        outline: none;
        background-color: transparent;
        border: 1px solid #FFFFFF33;
        box-shadow: none;

        color: #fff; /* Light gray placeholder text */
        font-family: Poppins;
        font-size: 15px;
        font-weight: 400;
        line-height: 22.5px;
        text-align: left;
    }

    .search-box::placeholder {
        color: #fff; /* Light gray placeholder text */
        font-family: Poppins;
        font-size: 15px;
        font-weight: 400;
        line-height: 22.5px;
        text-align: left;

    }

    .search-box:focus {
        box-shadow: none; /* Shadow on focus */
    }


    .search-btn-wrapper {
        width: 25px;
        height: 25px;
        position: absolute;
        top: 13px;
        left: 15px;
        z-index: 2;
        cursor: pointer;
    }
</style>


<?php
    $pagename = get_pagename();
    $page_array = array('index', 'products', 'news', 'orders');

    if($pagename == 'products' || $pagename == 'index') {
        $searchFunction = 'search_products()';
        $onclick = " onclick='search_products()'";
    } else if($pagename == 'news') {
        $searchFunction = 'search_news()';
        $onclick = " onclick='search_news()'";
    } else if($pagename == 'orders') {
        $searchFunction = 'search_orders()';
        $onclick = " onclick='search_orders()'";
    }
    
?>

<?php
    if(in_array($pagename, $page_array)) {
?>


    <div class='search-container'>
        <input onkeydown="if(event.keyCode == 13) <?= $searchFunction; ?>" type='text' class='search-box' placeholder='Search here...'>
        <span <?= $onclick; ?> class='search-btn-wrapper'>
            <img src='./assets/search.svg' alt=''>
        </span>
    </div>


<?php
    }
?>



<script defer>
    function search_products() {

        const search = $('.search-box').val();

        console.log(search);

        if(search) {
            load_start();

            var formData = new FormData();

            formData.append('search', search);

            fetch('./search-products.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()   
            })
            .then(response => {
                setTimeout(function() {
                    load_end();
                    // console.log(response);
                    $('.rows').html(response);
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            load_start();

            setTimeout(function() {
                load_end();
            }, 2000);
        }
    }
    function search_news() {

        const search = $('.search-box').val();

        console.log(search);

        if(search) {
            load_start();

            var formData = new FormData();

            formData.append('search', search);

            fetch('./search-news.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()   
            })
            .then(response => {
                setTimeout(function() {
                    load_end();
                    // console.log(response);
                    $('.rows').html(response);
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            load_start();

            setTimeout(function() {
                load_end();
            }, 2000);
        }
    }
    function search_orders() {

        const search = $('.search-box').val();

        console.log(search);

        if(search) {
            load_start();

            var formData = new FormData();

            formData.append('search', search);

            fetch('./search-orders.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()   
            })
            .then(response => {
                setTimeout(function() {
                    load_end();
                    // console.log(response);
                    $('.rows').html(response);
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            load_start();

            setTimeout(function() {
                load_end();
            }, 2000);
        }
    }
</script>
