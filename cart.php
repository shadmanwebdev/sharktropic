

<!-- Cart -->
<style>
    
    .cart-wrapper {
        float: right;
        width: 38px;
        position: relative;
        margin-left: 0px;
    }
    a#cart-btn {
        cursor: pointer;
        overflow: visible;
        background-color: #FEFA6A;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
    }
    a#cart-btn img {
        width: 12px;
        height: 15px;
    }
    .cart-list {
        background: #394152;

        box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
        -webkit-transition-duration: 750ms;
        transition-duration: 750ms;
        border-radius: 0;
        display: none;
        position: absolute;
        right: -44px;
        top: 48px;
        z-index: 120;

        border: 1px solid #FFFFFF33'
    }
    .cart-list li:not(.cart-btns):not(.total) {
        border-bottom: 1px solid #E6EBF31A;
        padding: 10px 10px;
        display: grid;
        grid-template-columns: 40px 1fr 50px;
        align-items: center;
    }
    .cart-list li .image {
        width: 40px;
        height: 60px;
        border-radius: 6px;
        overflow: hidden;
    }
    .cart-list .image > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cart-item-desc {
        padding-left: 15px;
        line-height: 1;
        color: #fff;
    }
    .cart-item-desc h6 {
        line-height: 1.3;
        font-size: 12px;
    }
    .cart-item-desc h6 a {
        
        line-height: 1;
        font-size: 12px;
        color: #fff;
    }
    .cart-item-desc > p {
        font-size: 14px;
        margin: 0;
    }
    .dropdown-product-remove {
        position: absolute;
        right: 15px;
        top: 17px;
        line-height: 1;
        cursor: pointer;
    }
    .dropdown-product-remove i:before {
        font-size: 13px;
    }
    .dropdown-product-remove {
        color: #000;
    }
    .dropdown-product-remove {
        color: #000;
    }
    .cart-list li .btn-checkout {
        font-size: 13px;
        width: 100%;
        padding: 10px 20px 10px 20px;
        gap: 10px;
        border-radius: 1000px;
        background: #FEFA6A;
        border: 1px solid #FEFA6A;
        color: #111111;
        font-weight: 600;
        margin-top: 10px;
    }
    .cart-list li .btn-cart {
        color: #3a3a3a;
        border: 1px solid #3a3a3a;
        margin-left: 5px;
    }
    .btn-group-sm > .btn, .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .cart > a {
        position: relative;
        z-index: 1;
        padding: 0;
        
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
        width: 38px;
        height: 38px;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        overflow: hidden;
        color: #fff;
    }
    .cart > a > i.icon-shopping-cart {
        font-size: 20px;
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
    .cart > a > i.icon-shopping-cart {
        color: #fff;
    }
    .cart_quantity {
        border: 1px solid #000;
        background-color: #fff;
        border-radius: 50%;
        color: #000;
        font-size: 10px;
        height: 20px;
        line-height: 20px;
        position: absolute;
        right: -3px;
        bottom: 0px;
        text-align: center;
        width: 20px;
        z-index: 2;
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        font-weight: 600;
    }
    #cart-dropdown.cart-data-open {
        display: block;
        width: 300px;
        padding: 10px;
    }

    h6 a,
    .cart-item-desc p,
    .cart-item-desc p span {
        color: #000;
    }
    .cart-item-desc p {
        margin-bottom: 5px;
    }
    .cart-list li.cart-btns {
        /* border-bottom: 1px solid #ebebeb; */
        border: none;
        padding: 0px 15px;
        display: grid;
        /* grid-template-columns: 1fr 1fr; */
    }
    /* Change cart icon color on scroll */
    #header.scrolled .cart > a > i.icon-shopping-cart  {
        color: #000;
    }
    .cart-list .total {
        margin: 0 auto;
        
        color: #fff;
        padding: 10px;
        text-align: center;
        font-size: 12px;
    }
    @media (max-width: 1280px) {   
        .cart-wrapper {
            margin-left: 0px;
        }
    }
    @media (max-width: 992px) {   
        .cart-list {
            right: 0;
        }
    }
    .pdt-select-qty {
        
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .cart-num-product {
        word-break: keep-all;
        color: #fff;
        padding: 10px;
        font-size: 12px;
    }
    .qty-down, .qty-up {
        cursor: pointer;
    }
</style>



<div class='cart-wrapper'>
    <div class="cart" id='header-cart-btn' style='width: 30px; height: 30px;'>
                    
        <?php
            $cart = new MyApp\Classes\Cart();
            $cartCount = $cart->cart_count();
            if($cartCount > 0) {
                $cart->show_cart();
            } 
            else {
                
                echo "<a id='cart-btn' onclick='cart_dropdown()'>
                    <img src='assets/shopping-bag.svg' class='' alt='' />
                </a>
                <div class='cart-list' id='cart-dropdown'>
                </div>";
            }
        ?>       

    </div>
</div>

<!-- 
    Icons: 
    <i class='shopping-bag'></i>
    icon-shopping-cart 
-->