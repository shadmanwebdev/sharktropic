<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Product.php';
    include '../Classes/Cart.php';

    $cart = new MyApp\Classes\Cart;
    
    if(isset($_POST['add_to_cart'])) {
        $cart->add_to_cart();
    }
    if(isset($_POST['remove_from_cart'])) {
        $cart->remove_from_cart();
        $cartCount = $cart->cart_count();
        if($cartCount > 0) {
            $cart->show_cart();
        } else {
            echo "<a id='header-cart-btn' onclick='cart_dropdown()'>
                <i class='icon-shopping-cart'></i>
            </a>
            <ul class='cart-list' id='cart-dropdown'>
            </ul>";
        }
    }
    if(isset($_POST['clear_cart'])) {
        $cart->clear_cart();
    }
    if(isset($_POST['update_cart'])) {
        $cart->update_cart();
    }

    if (isset($_POST['update_cart_qty'])) {
        $type = $_POST['type'];

        if($type == 'cart-btn') {
            $cart->update_cart_qty_btn();
        } else if ($type == 'checkout') {
            $cart->update_cart_qty_checkout();
        }
        
    }
?>