<?php
/*
=================================================================
    CART
=================================================================  
*/

namespace MyApp\Classes;

class Cart extends Product {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    public function startSession() {
        ob_start();
        session_start();
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    /*
    =================================================================
        CART
    =================================================================
    */
    public function remove_from_cart() {
        $cart_array = json_decode($_SESSION['cart'], true);
        
        foreach($cart_array as $cart_product):
            foreach($cart_product['variants'] as $variant):
                if($cart_product['id'] == $_POST['id'] && $variant['color'] == $_POST['color'] && $variant['size'] == $_POST['size']) { 
                    $replaceIndex = array_search($cart_product, $cart_array);
                    if(is_array($cart_product['variants'])) {
                        count($cart_product['variants']);
                        if(count($cart_product['variants']) > 1) {
                            $variantIndex = array_search($variant, $cart_product['variants']);
                            unset($cart_product['variants'][$variantIndex]);
                            unset($cart_array[$replaceIndex]);
                            array_push($cart_array, $cart_product);
                        } else {
                            unset($cart_array[$replaceIndex]);
                        }
                    } else {
                        echo 'not an array';
                    }
                }
            endforeach;
        endforeach;
        
        $_SESSION['cart'] = json_encode($cart_array);

    }
    public function clear_cart() {
        $session_status = session_status();
        if($session_status != 'PHP_SESSION_ACTIVE') {
            session_start(); 
        }
        unset($_SESSION['cart']); 
        session_destroy();;
        echo '1';
    }
    public function add_to_cart() {
        $product = $this->get_product($_POST['id']);
        // unset($_SESSION['cart']);
        
        if(isset($_SESSION['cart'])) {
            // echo 'cart exists';

            // echo '4';
            $cart_array = json_decode($_SESSION['cart'], true);
    
            $product_exists = false;
            
            foreach($cart_array as $cart_product_key => $cart_product) {
                // Check if product exists in cart
                // var_dump($cart_product['id'], $_POST['id'], $cart_product['size'], $_POST['size'] );
                if($cart_product['id'] == $_POST['id']) {
                    if($cart_product['size'] == $_POST['size']) {
                        $cart_array[$cart_product_key]['qty'] += $_POST['qty'];
                        $product_exists = true;
                        break;
                    }
                }

            }

            
            if(!$product_exists) {
                // echo '2';
                $product_data = array (
                    'id' => $product['id'],
                    'title' => $product['title'],
                    'price' => $product['sale_price'],
                    'size' => $_POST['size'],
                    'qty' => $_POST['qty'],
                    'image' => $product['images'][0]['image_filename_sm']
                );
                array_push($cart_array, $product_data);
            }

            $_SESSION['cart'] = json_encode($cart_array);
    
        } else {

            // echo '3';
            // echo 'cart does not exists';
            $cart_array = array();
            
            $product_data = array(
                'id' => $product['id'],
                'title' => $product['title'],
                'price' => $product['sale_price'],
                'size' => $_POST['size'],
                'qty' => $_POST['qty'],
                'image' => $product['images'][0]['image_filename_sm']
            );

            array_push($cart_array, $product_data);

            $_SESSION['cart'] = json_encode($cart_array);
        }
    
            


        $this->show_cart();
    
    }
    public function cart_total() {
        $cart_array = json_decode($_SESSION['cart'], true);
        $total = 0;
        foreach($cart_array as $pdt):
            $total += number_format($pdt['price'], 2) * $pdt['qty'];
        endforeach;
        return $total;
    }
    public function cart_item_total($price, $qty) {
        
        $item_total = number_format($price, 2) * $qty;
    
        return $item_total;
    }
    public function checkout_items() {
        $itensStr = "";
        if(isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);

            foreach($cart_array as $cart_item) {
                $id = $cart_item['id'];
                $img = $cart_item['image'];
                $qty = $cart_item['qty'];
                $title = $cart_item['title'];
                $price = $cart_item['price'];

                $itensStr .= "<div class='c-row'>
                    <div class='item'>
                        <div class='thumbnail'>
                            <img src='./admin/uploads/$img' alt=''>
                        </div>
                        <span>$title</span>
                    </div>
                    <div class='item'>$".$price."</div>
                    <div class='item'>M</div>
                    <div class='pdt-select-qty'>
                        <div class='qty-down' onclick='decrease_cart_qty(\"$id\", \"checkout\")'>
                            <svg width='12' height='12' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <g clip-path='url(#clip0_8006_1357)'>
                            <path d='M5 12H19' stroke='white' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                            </g>
                            <defs>
                            <clipPath id='clip0_8006_1357'>
                            <rect width='24' height='24' fill='white'/>
                            </clipPath>
                            </defs>
                            </svg>
                        </div>

                        <div class='cart-num-product' id='qty' name='qty'>$qty</div>

                        <div class='qty-up' onclick='increase_cart_qty(\"$id\", \"checkout\")'>
                            <svg width='12' height='12' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <g clip-path='url(#clip0_8006_1360)'>
                            <path d='M12 5V19' stroke='white' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                            <path d='M5 12H19' stroke='white' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                            </g>
                            <defs>
                            <clipPath id='clip0_8006_1360'>
                            <rect width='24' height='24' fill='white'/>
                            </clipPath>
                            </defs>
                            </svg>
                        </div>
                    </div>
                </div>";
            }
        }
        echo $itensStr;
    }
    public function show_cart() {

        if(isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);

            $quantity = $this->cart_quantity($cart_array);
            $qtyStr = "<span class='cart_quantity'>$quantity</span>";
        } else {
            $qtyStr = "";
        }
            
        // $qtyStr
        $cartStr = "<a id='cart-btn' onclick='cart_dropdown()'>
            
            <img src='assets/shopping-bag.svg' class='' alt='' />
        </a>";
        $cartStr .= "<ul class='cart-list' id='cart-dropdown'>";
    
    
        if(isset($_SESSION['cart'])) {
            foreach($cart_array as $pdt):

                $id = $pdt['id'];
                $img = $pdt['image'];
                $qty = $pdt['qty'];

                $cartStr .= "<li>";
                $cartStr .= "<div class='image'><img src='admin/uploads/$img' class='cart-thumb' alt=''></div>";
                $cartStr .= "<div class='cart-item-desc'>";
                $cartStr .= "<h6>{$pdt['title']}</h6>";
                // $cartStr .= "<p>{$qty}x - <span class='price'>$".$pdt['price']."</span></p>";
                $cartStr .= "</div>";
                $cartStr .= "
                <div class='pdt-select-qty'>
                    <div class='qty-down' onclick='decrease_cart_qty(\"$id\", \"cart-btn\")'>
                        <svg width='12' height='12' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <g clip-path='url(#clip0_8006_1357)'>
                        <path d='M5 12H19' stroke='white' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                        </g>
                        <defs>
                        <clipPath id='clip0_8006_1357'>
                        <rect width='24' height='24' fill='white'/>
                        </clipPath>
                        </defs>
                        </svg>
                    </div>

                    <div class='cart-num-product' id='qty' name='qty'>$qty</div>

                    <div class='qty-up' onclick='increase_cart_qty(\"$id\", \"cart-btn\")'>
                        <svg width='12' height='12' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <g clip-path='url(#clip0_8006_1360)'>
                        <path d='M12 5V19' stroke='white' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                        <path d='M5 12H19' stroke='white' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'/>
                        </g>
                        <defs>
                        <clipPath id='clip0_8006_1360'>
                        <rect width='24' height='24' fill='white'/>
                        </clipPath>
                        </defs>
                        </svg>
                    </div>
                </div>
                ";
                $cartStr .= "</li>";
                    
            endforeach;
    
            $total = $this->cart_total();
            $totalStr = "<li class='cart-btns'>
                <a href='checkout' class='btn btn-sm btn-checkout'>Checkout</a>
            </li>
            <li class='total'>
                <span class='cart-total'>Total: $".$total."</span>
            </li>";
            $cartStr .= $totalStr;
        }
    
        $cartStr .= "</ul>";
        
        echo $cartStr;
    }
    
    public function cart_count() {
        if(isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);
            if(count($cart_array) > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public function cart_quantity($cart_array) {
        $e = 0;
        if(is_array($cart_array)) {
            foreach($cart_array as $cart_product_key => $cart_product) {
                $e = $e + 1;
            }
        }
        return $e;
    }
    public function update_cart() {
        $qtyArray = json_decode($_POST['qtyString'], true);
    
        if(isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);
    
            foreach($qtyArray as $qty) {
                foreach($cart_array as &$cart_item) {
                    if($qty['product_id'] == $cart_item['id']) {
                        foreach($cart_item['variants'] as &$variant) {
                            if($qty['size'] == $variant['size'] && $qty['color'] == $variant['color']) {
                                $variant['qty'] = $qty['qty'];
                                break 2;
                            }
                        }
                    }
                }
            }
    
            $_SESSION['cart'] = json_encode($cart_array);
            echo $_SESSION['cart'];
        }
    }
    public function final_info() {
        if(isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);
            $total = $this->cart_total();
            $final_info_str = "<ul class='cart-total-chart'>
                <li><span>Subtotal</span> <span>$".$total."</span></li>
                <li><span>Shipping</span> <span>Free</span></li>
                <li><span><strong>Total</strong></span> <span><strong>$".$total."</strong></span></li>
            </ul>";
        } else {
            $final_info_str = "<ul class='cart-total-chart'>
                <li><span>Subtotal</span> <span>$0</span></li>
                <li><span>Shipping</span> <span>Free</span></li>
                <li><span><strong>Total</strong></span> <span><strong>$0</strong></span></li>
            </ul>";
        }
        echo $final_info_str;
    }




    public function update_cart_qty() {
        $product_id = $_POST['id'];
        $qty_change = $_POST['qty_change'];
    
        if (isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);
    
            $product_exists = false;
    
            foreach ($cart_array as $cart_product_key => $cart_product) {
                if ($cart_product['id'] == $product_id) {
                    $cart_array[$cart_product_key]['qty'] += $qty_change;
                    if ($cart_array[$cart_product_key]['qty'] <= 0) {
                        unset($cart_array[$cart_product_key]); // Remove item if quantity is zero or less
                    }
                    $product_exists = true;
                    break;
                }
            }
    
            if ($product_exists) {
                $_SESSION['cart'] = json_encode(array_values($cart_array)); // Re-index array to avoid issues with numeric keys
            }
        }
    
    }
    public function update_cart_qty_btn() {
        $this->update_cart_qty();
        $this->show_cart();
    }
    public function update_cart_qty_checkout() {
        $this->update_cart_qty();
        $this->checkout_items();
    }
    
}