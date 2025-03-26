<?php

namespace MyApp\Classes;

use Twilio\Rest\Client;


class Newsletter extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    function checkContactType($input) {
        // Check if it's an email
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }
    
        // Check if it's a phone number (supports various formats)
        if (preg_match('/^\+?[0-9]{7,15}$/', $input)) {
            return 'phone';
        }
    
        return 'invalid';
    }
    
    function create_subscriber_message() {
        $subscriber_id = $_POST['subscriber_id'];
        $type = $_POST['type']; // Expecting 'phone' or 'email'
        $title = $_POST['title'];
        $content = $_POST['content'];
        $created_at = datetime_now();
        $status = '1';
        $subscriber_row_html = '';
    
        if ($subscriber_id != 'false') {
            // Insert message for a single subscriber
            $stmt = $this->con->prepare('INSERT INTO subscriber_message (subscriber_id, title, content, created_at) VALUES (?, ?, ?, ?)');
            if (!$stmt) {
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
            }
            $stmt->bind_param('isss', $subscriber_id, $title, $content, $created_at);
            if ($stmt->execute()) {
                $subscriber_message_id = $stmt->insert_id;
                $subscriber = $this->get_subscriber($subscriber_id);
                $subscriber_row_html = $this->subscribers_row_html($subscriber, $type);
            } else {
                $status = '0';
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }
            $stmt->close();
        } else {
            // {"status":"0","subscriber_id":"false","html":""}
            $subscribers = $this->get_subscribers_by_type($type);
            // var_dump($subscribers);
            if (!empty($subscribers)) {
                $i = 0;
                    
                foreach ($subscribers as $subscriber) {
                    $stmt = $this->con->prepare('INSERT INTO subscriber_message (subscriber_id, title, content, created_at) VALUES (?, ?, ?, ?)');
                    if (!$stmt) {
                        die('prepare() failed: ' . htmlspecialchars($this->con->error));
                    }
                    $stmt->bind_param('isss', $subscriber['id'], $title, $content, $created_at);
                    if (!$stmt->execute()) {
                        $status = '0';
                        die('execute() failed: ' . htmlspecialchars($stmt->error));
                    } else {
                        if($i < 20) {
                            $subscriber['message']['title'] = $title;
                            $subscriber['message']['content'] = $content;
                            
                            $subscriber_row_html .= $this->subscribers_row_html($subscriber, $type);
                        }
                        
                    }
                    $stmt->close();
                    
                    $i+=1;
                }
            } else {
                $status = '0'; // No subscribers found for the given type
            }
        }
    
        echo json_encode(
            array(
                'status' => $status,
                'subscriber_id' => $subscriber_id,
                'html' => $subscriber_row_html
            ),
            true
        );
    }
    
    public function add_to_mailing_list() {
        // $email = $_POST['email'];
        $phone = $_POST['email'];
        $subscriber_status = 'pending';
        $notification = ($_POST['notification'] == '2') ? 'Yes' : 'No';

        // var_dump($email, $notification);
        $subscriber_type = $this->checkContactType($phone);
        $created_at = datetime_now();
                
        // $stmt = $this->con->prepare("INSERT INTO subscribers(email, subscriber_type, subscriber_status, created_at, notify) VALUES (?, ?, ?, ?, ?)");
        // $stmt->bind_param("sssss", $email, $subscriber_type, $subscriber_status, $created_at, $notification);
        $stmt = $this->con->prepare("INSERT INTO subscribers(phone, subscriber_type, subscriber_status, created_at, notify) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $phone, $subscriber_type, $subscriber_status, $created_at, $notification);
        if($stmt->execute()) {   
            $status = '1';  
            $subscriber_id = $stmt->insert_id;  

            if($subscriber_type == 'phone') {

                $config = '../config.php';

                $sid = $config['SID'];
                $token = $config['TOKEN'];
                $verifyServiceSid = $config['VERIFIED_SERVICE_ID'];


                // $phone = "+8801886898669";
                $phone = $_POST['email'];
                
                $twilio = new Client($sid, $token);
                
                try {
                    $verification = $twilio->verify->v2
                        ->services($verifyServiceSid)
                        ->verifications->create($phone, "sms");
                
                    // echo "Verification sent to $phone!";
                } catch (\Twilio\Exceptions\RestException $e) {
                    echo "Error: " . $e->getMessage();
                }
    
                // Get the verificationSid from the response
                $verificationSid = $verification->sid;
    
                $_SESSION['verify'] = json_encode(
                    array(
                        'verification_sid' => $verificationSid,
                        'phone' => $phone
                    )
                );
                
            } else if($subscriber_type == 'email') {
                    // Create + Insert code
                    $code = $this->generate_email_code($subscriber_id);

                if(
                    $_SERVER['SERVER_NAME'] != 'localhost' &&
                    $_SERVER['SERVER_NAME'] != 'sql100.infinityfree.com'
                ) {
                    // Email Content
                    $subject = 'Verification Code';
                    $msgBody = "<p>This is your code: </p>
                    <h4>$code</h4>";
                    $_SESSION['code'] = $code;
                    // $smtp_details = $this->smtp_details();
        
                    // $host = $smtp_details['smtp_host'];
                    // $encryption = $smtp_details['smtp_encryption'];
                    // $port = $smtp_details['smtp_port'];
                    // $username = $smtp_details['username'];
                    // $pwd = $smtp_details['pwd'];
                    
                    // $this->sendEmailPHPMailer($host, $port, $encryption, $username, $pwd, $_POST['email'], $subject, $msgBody);
                    
                }
            }

        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        echo $status;
    }

    
    public function generate_email_code($subscriber_id) {
        // Generate a 6-digit code
        $code = mt_rand(100000, 999999);
        
        // Calculate the expiration time (30 minutes from now)
        $expires = date("U") + 1800;
        
        // Prepare the SQL statement
        $stmt = $this->con->prepare("INSERT INTO email_verify (subscriber_id, code, expires) VALUES (?, ?, ?)");
        
        // Bind parameters to the statement
        $stmt->bind_param("iss", $subscriber_id, $code, $expires);
        // Execute the statement
        $stmt->execute();
        
        // Close the statement and database connection
        $stmt->close();
        
        // Return the generated code
        return $code;
    }
    public function verify_code() {
        $config = '../config.php';

        $sid = $config['SID'];
        $token = $config['TOKEN'];
        $verifyServiceSid = $config['VERIFIED_SERVICE_ID'];
    
        $code = $_POST['code'];
    
        $twilio = new Client($sid, $token);
    
        // Get the verification data from the session
        $verify = json_decode($_SESSION['verify'], true);
        $phone = $verify['phone'];
    
        try {
            // Verify the entered code
            $verification = $twilio->verify->v2->services($verifyServiceSid)
                ->verificationChecks
                ->create([
                    'code' => $code,  // Pass the code correctly as part of the array
                    'to' => $phone   // Optionally, pass the phone number to verify against
                ]);
    
            // Output the verification status
            echo $verification->status;
    
            // Check if the verification is successful
            if ($verification->status == 'approved') {
                $subscriber_status = $verification->status;
                $this->update_subscriber_status($phone, $subscriber_status);
            }
        } catch (\Twilio\Exceptions\RestException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    public function update_subscriber_status($phone, $subscriber_status) {
        $updateStmt = $this->con->prepare("UPDATE subscribers SET subscriber_status = ? WHERE phone = ?");
        $updateStmt->bind_param("ss", $subscriber_status, $phone);
        $updateStmt->execute();
        $updateStmt->close();
    }
    public function get_subscribers() {
        $subscribers = array();
    
        $sql = "SELECT 
            subscribers.id AS subscriber_id,
            subscribers.email AS subscriber_email,
            subscribers.created_at AS subscriber_created_at,
            subscribers.notify,
            users.id AS user_id,
            users.fullname AS user_fullname,
            users.email AS user_email,
            subscriber_message.id AS message_id,
            subscriber_message.title AS message_title,
            subscriber_message.content AS message_content
        FROM 
            subscribers
        LEFT JOIN 
            users ON subscribers.email = users.email
        LEFT JOIN 
            subscriber_message ON subscribers.id = subscriber_message.subscriber_id
        WHERE 
        subscriber_message.id IN (
            SELECT MAX(id) 
            FROM subscriber_message 
            GROUP BY subscriber_id
        )
        ORDER BY subscriber_id DESC";
    
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        foreach ($data as $row) {
            $subscriber = array(
                'id' => $row['subscriber_id'],
                'email' => $row['subscriber_email'],
                'created_at' => $row['subscriber_created_at'],
                'notify' => $row['notify'],
                'user' => array(),
                'message' => array()
            );
    
            if (!empty($row['message_id'])) {
                $subscriber['message'] = array(
                    'message_id' => $row['message_id'],
                    'title' => $row['message_title'],
                    'content' => $row['message_content']
                );
            }
    
            if (!empty($row['user_id'])) {
                $subscriber['user'] = array(
                    'id' => $row['user_id'],
                    'fullname' => $row['user_fullname'],
                    'email' => $row['email'],
                    'photo' => $row['photo']
                );
            }
    
            array_push($subscribers, $subscriber);
        }
    
        return $subscribers;
    }
    public function get_subscribers_by_type($type) {
        $subscribers = array();
    
        $sql = "SELECT 
            subscribers.id AS subscriber_id,
            subscribers.email AS subscriber_email,
            subscribers.phone AS subscriber_phone,
            subscribers.subscriber_type AS subscriber_type,
            subscribers.created_at AS subscriber_created_at,
            subscribers.notify,
            -- users.id AS user_id,
            -- users.fullname AS user_fullname,
            -- users.email AS user_email,
            subscriber_message.id AS message_id,
            subscriber_message.title AS message_title,
            subscriber_message.content AS message_content
        FROM 
            subscribers
        -- LEFT JOIN 
        --     users ON subscribers.email = users.email
        LEFT JOIN subscriber_message ON subscribers.id = subscriber_message.subscriber_id AND subscriber_message.id IN (
            SELECT MAX(id) FROM subscriber_message GROUP BY subscriber_id
        )
        and subscriber_type = ?
        ORDER BY subscriber_id DESC";
    
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        $stmt->bind_param('s', $type);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        foreach ($data as $row) {
            if(
                $type == 'phone' && isset($row['subscriber_phone']) ||
                $type == 'email' && isset($row['subscriber_email'])
            ) {
             
            $subscriber = array(
                'id' => $row['subscriber_id'],
                'email' => $row['subscriber_email'],
                'phone' => $row['subscriber_phone'],
                'created_at' => $row['subscriber_created_at'],
                'notify' => $row['notify'],
                'user' => array(),
                'message' => array()
            );
    
            if (!empty($row['message_id'])) {
                $subscriber['message'] = array(
                    'message_id' => $row['message_id'],
                    'title' => $row['message_title'],
                    'content' => $row['message_content']
                );
            }
    
            // if (!empty($row['user_id'])) {
            //     $subscriber['user'] = array(
            //         'id' => $row['user_id'],
            //         'fullname' => $row['user_fullname'],
            //         'email' => $row['email'],
            //         'photo' => $row['photo']
            //     );
            // }
    
            array_push($subscribers, $subscriber);
               
        }
        }
    
        return $subscribers;
    }
    public function get_subscriber($subscriber_id) {
        $sql = "SELECT 
            subscribers.id AS subscriber_id,
            subscribers.email AS subscriber_email,
            subscribers.phone AS subscriber_phone,
            subscribers.created_at AS subscriber_created_at,
            subscribers.notify,
            users.id AS user_id,
            users.fullname AS user_fullname,
            users.email AS user_email,
            subscriber_message.id AS message_id,
            subscriber_message.title AS message_title,
            subscriber_message.content AS message_content
        FROM 
            subscribers
        LEFT JOIN 
            users ON subscribers.email = users.email
        LEFT JOIN 
            subscriber_message ON subscribers.id = subscriber_message.subscriber_id
        WHERE 
            subscriber_id = ?";
    
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        $stmt->bind_param('i', $subscriber_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        foreach ($data as $row) {
            $subscriber = array(
                'id' => $row['subscriber_id'],
                'email' => $row['subscriber_email'],
                'phone' => $row['subscriber_phone'],
                'created_at' => $row['subscriber_created_at'],
                'notify' => $row['notify'],
                'user' => array(),
                'message' => array()
            );
    
            if (!empty($row['message_id'])) {
                $subscriber['message'] = array(
                    'message_id' => $row['message_id'],
                    'title' => $row['message_title'],
                    'content' => $row['message_content']
                );
            }
    
            if (!empty($row['user_id'])) {
                $subscriber['user'] = array(
                    'id' => $row['user_id'],
                    'fullname' => $row['user_fullname'],
                    'email' => $row['email'],
                    'photo' => $row['photo']
                );
            }
        }
    
        return $subscriber;
    }
    function subscribers_table_header($type) {
        
        if($type == 'email') {
            $contact = 'Email';
        } else {
            $contact = 'Phone';
        }


        return "<div class='content-inner scrollable-div'>
            <div class='content'>
                <div class='header'>
                    <div class='item'>Buyers</div>
                    <div class='item'>$contact</div>
                    <div class='item'>Message</div>
                    <div class='item'>Notify</div>
                    <div class='item'>Edit</div>
                </div>
                <div class='body'>
                    <div class='rows'>";
    }
    function subscribers_table_footer() {
        return "</div></div></div></div>";
    }
    function subscribers_row_html($subscriber, $type) {
        
        $fullname = "";
        $avatar = "../assets/avi.png";
        $content = "";
        $notify_btn = "";

        // var_dump($subscriber);
        
        if(isset($subscriber['user']['fullname'])) {
            $fullname = $subscriber['user']['fullname'];
            $avatar = '../assets/avatars/' . $subscriber['user']['photo'];
        }
        if(isset($subscriber['message']['content'])) {
            // $title = $subscriber['user']['title'];
            $content = segment($subscriber['message']['content'], 30);
        }
        
        if($subscriber['notify'] == 'Yes') { 
            $notify_btn = "<img data-id='{$subscriber['id']}' class='img-notify mCS_img_loaded' src='assets/notification-on.svg' alt=''>";
        }

        if($type == 'email') {
            $contact = $subscriber['email'];
        } else {
            $contact = $subscriber['phone'];
        }
        
        $output = "";
    
        $output .= "<div class='c-row' id='subscriber-{$subscriber['id']}'>
            <div class='item'>
                <div class='thumbnail'>
                    <img src='{$avatar}' alt=''>
                </div>
                {$fullname}
            </div>
            <div class='item'>{$contact}</div>
            <div class='item'>{$content}</div>
            <div class='item'>
                $notify_btn
            </div>
            <div class='item'>
                <button onclick='create_newsletter_message_popup(\"{$subscriber['id']}\")' class='compose-button' data-id='{$subscriber['id']}'>
                    <img src='./assets/compose.svg' alt=''>
                    Compose
                </button>
            </div>
        </div>";
    
        return $output;
    }
    public function subscribers_admin($type, $isIndex = false) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Fetch the array of subscribers
        $subscribers_array = $this->get_subscribers_by_type($type); // Replace with your method to fetch subscribers
    
        $num_of_rows = count($subscribers_array);
    
        // Results per page
        $results_per_page = 20;
    
        // Calculate the total number of pages
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine the current page
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        // Calculate the starting point for the current page
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        // Initialize content
        $contentStr = "";
    
        // Add the table header
        $contentStr .= $this->subscribers_table_header($type);
    
        // Add rows for the current page
        foreach (array_slice($subscribers_array, $starting_limit_number, $results_per_page) as $subscriber) {
            $contentStr .= $this->subscribers_row_html($subscriber, $type);
        }
    
        // Add the table footer
        $contentStr .= $this->subscribers_table_footer();
    
        // Add pagination links
        $contentStr .= "<div class='pagination'>";
    
        if ($num_of_pages > 1) {
            // Previous page link
            $prev_page = max(1, $page - 1);
            $contentStr .= "<a class='page-num arrow' href='./$pagename?page=$prev_page'>Prev</a>";
    
            // Page number links
            for ($p = 1; $p <= $num_of_pages; $p++) {
                $class = ($p == $page) ? "current-page" : "";
                $contentStr .= "<a class='page-num $class' href='./$pagename?page=$p'>$p</a>";
            }
    
            // Next page link
            $next_page = min($num_of_pages, $page + 1);
            $contentStr .= "<a class='page-num arrow' href='./$pagename?page=$next_page'>Next</a>";
        }
    
        $contentStr .= "</div>";

        // var_dump($contentStr);
    
        // Output the complete table
        echo $contentStr;
    }
    
    
    
}


