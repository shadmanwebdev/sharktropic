<?php


namespace MyApp\Classes;

// create_discount_code()
class StripePayment extends Db {
    public function __construct() {
        $this->stripe_secret = 'sk_test_51HaRBvH4rZ2esk0gVLhm1gau461S79SplnfqILPewecNwf6eL2rx65j8ZEohqd0AJ9ks04FRZAOfJoDIlfd88lJr00iqXh7mM9';
        $this->con = $this->con();
    }
    public function create_checkout_session() {
    
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
    
        


        // // Discount Percentage
        // if(isset($_SESSION['discount_code'])) {
        //     $code = $_SESSION['discount_code'];

        //     $this->find_matching_discount_code($code);
        // }
        
        $line_items = array();
        if(isset($_SESSION['cart'])) {
            $cart_array = json_decode($_SESSION['cart'], true);
            
            // Products loop
            foreach($cart_array as $product) {
                
                $unit_amount = (floatval($product['price']) * intval($product['qty'])) * 100;

                $line_items[] = [
                    'price_data' => [
                        'currency' => 'GBP',
                        'product_data' => [
                            'name' => $product['title']
                        ],
                        'unit_amount' => $unit_amount, // Convert to cents
                    ],
                    'quantity' => intval($product['qty'])
                ];
            }
        }
    
        // Return URLs
        if($_SERVER['SERVER_NAME'] == 'localhost') {
            $base_url = 'http://localhost/sharktropic/';
        } else {
            $base_url = 'https://sharktropic.com/';
        }
        $success_url = $base_url . 'order-confirmation?session_id={CHECKOUT_SESSION_ID}';
        $cancel_url = $base_url . 'cancel';
    
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => $success_url,
            'cancel_url' => $cancel_url
        ]);

        
    
        // var_dump($checkout_session);

        // if(isset($_SESSION['discount_code'])) {
        //     unset($_SESSION['discount_code']);
        // }
    
        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }
    public function checkout_success($session_id) {

        $stripe = new \Stripe\StripeClient($this->stripe_secret);

        try {
            $session = $stripe->checkout->sessions->retrieve($session_id);
            // var_dump($session);
           
            // echo '<pre>' , var_dump($id, $amount, $client_reference_id, $customer_id, $currency, $fullname, $email, $phone, $shipping_address, $city, $country_code, $state, $postal_code) , '</pre>';
            
            $id = $session->id;
            $status = $session->status;
            $fullname = $session->customer_details->name;
            $email = $session->customer_details->email;
            $phone = $session->customer_details->phone;
            $amount = $session->amount_total;
            $currency = $session->currency;
            $address = $session->customer_details->address; // (This is an object with properties like city, country, line1, line2, postal_code, and state.)
            $postalCode = $session->customer_details->address->postal_code;
            $country = $session->customer_details->address->country;
            $customerId = $session->customer;
            $referenceId = $session->client_reference_id;
            $created = $session->created;
            $paymentIntentId = $session->payment_intent;
            // We'll save shipping address in our database
            $shipping_address = $session->custom_text->shipping_address;
            $paymentMethod = 'Stripe';


            // Order id
            if(isset($_SESSION['order'])) {
                $order = json_decode($_SESSION['order'], true);

                $order_id = $order['order_id'];
                $shipping_details = $order['shipping_details'];
                $order_status = $order['status'];
            }
                
            // $this->create_discount_code($totalTimeSlots);

            // var_dump($id, $paymentMethod, $status, $fullname, $email, $phone, $amount, $currency, $shipping_address, $postalCode, $country, $customerId, $referenceId, $created, $paymentIntentId);
            $crPayStatus = $this->create_payment($id, $paymentMethod, $status, $fullname, $email, $phone, $amount, $currency, $shipping_address, $postalCode, $country, $customerId, $referenceId, $created, $paymentIntentId, $order_id);

            return json_encode(['status' => $status]);
        } 
        catch (Error $e) {
            var_dump($e);
            http_response_code(500);
            return json_encode(['error' => $e->getMessage()]);
        }
    }
    public function create_payment($id, $paymentMethod, $status, $fullname, $email, $phone, $amount, $currency, $address, $postalCode, $country, $customerId, $referenceId, $created, $paymentIntentId, $orderId) {

        $sql = "INSERT INTO payments (id, payment_method, `status`, fullname, email, phone, amount, currency, `address`, postal_code, country, customer_id, reference_id, created, payment_intent_id, order_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        $stmt->bind_param("sssssssssssssssi", $id, $paymentMethod, $status, $fullname, $email, $phone, $amount, $currency, $address, $postalCode, $country, $customerId, $referenceId, $created, $paymentIntentId, $orderId);

        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt_adons->error));
            die('execute() failed: ' . htmlspecialchars($stmt_adons->error));
        }
        return $status;

        // Close the statement and connection
        $stmt->close();
        
    }
    public function retrieve($payment_intent_id) {
        // Retrieve a Payment Intent
        $stripe = new \Stripe\StripeClient($this->stripe_secret);        
        $paymentIntent = $stripe->paymentIntents->retrieve($payment_intent_id, []);
        // var_dump($paymentIntent);
        return $paymentIntent;
    }
    // Cancel
    public function cancel($payment_intent_id) {
        /* 
            Only a PaymentIntent with one of the following statuses may be canceled: 
            requires_payment_method, requires_capture, requires_confirmation, requires_action, processing.
        */
        // Cancel a Payment Intent
        $stripe = new \Stripe\StripeClient($this->stripe_secret);
        $paymentIntent = $stripe->paymentIntents->cancel($payment_intent_id, []);
        // var_dump($paymentIntent);
        $paymentIntent = json_encode($paymentIntent, true);
        return $paymentIntent;
    }
    // Refund
    public function refund($checkout_session_id) {

        $stripe = new \Stripe\StripeClient($this->stripe_secret);

        try {
            // Retrieve the checkout session
            $checkoutSession = $stripe->checkout->sessions->retrieve($checkout_session_id);
            
            // Retrieve the payment intent ID from the checkout session
            $payment_intent_id = $checkoutSession->payment_intent;

            // Create a refund
            $refund = $stripe->refunds->create([
                'payment_intent' => $payment_intent_id,
            ]);

            // var_dump($refund);
            $response = array(
                'refund_id' => $refund['id'],
                'status' => $refund['status'],
                'created' => $refund['created']
            );
            // echo 'Refund created: ' . $refund->id;

            return $response;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle the error
            $response = array(
                'refund_id' => $refund['id'],
                'status' => $refund['status'],
                'err_message' => $e->getMessage()
            );

            return $response;
        }

    }
    public function get_payment_by_checkout_session_id($session_id) {
        $sql = "SELECT * FROM payments WHERE id = ? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }
    public function get_payment_by_payment_intent_id($payment_intent_id) {
        $sql = "SELECT * FROM payments WHERE payment_intent_id = ? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $payment_intent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }
    public function get_payment_by_order_id($order_id) {
        $sql = "SELECT * FROM payments WHERE order_id = ? LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }

    public function update_payment_status($payment_id, $status) {
        $sql = "UPDATE payments SET `status` = '$status' WHERE id = ?";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
        }
        $stmt->bind_param("s", $payment_id);
        
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        
        $stmt->close();
        
        return $status;
    }

    // SMTP
    public function smtp_details() {
        $id = 1;
        $stmt = $this->con->prepare("SELECT * FROM smtp_email_setup WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $smtp_details = array(
                        'smtp_host' => $row['smtp_host'],
                        'smtp_encryption' => $row['smtp_encryption'],
                        'smtp_port' => $row['smtp_port'],
                        'username' => $row['username'],
                        'pwd' => $row['pwd']
                    );
                endforeach;
            } 
        }
        $stmt->close();
        return $smtp_details;
    }

    /*
    =================================================================
        PRUCHASE COUNT
    =================================================================  
    */
    public function purchase_row_exists($customer_uid) {
        $stmt = $this->con->prepare("SELECT COUNT(*) as count FROM purchase_count WHERE customer_uid = ?");
        $stmt->bind_param("i", $customer_uid);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0 ? '1' : '0';
    }
    public function get_purchase_count($customer_uid) {
        $stmt = $this->con->prepare("SELECT count FROM purchase_count WHERE customer_uid = ?");
        $stmt->bind_param("i", $customer_uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function create_customer_purchase_row($customer_uid) {
        // Create new row for a customer if there are none
        $sql = "INSERT INTO purchase_count (customer_uid) VALUES (?)";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("i", $customer_uid);

        // Execute the statement
        if($stmt->execute()) {
            $status = "1";
        } else {
            $status = "0";
        }
        $stmt->close();
        
        return $status;

    }
    public function increment_purchase_count($customer_uid, $num) {
        // New purchase made
        $stmt = $this->con->prepare("UPDATE purchase_count SET count = count + $num WHERE customer_uid = ?");
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("i", $customer_uid);
        if($stmt->execute()) {
            $status = "1";
        } else {
            $status = "0";
        }
        $stmt->close();

        return $status;
    }
    /*
    =================================================================
        DISCOUNT CODE
            After account creation / purchase
            -> create_discount_code()

            During purchase
            -> find_matching_discount_code($code)
                -> delete_expired_discount_codes()
                -> Save `id` into session and return `percent`
    =================================================================  
    */
    public function get_discount_codes($customer_uid) {
        $stmt = $this->con->prepare("SELECT * FROM discount_codes WHERE customer_uid = ?");
        $stmt->bind_param("i", $customer_uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function create_discount_code($num) {
        /* 
            We'll create a new discount code 
            1. When new account is created
            2. User completes a purchase 
        */
        $customer_uid = get_uid();
        // Check if customer has an account
        if($customer_uid) {

            $count = $this->purchase_row_exists($customer_uid);
            if($count == 0) {
                // Create new purchase row
                $this->create_customer_purchase_row($customer_uid);
            } else {
                $this->increment_purchase_count($customer_uid, $num);
            }


            // `purchase_count` row already exists
            // $purchase_count = $this->get_purchase_count($customer_uid);
            $ip = $_SERVER['REMOTE_ADDR'];
            $ip_purchase_count = $this->get_purchase_count_by_ip($ip);
            $uid_purchase_count = $this->get_purchase_count($customer_uid);

            $booking = json_decode($_SESSION['booking'], true);
            $address = $booking['address'];
            $address_purchase_count = $this->get_purchase_count_by_address($address);

            /*
                IP > User > Address
                User > IP > Address
                Address > User > IP
            */
            if(
                $ip_purchase_count > $uid_purchase_count && 
                $ip_purchase_count > $address_purchase_count
            ) {
                $purchase_count = $ip_purchase_count;
            } else if(
                $uid_purchase_count > $ip_purchase_count && 
                $uid_purchase_count > $address_purchase_count
            ) {
                $purchase_count = $uid_purchase_count;
            } else if(
                $address_purchase_count > $ip_purchase_count && 
                $address_purchase_count > $uid_purchase_count
            ) {
                $purchase_count = $address_purchase_count;
            } else {
                $purchase_count = $uid_purchase_count;
            }
            
            // Booked Datetimes
            if(isset($_SESSION['datetimes'])) {
                $datetimes_array = json_decode($_SESSION['datetimes'], true);
            } 
            // Number of Re-orders
            $totalTimeSlots = 0;
            foreach ($datetimes_array as $entry) {
                // Increment the total count by the number of times for each date
                $totalTimeSlots += count($entry['times']);
            }

            
            // Based on purchase count we'll set a discount percentage
            $percent = 1; // Default
            if($purchase_count == 0) {
                $percent = 25;
            } else if ($totalTimeSlots >= 4) {
                $percent = 10;
            }
    
            $code = uniqid();
            $validity = future_unix_timestamp(14);
    
            // Create new discount code
            $sql = "INSERT INTO discount_codes (code, customer_uid, percent, validity) VALUES (?, ?, ?, ?)";
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $this->con->error);
            }
            $stmt->bind_param("siii", $code, $customer_uid, $percent, $validity);
    
            // Execute the statement
            if($stmt->execute()) {
                $status = "1";
            } else {
                $status = "0";
            }
            $stmt->close();

            
            $subject = 'SmartlyClean Discount Code';
            $msgBody = "<p>Your discount code is: </p>
            <span class='code'>$code</span>";


            // SMTP Details
            $smtp_details = $this->smtp_details();

            $host = $smtp_details['smtp_host'];
            $encryption = $smtp_details['smtp_encryption'];
            $port = $smtp_details['smtp_port'];
            $username = $smtp_details['username'];
            $pwd = $smtp_details['pwd'];

            // Email
            $email = get_user_email();

            // Send Email
            // sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $email, $subject, $msgBody);
            $status = '1';
            
            
            return $status;
        }

    }
    public function delete_expired_discount_codes() {
        $customer_uid = get_uid();
        // Check if customer has an account
        if($customer_uid) {
            // Current time
            $current_timestamp = current_unix_timestamp();
            // Discount codes for this customer
            $discount_codes_array = $this->get_discount_codes($customer_uid);
            // Loop
            foreach($discount_codes_array as $discount_code_array) {
                // Compare the timestamps
                if ($current_timestamp > $discount_code_array['validity']) {
                    // Discount Code Id
                    $discount_code_id = $discount_code_array['id'];
                    // Delete
                    $sql = "DELETE FROM discount_codes WHERE id = ?";
                    $stmt = $this->con->prepare($sql);
                    $stmt->bind_param("i", $discount_code_id);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }
    public function discount_code_exists($code) {
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }

        // Delete Expired Codes
        $this->delete_expired_discount_codes();

        $customer_uid = get_uid();

        if($customer_uid) {
            $stmt = $this->con->prepare("SELECT * FROM discount_codes WHERE customer_uid = ? AND code=? LIMIT 1");
            $stmt->bind_param("is", $customer_uid, $code);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(count($data) == 1) {
                // Current time
                $current_timestamp = current_unix_timestamp();
                // Discount codes for this customer
                $discount_codes_array = $this->get_discount_codes($customer_uid);

                // Compare the timestamps
                if ($current_timestamp > $data[0]['validity']) {
                    $status = '1';
                } else {
                    $status = '2'; 
                }
            } else {
                $status = '0';
            }
        } else {
            $status = '3';
        }

        return $status;
    }
    public function find_matching_discount_code($code) {
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }

        // Delete Expired Codes
        $this->delete_expired_discount_codes();

        $customer_uid = get_uid();

        if($customer_uid) {
            $stmt = $this->con->prepare("SELECT * FROM discount_codes WHERE customer_uid = ? AND code=? LIMIT 1");
            $stmt->bind_param("is", $customer_uid, $code);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(count($data) == 1) {
                return $data[0]['percent'];
                $_SESSION['discount_code_id'] = $data[0]['id'];
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

}



?>