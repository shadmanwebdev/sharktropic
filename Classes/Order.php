<?php
/*
=================================================================
    cURL
    CRUD (create, read, update, delete) 
    GET order
    CREATE PRODUCT
    UPDATE PRODUCT
    
    DISPLAY
orders_admin()
update_order_status(
    -> create_order()
    1. User logged in
        -> complete_order()
    1. User not logged in
        -> login()
            -> order_exists()
            -> update_order_status() 
            -> complete_order()
=================================================================  
*/


namespace MyApp\Classes;

class Order extends Db {
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

    public function get_top_sold_products() {
        // Query to get the count of each product sold
        $sql = "SELECT 
            oi.product_id,
            p.title AS product_title,
            COUNT(oi.product_id) AS product_sold_count
        FROM order_items oi
        LEFT JOIN products p ON oi.product_id = p.id
        GROUP BY oi.product_id
        ORDER BY product_sold_count DESC
        LIMIT 5";
    
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $top_sold_products = array();
        while ($row = $result->fetch_assoc()) {
            $top_sold_products[] = $row;
        }
    
        return $top_sold_products;
    }
    
    public function get_total_products_sold() {
        $sql = "SELECT COUNT(*) AS total_products_sold FROM order_items";
    
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['total_products_sold'];
    }
    
    public function get_top_sold_products_with_percentage() {
        $top_sold_products = $this->get_top_sold_products();
        $total_products_sold = $this->get_total_products_sold();
    
        foreach ($top_sold_products as &$product) {
            $product['sales_percentage'] = round(($product['product_sold_count'] / $total_products_sold) * 100);
        }
    
        return $top_sold_products;
    }
    
    public function top_sold_products() {
        $top_sold_products = $this->get_top_sold_products_with_percentage();
        // var_dump($top_sold_products);

        $topProducts = "";

        if(count($top_sold_products) > 0) {
            foreach ($top_sold_products as $top_product) {
                $topProducts .= "<div class='ch-row'>
                    <div class='ch-header'>
                        <div class='ch-label'>
                            {$top_product['product_title']}
                        </div>
                        <div class='ch-value'>
                            {$top_product["sales_percentage"]}%
                        </div>
                    </div>
    
                    <div class='bar-container'>
                        <div class='bar' style='width: {$top_product["sales_percentage"]}%;'></div>
                    </div>
                </div>";
            }

        }
        echo $topProducts;

    }
    /*
    =================================================================
        CRUD (create, read, update, delete)
    =================================================================  
    */
    public function inititate_order() {
        // Create Order Session
        if(isset($_SESSION['user'])) {
            $logged_in = is_logged_in();
            if($logged_in == '1') {
                $order_status = 'in progress';
            } else {
                $order_status = 'requires email verification';
            }
        } else {
            $order_status = 'requires login';
        }
        
        
        $order = array(
            'status' => $order_status,
            'shipping_details' => array(
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'email' => $_POST['email']
            ),
            'promo_code' => isset($_POST['promo_code']) ? $_POST['promo_code'] : ''
        );

        $_SESSION['order'] = json_encode($order, true);
        
        echo $_SESSION['order'];
    }

    public function create_order() {
        $buyer_id = get_uid();
        // $buyer_user_details = $this->get_user($buyer_id);
        // $fullname = $buyer_user_details['firstname'] . ' ' . $buyer_user_details['lastname'];
        // $email = $buyer_user_details['email'];
        if(isset($_SESSION['order'])) {
            $order = json_decode($_SESSION['order'], true);

            $status = $order['status'];
            $shipping_details = $order['shipping_details'];
    
            $name = $shipping_details['name'];
            $phone = $shipping_details['phone'];
            $address = $shipping_details['address'];
            $email = $shipping_details['email'];
    
            $promo_code = $order['promo_code'];
    
            $cart_products = json_decode($_SESSION['cart'], true);
            // $products = $order['products'];
    
            // Total price
            $total = 0;
            foreach($cart_products as $product) {
                $unit_price = $product['price'];
                $qty = $product['qty'];
    
                $total += floatval($unit_price) * intval($qty);
            }
            $total = number_format($total, 2, '.', '');
    
    
            $order_status = 'Started';
            $created_at = datetime_now();
    
            // Create Order
            $stmt = $this->con->prepare('INSERT INTO orders (buyer_id, fullname, email, phone, addr, total, order_status, promo_code, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('issssssss', $buyer_id, $name, $email, $phone, $address, $total, $order_status, $promo_code, $created_at);
            
            if($stmt->execute()) {   
                $status = '3';
                $order_id = $stmt->insert_id;


                $order = array(
                    'order_id' => $order_id,
                    'status' => $order_status,
                    'total' => $total,
                    'shipping_details' => array(
                        'name' => $name,
                        'phone' => $phone,
                        'address' => $address,
                        'email' => $email
                    ),
                    'promo_code' => $promo_code
                );
        
                $_SESSION['order'] = json_encode($order, true);
    
                // Insert Order Products
                foreach($cart_products as $product) {
                    $product_id = $product['id'];
                    $product_size = $product['size'];
                    $unit_price = $product['price'];
                    $qty = $product['qty'];
    
                    $stmtItem = $this->con->prepare('INSERT INTO order_items (product_id, product_size, unit_price, qty, order_id) VALUES (?, ?, ?, ?, ?)');
                    $stmtItem->bind_param('issii', $product_id, $product_size, $unit_price, $qty, $order_id);
                    if($stmtItem->execute()) {
                        $status = '1';
                    } else {
                        $status = '2';
                    }
                    $stmtItem->close();
                }
    
    
    
            } else {
                $status = '0';
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }
            $stmt->close();
        } else {
            $status = '4';
        }
        echo $status;
    }
    public function delete_order($id) {
        // Delete `product`
        $sql = "DELETE FROM orders WHERE order_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            $stmt->close();
            $status = '1';
        } else {
            $status = '0';
        }
        echo $status;
    }
    public function update_order_status($new_order_status) {
        if(isset($_SESSION['order'])) {
            $order = json_decode($_SESSION['order'], true);

            $order = array(
                'status' => $new_order_status,
                'shipping_details' => array(
                    'name' => $order['shipping_details']['name'],
                    'phone' => $order['shipping_details']['phone'],
                    'address' => $order['shipping_details']['address'],
                    'email' => $order['shipping_details']['email']
                ),
                'promo_code' => isset($_POST['promo_code']) ? $_POST['promo_code'] : ''
            );

                
            $_SESSION['order'] = json_encode($order, true);
        }
    }
    public function update_order_status_admin($id, $status) {
        $stmt = $this->con->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
        $stmt->bind_param('si', $status, $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
    public function update_created_order_status($id, $status) {
        $stmt = $this->con->prepare("UPDATE orders SET order_status=? WHERE id=?");
        $stmt->bind_param('si', $status, $id);
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        return $status;
    }
    public function order_exists() {
        if(!isset($_SESSION['order'])) {
            $order = array(
                'status' => 'na'
            );
            $_SESSION['order'] = json_encode($order, true);
        }
        
        return $_SESSION['order'];
    }
    
    public function get_orders() {
        $sql = "SELECT 
            o.order_id,
            o.buyer_id,
            o.fullname,
            o.email,
            o.addr,
            o.phone,
            o.total,
            o.order_status,
            o.promo_code,
            o.created_at AS order_created_at,
            oi.product_id,
            oi.product_size,
            p.title AS product_title,
            p.description AS product_description,
            p.regular_price AS product_regular_price,
            p.sale_price AS product_sale_price,
            p.created_at AS product_created_at,
            pi.image_filename_sm,
            pi.image_filename_md,
            pi.image_filename_lg,
            pay.pid AS payment_id,
            pay.id AS checkout_session_id,
            pay.payment_intent_id AS payment_intent_id
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        LEFT JOIN products p ON oi.product_id = p.id
        LEFT JOIN product_images pi ON oi.product_id = pi.product_id
        LEFT JOIN payments pay ON o.order_id = pay.order_id";
    
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Initialize an array to store order data and associated items
        $orders = array();
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];
    
            // Initialize the order array if not already created
            if (!isset($orders[$order_id])) {
                $orders[$order_id] = array(
                    'order_id' => $order_id,
                    'buyer_id' => $row['buyer_id'],
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'addr' => $row['addr'],
                    'phone' => $row['phone'],
                    'promo_code' => $row['promo_code'],
                    'total' => $row['total'],
                    'order_status' => $row['order_status'],
                    'created_at' => $row['order_created_at'],
                    'items' => array(),
                    'payment' => array()
                );
            }
    
            // Add item details to the order
            if ($row['product_id']) {
                $orders[$order_id]['items'][] = array(
                    'product_id' => $row['product_id'],
                    'product_size' => $row['product_size'],
                    'product_title' => $row['product_title'],
                    'product_description' => $row['product_description'],
                    'product_regular_price' => $row['product_regular_price'],
                    'product_sale_price' => $row['product_sale_price'],
                    'product_created_at' => $row['product_created_at'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg'],
                );
            }


            // if ($row['order_status'] == 'Paid') {
                if (isset($row['payment_id'])) {
                    $orders[$order_id]['payment'][] = array(
                        'payment_id' => $row['payment_id'],
                        'checkout_session_id' => $row['checkout_session_id'],
                        'payment_intent_id' => $row['payment_intent_id']
                    );
                }
            // }
        }

        // var_dump($orders);
    
        // Now $orders contains the orders with associated items, product details, and images
        return $orders;
    }
    public function get_order($order_id) {
        $sql = "SELECT 
            o.order_id,
            o.buyer_id,
            o.fullname,
            o.email,
            o.addr,
            o.phone,
            o.total,
            o.order_status,
            o.promo_code,
            o.created_at AS order_created_at,
            oi.product_id,
            oi.product_size,
            p.title AS product_title,
            p.description AS product_description,
            p.regular_price AS product_regular_price,
            p.sale_price AS product_sale_price,
            p.created_at AS product_created_at,
            pi.image_filename_sm,
            pi.image_filename_md,
            pi.image_filename_lg,
            pay.pid AS payment_id,
            pay.id AS checkout_session_id,
            pay.payment_intent_id AS payment_intent_id
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        LEFT JOIN products p ON oi.product_id = p.id
        LEFT JOIN product_images pi ON oi.product_id = pi.product_id
        LEFT JOIN payments pay ON o.order_id = pay.order_id        
        WHERE o.order_id=?";
    
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize an array to store order data and associated items
        $orders = array();
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];

            // Initialize the order array if not already created
            if (!isset($orders[$order_id])) {
                $orders[$order_id] = array(
                    'order_id' => $order_id,
                    'buyer_id' => $row['buyer_id'],
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'addr' => $row['addr'],
                    'phone' => $row['phone'],
                    'promo_code' => $row['promo_code'],
                    'total' => $row['total'],
                    'order_status' => $row['order_status'],
                    'created_at' => $row['order_created_at'],
                    'items' => array(),
                    'payment' => array()
                );
            }

            // Add item details to the order
            if ($row['product_id']) {
                $orders[$order_id]['items'][] = array(
                    'product_id' => $row['product_id'],
                    'product_size' => $row['product_size'],
                    'product_title' => $row['product_title'],
                    'product_description' => $row['product_description'],
                    'product_regular_price' => $row['product_regular_price'],
                    'product_sale_price' => $row['product_sale_price'],
                    'product_created_at' => $row['product_created_at'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg'],
                );
            }


            if ($row['order_status'] == 'Paid') {
                $orders[$order_id]['payment'][] = array(
                    'payment_id' => $row['payment_id'],
                    'checkout_session_id' => $row['checkout_session_id'],
                    'payment_intent_id' => $row['payment_intent_id']
                );
            }
        }

        // Now $orders contains the orders with associated items, product details, and images
        return $orders[$order_id];
    }
    public function get_my_orders() {
        if(isset($_SESSION['user'])) {
            $uid = get_uid();        
        } else {
            header('location: ./login');
        }
        
        $sql = "SELECT 
            o.order_id,
            o.buyer_id,
            o.fullname,
            o.email,
            o.addr,
            o.phone,
            o.total,
            o.order_status,
            o.promo_code,
            o.created_at AS order_created_at,
            oi.item_id,
            oi.product_id,
            oi.product_size,
            oi.qty AS product_qty,
            p.title AS product_title,
            p.description AS product_description,
            p.sale_price AS product_sale_price,
            p.regular_price AS product_regular_price,
            p.created_at AS product_created_at,
            pi.image_filename_sm,
            pi.image_filename_md,
            pi.image_filename_lg,
            pay.pid AS payment_id,
            pay.id AS checkout_session_id,
            pay.payment_intent_id AS payment_intent_id
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        LEFT JOIN products p ON oi.product_id = p.id
        LEFT JOIN product_images pi ON oi.product_id = pi.product_id
        LEFT JOIN payments pay ON o.order_id = pay.order_id        
        WHERE o.buyer_id=?";
    
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize an array to store order data and associated items
        $orders = array();
        $order_item_ids = array();
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];

            // Initialize the order array if not already created
            if (!isset($orders[$order_id])) {
                $orders[$order_id] = array(
                    'order_id' => $order_id,
                    'buyer_id' => $row['buyer_id'],
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'addr' => $row['addr'],
                    'phone' => $row['phone'],
                    'promo_code' => $row['promo_code'],
                    'total' => $row['total'],
                    'order_status' => $row['order_status'],
                    'created_at' => $row['order_created_at'],
                    'items' => array(),
                    'payment' => array()
                );
            }

            if(!in_array($row['item_id'], $order_item_ids)) { 
                if ($row['item_id']) {
                    $orders[$order_id]['items'][] = array(
                        'item_id' => $row['item_id'],
                        'product_id' => $row['product_id'],
                        'product_size' => $row['product_size'],
                        'product_title' => $row['product_title'],
                        'qty' => $row['product_qty'],
                        'product_description' => $row['product_description'],
                        'product_regular_price' => $row['product_regular_price'],
                        'product_sale_price' => $row['product_sale_price'],
                        'product_created_at' => $row['product_created_at'],
                        'image_filename_sm' => $row['image_filename_sm'],
                        'image_filename_md' => $row['image_filename_md'],
                        'image_filename_lg' => $row['image_filename_lg'],
                    );

                    array_push($order_item_ids, $row['item_id']);
                }
            }


            if ($row['order_status'] == 'Paid') {
                $orders[$order_id]['payment'][] = array(
                    'payment_id' => $row['payment_id'],
                    'checkout_session_id' => $row['checkout_session_id'],
                    'payment_intent_id' => $row['payment_intent_id']
                );
            }
        }
        
        // Now $orders contains the orders with associated items, product details, and images
        return $orders;
    }


    public function order_summary() {
        $items_total = 0.00;
        $delivery_fee = 0.00;
        $total = 0.00;

        if(isset($_SESSION['cart'])) {
            $cart_products = json_decode($_SESSION['cart'], true);
            if(count($cart_products) > 0) {
                foreach($cart_products as $product) {
                    $unit_price = $product['price'];
                    $qty = $product['qty'];
        
                    $items_total += floatval($unit_price) * intval($qty);
                }
        
                $delivery_fee = 10.00;
                $total = $items_total + $delivery_fee;
        
                $total = number_format($total, 2, '.', '');
                $items_total = number_format($items_total, 2, '.', '');
            }
        }

        echo "<div class='order-summary'>
            <div class='order-info-title'>
                Order Summary
            </div>
            <div class='order-info-row'>
                <span>Items Total</span>
                <span>$".$items_total."</span>
            </div>
            <div class='order-info-row'>
                <span>Delivery Fee</span>
                <span>$".$delivery_fee."</span>
            </div>
            <div class='order-info-row'>
                <span>Total Payment</span>
                <span>$".$total."</span>
            </div>
        </div>";
    }
    public function order_details($order_id) {
        $order = $this->get_order($order_id);

        // var_dump($order);
    
        // $payment = $this->get_booking_payment($booking['payment_intent_id']);
        // $payment_id = $payment['id'];
        // $transaction_id = $payment['transaction_id'];
        // $address = $payment['address'];

        // Product
        $title = $order['items'][0]['product_title'];
        $size = $order['items'][0]['product_size'];
        $img_sm = $order['items'][0]['image_filename_sm'];

        // Order
        $total = $order['total'];
        $ordered_date = convertDateFormat($order['created_at']);

        $firstRow = "
        <li class ='li-group-item'>
            <div class='c-left'>
                <div class='thumbnail'>
                    <img src='./uploads/{$img_sm}' alt=''>
                </div>
                <span>
                    $title
                </span>
            </div>
            <div>$"."{$total}</div>
        </li>";
    
        // Constructing gig details HTML
        $orderDetailsStr = "<div class='details-outer-container'>
        <div class='details-wrapper' id='{$order['order_id']}'>
            <div class='details-row' id='{$order['order_id']}'>
                <div class='details-column'>
                    <div class='details-column-header'>
                        <div class='details-column-title'>
                            Buyer Order Details
                        </div>
                    </div>
                    <ul class ='list-group details-list'>
                        $firstRow
                        <li class ='li-group-item'>
                            <div><strong>Buyer Name</strong></div>
                            <div>{$order['fullname']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Transaction Id</strong></div>
                            <div>7s448ag4838457</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Address</strong></div>
                            <div>{$order['addr']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Status</strong></div>
                            <div>{$order['order_status']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Ordered Date</strong></div>
                            <div>{$ordered_date}</div>
                        </li>
                    </ul>
                </div>
                <span class='btns'>
                    <span class='btn admin-btn-1' onclick='closePopup()'>
                        Go Back
                    </span>
                </span>
            </div>
        </div>
        </div>";
    
        echo $orderDetailsStr;
    }

    public function orders_total() {
        $sql = "SELECT total FROM orders";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders_total = 0;

        while ($row = $result->fetch_assoc()) {
            $total = $row['total'];
            $orders_total += $total;
        }
        return $orders_total;
    }
    public function my_orders_total() {
        $buyer_id = get_uid();

        $sql = "SELECT total FROM orders WHERE buyer_id=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $buyer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $my_orders_total = 0;

        while ($row = $result->fetch_assoc()) {
            $total = $row['total'];
            $my_orders_total += $total;
        }

        return $my_orders_total;
    }
    public function my_collection() {
        $orders = $this->get_my_orders();

        $orders_total = $this->orders_total();

        $itemStr = "";

        foreach($orders as $key => $value) {
            $order = $value;
            // var_dump($order);
            
            foreach($order['items'] as $item) {
                $unit_price = $item['product_sale_price'];
                $qty = $item['qty'];
                $item_total = $unit_price * $qty;

                $item_percentage = percentage($item_total, $orders_total);

                $image_filename = $item['image_filename_sm'];
                
                $itemStr .= "<div class='c-row' onclick='get_product_popup(event, \"{$item['product_id']}\")'>
                    <div class='item'>
                        <div class='thumbnail'>
                            <img src='admin/uploads/{$image_filename}' alt=''>
                        </div>
                        <span>{$item['product_title']}</span>
                    </div>
                    <div class='item'>$"."$item_total</div>
                    <div class='item'>$item_percentage%</div>
                </div>";
            }
        }
        echo $itemStr;
    }

    private function get_order_statistics() {
        // Array to hold the results
        $statistics = array(
            'total_orders' => 0,
            'status_counts' => array(
                'Started' => 0,
                'Delivered' => 0,
                'Shipped' => 0,
                'Paid' => 0,
                'Canceled' => 0,
            )
        );
    
        // SQL query to count total orders and orders by status
        $sql = "SELECT 
                    COUNT(*) AS total_orders,
                    SUM(CASE WHEN order_status = 'Started' THEN 1 ELSE 0 END) AS started_count,
                    SUM(CASE WHEN order_status = 'Delivered' THEN 1 ELSE 0 END) AS delivered_count,
                    SUM(CASE WHEN order_status = 'Shipped' THEN 1 ELSE 0 END) AS shipped_count,
                    SUM(CASE WHEN order_status = 'Paid' THEN 1 ELSE 0 END) AS paid_count,
                    SUM(CASE WHEN order_status = 'Canceled' THEN 1 ELSE 0 END) AS canceled_count
                FROM orders";
    
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch the result
        if ($row = $result->fetch_assoc()) {
            $statistics['total_orders'] = $row['total_orders'];
            $statistics['status_counts']['Started'] = $row['started_count'];
            $statistics['status_counts']['Delivered'] = $row['delivered_count'];
            $statistics['status_counts']['Shipped'] = $row['shipped_count'];
            $statistics['status_counts']['Paid'] = $row['paid_count'];
            $statistics['status_counts']['Canceled'] = $row['canceled_count'];
        }
    
        $stmt->close();
    
        // Return the statistics array
        return $statistics;
    }
    
    function order_cards() {
        $stats = $this->get_order_statistics();

        $total_orders = $stats['total_orders'];
        $delivered = $stats['status_counts']['Delivered'];
        $shipped = $stats['status_counts']['Shipped'];
        $paid = $stats['status_counts']['Paid'];

        echo "<div class='cards'>
            <div class='card'>
                <div class='text'>
                    <p class='title'>Total Orders</p>
                    <p class='value'>$total_orders</p>
                </div>
                <div class='icon-wrapper'>
                    <div class='icon'>
                        <img src='assets/order-icons/total-orders.svg?v=2' alt=''>
                    </div>
                </div>
            </div>
            <div class='card'>
                <div class='text'>
                    <p class='title'>Delivered</p>
                    <p class='value'>$delivered</p>
                </div>
                <div class='icon-wrapper'>
                    <div class='icon'>
                        <img src='assets/order-icons/delivered-orders.svg?v=2' alt=''>
                    </div>
                </div>
            </div>
            <div class='card'>
                <div class='text'>
                    <p class='title'>Shipped</p>
                    <p class='value'>$shipped</p>
                </div>
                <div class='icon-wrapper'>
                    <div class='icon'>
                        <img src='assets/order-icons/shipped-orders.svg?v=2' alt=''>
                    </div>
                </div>
            </div>
            <div class='card'>
                <div class='text'>
                    <p class='title'>Paid</p>
                    <p class='value'>$paid</p>
                </div>
                <div class='icon-wrapper'>
                    <div class='icon'>
                        <img src='assets/order-icons/paid-orders.svg?v=2' alt=''>
                    </div>
                </div>
            </div>
        </div>";
    }
    // Admin
    function orders_table_header($isIndex=false) {
        if($isIndex == false) {
            return "<div class='content-inner scrollable-div'>
            <div class='content'>
                <div class='header'>
                    <div class='item'>Product name</div>
                    <div class='item'>Buyer</div>
                    <div class='item'>Price</div>
                    <div class='item'>Size</div>
                    <div class='item'>Delivery Date</div>
                    <div class='item'>Status</div>
                    <div class='item'>Notify</div>
                    <div class='item'>Edit</div>
                </div>
                <div class='body'>
                    <div class='rows'>";
        } else {
            return "<div class='content-inner scrollable-div'>
                <div class='content'>
                    <div class='header'>
                        <div class='item'>Product name</div>
                        <div class='item'>Buyer</div>
                        <div class='item'>Price</div>
                        <div class='item'>Size</div>
                        <div class='item'>Delivery Date</div>
                        <div class='item'>Status</div>
                        <div class='item'>Notify</div>
                        <div class='item'>Edit</div>
                    </div>";
        }
    }
    function orders_table_footer() {
        return "</div>
                </div>
            </div>
        </div>";
    }
    function orders_row_html($order_array, $isIndex = false) {

        // Order
        $order_id = $order_array['order_id'];
        $fullname = $order_array['fullname'];
        $total = $order_array['total'];
        $created_at = convertDateFormat($order_array['created_at']);

        // Product
        $title = $order_array['items'][0]['product_title'];
        $size = $order_array['items'][0]['product_size'];
        $img_sm = $order_array['items'][0]['image_filename_sm'];

        if($order_array['order_status'] == 'Shipped') {
            $selectedStatus = "<div class='select-selected shipped'>
                Shipped
            </div>";
        } else if($order_array['order_status'] == 'Started') {
            $selectedStatus = "<div class='select-selected paid'>
                Started
            </div>";  
        } else if($order_array['order_status'] == 'Paid') {
            $selectedStatus = "<div class='select-selected paid'>
                Paid
            </div>";  
        } else if($order_array['order_status'] == 'Delivered') {
            $selectedStatus = "<div class='select-selected delivered'>
                Delivered
            </div>";
        }
        
        return "<div class='c-row' id='order-id-{$order_id}'>
            <div class='item'>
                <div class='thumbnail'>
                    <img src='./uploads/{$img_sm}' alt=''>
                </div>
                <span>$title</span>
            </div>
            <div class='item'>$fullname</div>
            <div class='item'>$".$total."</div>
            <div class='item'>$size</div>
            <div class='item'>$created_at</div>
            <div class='item'>


                <div class='custom-select-2'>
                    $selectedStatus
                    <div class='select-items'>
                        <div onclick='update_order_status(this, \"Shipped\", \"$order_id\")' class='shipped'>Shipped</div>
                        <div onclick='update_order_status(this, \"Paid\", \"$order_id\")' class='paid'>Paid</div>
                        <div onclick='update_order_status(this, \"Delivered\", \"$order_id\")' class='delivered'>Delivered</div>
                    </div>
                </div>

            </div>
            
            <div class='item'>
                <img class='img-notify' src='assets/notification-on.svg' alt=''>
            </div>
            <div class='item' onclick='get_popup_content_order(\"$order_id\")'>
                <img src='./assets/edit.svg' alt=''>
            </div>
        </div>";
    }

    public function orders_admin($isIndex = false) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Get array of arrays
        $orders_array = $this->get_orders();

        // var_dump($orders_array);
    
        $num_of_rows = count($orders_array);
    
        $results_per_page = 20;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page order is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        $contentStr .= $this->orders_table_header();
        foreach(array_slice($orders_array, $starting_limit_number, $results_per_page) as $key => $value) {
            $order_array = $value;
            $contentStr .= $this->orders_row_html($order_array);
        }
        $contentStr .= $this->orders_table_footer();
    
        // // Previous & next page
        // $prev = ($page == 1) ? $page : ($page - 1);
        // $next = ($page == $num_of_pages) ? $page : ($page + 1);
    
        // $paging = "<div class='pagination'>
        //     <div>
        //         <a class='page-num arrow' href='./$pagename?page=" . ($page > 1 ? ($page - 1) : 1) . "'>
        //             <i class='fas fa-arrow-left'></i>
        //         </a>
        //     </div>
        //     <div class='pagination-links'>";
    
        // // Show links only if there is more than one page
        // if ($num_of_pages > 1) {
        //     // Show the current page and links for next 2 pages
        //     for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
        //         if ($p != $page) {
        //             $paging .= "<a class='page-num' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
        //         } else {
        //             $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
        //         }
        //     }
        //     // Skip links for 2 pages
        //     if ($page + 5 < $num_of_pages) {
        //         $paging .= "<span>...</span> ";
        //     }
        //     // Show the link for the 6th page if available
        //     if ($page + 4 < $num_of_pages) {
        //         $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 4) . "'>" . ($page + 4) . "</a> ";
        //     } else if ($page + 3 < $num_of_pages) {
        //         $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 3) . "'>" . ($page + 3) . "</a> ";
        //     }
        // } else {
        //     // If there's only one page, show the link for the current page and previous/next page links
        //     $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $page . "'>" . $page . "</a> ";
        // }
    
        // $paging .= "</div>
        //     <div>
        //         <a class='page-num arrow arrow-right' href='./$pagename?page=" . ($page < $num_of_pages ? ($page + 1) : $num_of_pages) . "'>
        //             <i class='fas fa-arrow-right'></i>
        //         </a>
        //     </div>
        // </div>";
    
        // $contentStr .= $paging;


        echo $contentStr;
    }
    /*
    =================================================================
        SEARCH
    =================================================================  
    */
    public function get_searched_orders($search) {
        $sql = "SELECT 
        o.order_id,
        o.buyer_id,
        o.fullname,
        o.email,
        o.addr,
        o.phone,
        o.total,
        o.order_status,
        o.promo_code,
        o.created_at AS order_created_at,
            oi.product_id,
            oi.product_size,
            p.title AS product_title,
            p.description AS product_description,
            p.regular_price AS product_regular_price,
            p.sale_price AS product_sale_price,
            p.created_at AS product_created_at,
            pi.image_filename_sm,
            pi.image_filename_md,
            pi.image_filename_lg,
            pay.pid AS payment_id,
            pay.id AS checkout_session_id,
            pay.payment_intent_id AS payment_intent_id
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        LEFT JOIN products p ON oi.product_id = p.id
        LEFT JOIN product_images pi ON oi.product_id = pi.product_id
        LEFT JOIN payments pay ON o.order_id = pay.order_id";

        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize an array to store order data and associated items
        $orders = array();
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];

            // Initialize the order array if not already created
            if (!isset($orders[$order_id])) {
                $orders[$order_id] = array(
                    'order_id' => $order_id,
                    'buyer_id' => $row['buyer_id'],
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'addr' => $row['addr'],
                    'phone' => $row['phone'],
                    'promo_code' => $row['promo_code'],
                    'total' => $row['total'],
                    'order_status' => $row['order_status'],
                    'created_at' => $row['order_created_at'],
                    'items' => array(),
                    'payment' => array()
                );
            }

            // Add item details to the order
            if ($row['product_id']) {
                $orders[$order_id]['items'][] = array(
                    'product_id' => $row['product_id'],
                    'product_size' => $row['product_size'],
                    'product_title' => $row['product_title'],
                    'product_description' => $row['product_description'],
                    'product_regular_price' => $row['product_regular_price'],
                    'product_sale_price' => $row['product_sale_price'],
                    'product_created_at' => $row['product_created_at'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg'],
                );
            }


            // if ($row['order_status'] == 'Paid') {
                if (isset($row['payment_id'])) {
                    $orders[$order_id]['payment'][] = array(
                        'payment_id' => $row['payment_id'],
                        'checkout_session_id' => $row['checkout_session_id'],
                        'payment_intent_id' => $row['payment_intent_id']
                    );
                }
            // }
        }

        // Filter the results
        $filtered_data = array_filter($orders, function($item) use ($search) {
            $search = strtolower($search);
            $fullname = strtolower($item['fullname']);

            $match = strpos($fullname, $search);

            if ($match === false) {
                return false;
            }
            return true; // Include item in the filtered results
        });

        return $filtered_data;
    }
    public function searched_orders($search) {        
        // Get array of arrays
        $orders_array = $this->get_searched_orders($search);
        // var_dump($orders_array);
        
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        $num_of_rows = count($orders_array);
    
        $results_per_page = 20;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page order is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        foreach(array_slice($orders_array, $starting_limit_number, $results_per_page) as $key => $value) {
            $order_array = $value;
            $contentStr .= $this->orders_row_html($order_array);
        }

        echo $contentStr;
    }
}