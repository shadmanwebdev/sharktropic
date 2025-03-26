<?php
/*
=================================================================
    SESSIONS & COOKIES
    CRUD (create, read, update, delete, login)
    DISPLAY
    LOGIN / LOGOUT
    ADMIN
    ORDER verify_email(
=================================================================  
*/

namespace MyApp\Classes; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    
    public function updateUserForm($isAdmin=false) {
        $id = get_uid();
        $user_array = $this->get_user($id);

        
        $fullname = $user_array['fullname'];
        $email = $user_array['email'];
        $photo = isset($user_array['photo']) ? './images/'.$user_array['photo'] : './assets/'."avi.png";
        
        if($isAdmin==true) {
            $photo = isset($user_array['photo']) ? '../images/'.$user_array['photo'] : '../assets/'."avi.png";
        }

        if($isAdmin==true) {
    
            $cross = "<div style='right: 25px; top: 25px;' id='cross' onclick='closePopup()'>
                <img src='assets/cross.svg' alt=''>
            </div>";
        } else if ($isAdmin==false) {
    
            $cross = "<div style='right: 25px; top: 45px;' id='cross' onclick='closePopup()'>
                <img src='assets/cross.svg' alt=''>
            </div>";
        }

        echo "<form runat='server' action='' id='signup-form'>
            <div class='form-header'>
                <h2>My Account</h2>
            </div>
            $cross
            <input type='hidden' id='update_user' name='update_user' value='true'>
                
            <div class='choose-photo' style='margin-bottom: 10px;'>
                <div class='profile-placeholder'>
                    <div id='err'>Error</div>
                    <img src='$photo' alt=''>
                </div>   
                <div id='selected-img'>
                    <img id='img-preview' src='' alt='' />     
                </div>  
            </div>
            <div id='img-error'></div>

            <div class='register-btn-wrapper' style='margin-bottom: 30px;'>
                <button id='pfpBtn' onclick='return fireButton(event);'>Choose File</button>      
                <input class='input' id='image' type='file' name='image' style='display: none;'>
            </div>

            <!-- <h4 class='form-heading'>Create Account</h4> -->
            <div class='input-wrapper' id='name-wrapper-1'>
                <input name='name' id='name-field-1' type='name' class='input-field' placeholder='Your full name' value='$fullname'>
                <div id='name-error-1' class='error-text'></div>
            </div>
            <div class='input-wrapper' id='email-wrapper-3'>
                <input name='email' id='email-field-3' type='email' class='input-field' placeholder='Enter your email' value='$email'>
                <div id='email-error-3' class='error-text'></div>
            </div>
            <div class='input-wrapper' id='pwd-wrapper-2'>
                <input name='password' id='pwd-field-2' type='password' class='input-field' placeholder='Password'>
                <div id='pwd-error-2' class='error-text'></div>
            </div>
            <span id='signup-submit' class='g-btn' onclick='update_account(event);'>Save</span>


            <!-- Response -->
            <div class='message-response' id='message-response-1'></div>
        </form>";
    }
    public function create_account() {
        $fullname = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Insert data into the 'users' table
        $sqlUsers = "INSERT INTO users (fullname, email, pwd, created_at)
                    VALUES (?, ?, ?, ?)";
        $stmtUsers = $this->con->prepare($sqlUsers);
        $stmtUsers->bind_param("ssss", $fullname, $email, $password, $created_at);
        if($stmtUsers->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $userId = $stmtUsers->insert_id;
        $stmtUsers->close();
        echo $status;
    }
    /*
    =================================================================
        SESSIONS & COOKIES
    =================================================================  
    */
    public function startSession() {
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    public function get_uid() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $uid = $userdata['uid'];
            return $uid;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $uid = $userdata['uid'];
            return $uid;
        }
    }
    public function is_logged_in() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        }
    }
    public function username() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $username = $userdata['username'];
            return $username;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $username = $userdata['username'];
            return $username;
        }
    }
    public function get_user_status() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $user_status = $userdata['user_status'];
            return $user_status;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $user_status = $userdata['user_status'];
            return $user_status;
        }
    }
    public function get_user_email() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $email = $userdata['email'];
            return $email;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $email = $userdata['email'];
            return $email;
        }
    }
    public function update_user_session() {
        $userId = get_uid();
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $userId);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):

                    // Check if email is verified
                    if($row['account_status'] == 'pending') {
                        $logged = '0';
                    } else if (
                        $row['account_status'] == 'verified' || 
                        $row['account_status'] == 'active'
                    ) {
                        $logged = '1';
                    }

                    $userdata = array(
                        'logged' => $logged,
                        'uid' => $row['id'],
                        'fullname' => $row['fullname'],
                        'email' => $row['email'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'account_status' => $row['account_status']
                    );
                    $_SESSION['user'] = json_encode($userdata, true);
                    if (isset($_COOKIE['user'])) {
                        setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
                    }
                endforeach;
            }
        }      
    }
    /*
    =================================================================
        CRUD (create, read, update, delete, login)
    =================================================================  

    */
    public function create() {
        $this->startSession();

        $duplicate = $this->duplicate_email($_POST['email']);

        // echo $duplicate;
        if($duplicate == '1') {
            $status = '2';
        } else {
            // echo '3';

            $fullname = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $options = [
                'cost' => 11
            ];
            // $pwd = password_hash($password, PASSWORD_DEFAULT);
            $pwd = password_hash($password, PASSWORD_BCRYPT, $options);


            $created_at = datetime_now();
            $updated_at = $created_at;
            
            $stmt = $this->con->prepare("INSERT INTO users(fullname, email, pwd, photo, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
            }
            $stmt->bind_param("ssssss", $fullname, $email, $pwd, $photo, $created_at, $updated_at);
            
            if($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $stmt->close();
                $userdata = array(
                    'logged' => 0,
                    'uid' =>  $user_id,
                    'fullname' =>  $fullname,
                    'email' =>  $email,
                    'photo' => '',
                    'user_status' =>  'member',
                    'account_status' => 'pending',
                    'access_level' => '',
                );
                
                $_SESSION['user'] = json_encode($userdata, true);
                
                if($_SERVER['SERVER_NAME'] != 'localhost') {
                    $check_email = $this->email_exists($_POST['email']);
                
                    if($check_email == '1') {

                        // Create + Insert code
                        $code = $this->generate_code($user_id);

                        // Email Content
                        $subject = 'Verification Code';
                        $msgBody = "<p>This is your code: </p>
                        <h4>$code</h4>";
                        $_SESSION['code'] = $code;
                        
                        $status = '1';
                        // Brevo
                        $this->emailWithSendinblue($fullname, $email, $subject, $msgBody);
                    } else {
                        $status = '0';
                    }
                } else {
                    $status = '1';
                }
            } else {
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
                
                $status = '2';
            }
        }
                
        echo $status;
    }
    public function signup_with_google($email, $name, $profile_picture, $google_id) {
        session_start(); // Start session at the beginning
        $created_at = datetime_now();
        $updated_at = $created_at;

        $account_status = 'verified';
    
        // Check if user already exists
        $stmt = $this->con->prepare("SELECT id FROM users WHERE google_id = ? OR email = ?");
        $stmt->bind_param('ss', $google_id, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // User exists, update details
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();
    
            $stmt = $this->con->prepare("UPDATE users SET google_id = ?, fullname = ?, photo = ?, updated_at = ? WHERE id = ?");
            $stmt->bind_param('ssssi', $google_id, $name, $profile_picture, $updated_at, $user_id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Insert new user
            $stmt->close();
            $stmt = $this->con->prepare("INSERT INTO users (google_id, fullname, email, photo, account_status, created_at) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $google_id, $name, $email, $profile_picture, $account_status, $created_at);
            $stmt->execute();
            $user_id = $this->con->insert_id;
            $stmt->close();
        }
    
        // Store user in session
        $_SESSION['user'] = json_encode([
            'logged' => 1,
            'uid' => $user_id,
            'fullname' => $name,
            'email' => $email,
            'photo' => '',
            'user_status' => 'member',
            'account_status' => 'verified',
            'access_level' => '',
        ]);
    
        // Redirect after session is set
        header('Location: https://testserver.great-site.net/sharktropic/');
        exit;
    }
    public function emailWithSendinblue($name, $email, $subject, $content) {
        $config = '../config.php';
        
        $apiKey = $config['BREVO_API_KEY'];

        // Set up the Sendinblue configuration
        $config = \Brevo\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);

        // Create an API instance
        $apiInstance = new \Brevo\Client\Api\TransactionalEmailsApi(
            new \GuzzleHttp\Client(),
            $config
        );
        
        // Prepare the email data
        $sendSmtpEmail = new \Brevo\Client\Model\SendSmtpEmail([
            'subject' => $subject,
            'sender' => ['name' => 'Mind Rapture', 'email' => 'testemail6330@gmail.com'],
            'replyTo' => ['name' => 'Mind Rapture', 'email' => 'testemail6330@gmail.com'],
            'to' => [
                ['name' => $name, 'email' => $email]
            ],
            'htmlContent' => $content
        ]);
    
        // var_dump($sendSmtpEmail);
        try {
            // Send the email via the Sendinblue API
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            // var_dump($result);  // Inspect this variable to understand the API response
            // echo "Email sent successfully!";
        } catch (Exception $e) {
            // echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
    public function sendEmailPHPMailer($host, $port, $encryption, $username, $pwd, $to, $subject, $msgBody) {        // Enable error reporting
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Create PHPMailer instance
        $mail = new PHPMailer(true); // Passing true enables exceptions

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = false;
            $mail->Username = $username;
            $mail->Password = $pwd;
            $mail->SMTPSecure = $encryption; // Enable TLS encryption, 'ssl' also accepted
            $mail->Port = $port;
    
            // Sender and recipient
            $mail->setFrom($username, 'Mind Rapture');
            $mail->addAddress($to);
    
            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msgBody;
            // var_dump($mail);
            // Send email
            $mail->send();
            echo 'Email sent successfully to ' . $to;
        } catch (Exception $e) {
            echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
    public function update_user() {
        $id = get_uid();

        $user_array = $this->get_user($id);

        $fullname = $_POST['name'];
        $email = $_POST['email'];

        // Image
        if(
            !isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])
        ) {
            $photo = $user_array['photo'];
        } else {
            $photo = add_img('photo');
        }

        $stmt = $this->con->prepare("UPDATE users SET fullname=?, email=?, photo=? WHERE id=?");
        if (!$stmt) {
            die("Prepare error: " . $this->con->error);
        }
        $stmt->bind_param('sssi', $fullname, $email, $photo, $id);    
        if($stmt->execute()) {
            $status = '1';
            $this->update_user_session();
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    } 

    public function delete($id) {
        if($id != 1) {
            $stmt = $this->con->prepare("DELETE FROM users WHERE id=?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmt->close();
        }
        header('location: ../admin/admin-profiles');
    }
    /*
    =================================================================
        LOGIN / LOGOUT
    =================================================================  
    */
    public function login() {
        $this->startSession();

        $email = $_POST['email'];
        $password = $_POST['password'];     

        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row):   
                    $hash = trim($row['pwd']);
                    // Check if passwords match
                    if(password_verify($password, $hash)) {

                        // Check if email is verified
                        if($row['account_status'] == 'pending') {
                            $logged = '0';
                            
                        } else if (
                            $row['account_status'] == 'verified' || 
                            $row['account_status'] == 'active'
                        ) {
                            $logged = '1';
                        }

                        $userdata = array(
                            'logged' => $logged,
                            'uid' => $row['id'],
                            'fullname' => $row['fullname'],
                            'email' => $row['email'],
                            'photo' => $row['photo'],
                            'user_status' => $row['user_status'],
                            'account_status' => $row['account_status']
                            // 'access_level' => $row['access_level']
                        );
                        $_SESSION['user'] = json_encode($userdata, true);
                        if (isset($_POST["remember"])) {
                            setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
                        }
                        if($row['user_status'] == 'admin') {
                            // Send Email
                            // if($_SERVER['SERVER_NAME'] != 'localhost') {
                            // Create + Insert code
                            // $code = $this->generate_code($row['id']);
                            
                            // // Get SMTP details
                            // $smtp_details = $this->smtp_details();
                            // $host = $smtp_details['smtp_host'];
                            // $encryption = $smtp_details['smtp_encryption'];
                            // $port = $smtp_details['smtp_port'];
                            // $username = $smtp_details['username'];
                            // $pwd = $smtp_details['pwd'];
                            
                            // // Email Content
                            // $subject = 'Verification Code';
                            // $msgBody = "<p>This is your code: </p>
                            // <h4>$code</h4>";
                            //     sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $userdata['email'], $subject, $msgBody);
                            // }
                            $status = '1';
                        } else if ($row['user_status'] == 'member') {
                            if($row['account_status'] == 'verified') {
                                $status = '7';
                                if(isset($_SESSION['order'])) {
                                    
                                    $new_order_status = 'in progress';
                                    $this->update_order_status($new_order_status);
                                    $status = '11';
                                }
                            } else if($row['account_status'] == 'pending') {
                                $status = '8';
                                if(isset($_SESSION['order'])) {
                                    $new_order_status = 'requires email verification';
                                    $this->update_order_status($new_order_status);
                                    $status = '12';
                                }
                            }
                        } else {
                            $status = '5';
                        }
                    } else {
                        // Passwords don't match
                        $status = '3';
                    }
                endforeach;
            } else {
                // No email
                $status = '4';
            }  
        } else {
            // No email
            $status = '4';
        }      
        $stmt->close();
        echo $status;
    }
    

    public function logout() {
        $this->startSession();
        $this->endSession();
        setcookie('user', '', 1, '/');
        header('location: ../'); 
    }
    /*
    public function update() {
        // var_dump($_POST);
        $uid = $this->get_uid();
        
        $user = $this->get_user($uid);

        // Username
        if(!isset($_POST['username']) || empty($_POST['username'])) {
            $username = $user['username'];
        } else {
            $username = $_POST['username'];
        }
        // Email
        if(!isset($_POST['email']) || empty($_POST['email'])) {
            $email = $user['email'];
        } else {
            $email = $_POST['email'];
        }
        // Fullname
        if(!isset($_POST['fullname']) || empty($_POST['fullname'])) {
            $fullname = $user['fullname'];
        } else {
            $fullname = $_POST['fullname'];
        }
        // ERC20 Address
        if(!isset($_POST['erc20_address']) || empty($_POST['erc20_address'])) {
            $erc20 = $user['erc20_address'];
        } else {
            $erc20 = $_POST['erc20_address'];
        }
        // SOL Address
        if(!isset($_POST['sql_address']) || empty($_POST['sql_address'])) {
            $sql_address = $user['sql_address'];
        } else {
            $sql_address = $_POST['sql_address'];
        }

        $stmt = $this->con->prepare("UPDATE users SET username=?, fullname=?, email=?, sql_address=?, erc20_address=? WHERE id=?");
        $stmt->bind_param("sssssi", $username, $fullname, $email, $sql_address, $erc20, $uid);
        if($stmt->execute()) {
            $status = '1';
            $userdata = array(
                'logged' => '1',
                'uid' => $uid,
                'username' => $username,
                'email' => $email,
                'user_status' => $user['user_status']
            );
            $_SESSION['user'] = json_encode($userdata, true);
            if(isset($_COOKIE['user'])) {
                setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
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
    public function update_admin() {
        $uid = $this->get_uid();
        // USERNAME
        if(isset($_POST['username']) && !empty($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $username = $this->username();
        }
        // EMAIL
        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $email = $this->get_user_email();
        }
        // PASSWORD
        if(isset($_POST['password']) && !empty($_POST['password'])) {
            $password = $_POST['password'];
            $options = [
                'cost' => 11
            ];
            $pwd = password_hash($password, PASSWORD_BCRYPT, $options);
        } else {
            $pwd = $this->get_user_pwd($uid);
        }
        
        $stmt = $this->con->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $email, $pwd, $uid);
        if($stmt->execute()) {
            $status = '1';
            $userdata = array(
                'logged' => '1',
                'uid' => $uid,
                'username' => $username,
                'email' => $email,
                'user_status' => $this->get_user_status()
            );
            $_SESSION['user'] = json_encode($userdata, true);
            if(isset($_COOKIE['user'])) {
                setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
            }
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
        // header('location: ../login-details.php');
    }
    */
    public function add_img($n) {
        // $img = $_FILES['image']['name'];
        // if($n == '') {
            $img = $_FILES[$n]['name'];
        // } else {
        //     $img = $_FILES['image'.$n]['name'];
        // }
        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = './img/';
                $uniquesavename=time().uniqid(rand(10, 20));
                $destFile = $imagePath . $uniquesavename . '.'.$ext;
                // if($n == '') {
                    $tempname = $_FILES[$n]['tmp_name'];
                // } else {
                //     $tempname = $_FILES['image'.$n]['tmp_name'];
                // }
                
                list($width, $height) = getimagesize( $tempname );
                move_uploaded_file($tempname,  $destFile);
                $filename = $uniquesavename . '.'.$ext;
            }
        } else {
            $filename = '';
        }
        return $filename;
    }
    public function get_user_pwd($id) {
        $stmt2 = $this->con->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt2->bind_param('i', $id);
        $stmt2->execute();        
        $result2 = $stmt2->get_result();
        $data2 = $result2->fetch_all(MYSQLI_ASSOC);
        if(isset($data2)) {
            if(count($data2) > 0) {
                foreach($data2 as $row2): 
                    $pass = $row2['password'];
                endforeach;        
            }
        }
        $stmt2->close();
        return $pass;
    }
    public function get_user($id) {
        // var_dump($id);
        $sql = "SELECT 
                *
            FROM 
                users u
            WHERE 
                u.id = ? 
            LIMIT 1";
    
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();        
        $result = $stmt->get_result();
        $user_array = array();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
    
        $stmt->close();
        
    }
    public function user($email) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $user_array = array(
                        'id' => $row['id'],
                        'fullname' => $row['fullname'],
                        'username' => $row['username'],
                        'email' => $row['email'],
                        'bio' => $row['bio'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'account_status' => $row['account_status']
                    );
                endforeach;
                $stmt->close();
            }
        }
        return $user_array;
    }
    public function user_id($username) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $uid = $row['id'];
                endforeach;
                $stmt->close();
            } else {
                $uid = 0;
            }
        } else {
            $uid = 0;
        }
        return $uid;
    }
    public function user_id_email($email) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                foreach($data as $row): 
                    $uid = $row['id'];
                endforeach;
                $stmt->close();
            } else {
                $uid = 0;
            }
        } else {
            $uid = 0;
        }
        return $uid;
    }
    public function validate_email() {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(isset($data)) {
                if(count($data) > 0) {
                    $status = '2';
                } else {
                    $status = '1';
                    // $username_status = $this->validate_username($username);
                    // if($username_status == '1') {
                    //     $status = '1';
                    // } else {
                    //     $status = '3';
                    // }
                } 
            } else {
                $status = '4';
            } 
        } else {
            $status = '5';
        }
        echo $status;
    }
    public function get_users() {
        $users_array = array();
        $stmt2 = $this->con->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt2->execute();        
        $result2 = $stmt2->get_result();
        $data2 = $result2->fetch_all(MYSQLI_ASSOC);
        if(isset($data2)) {
            if(count($data2) > 0) {
                foreach($data2 as $row2): 
                    $user_array = array(
                        'id' => $row2['id'],
                        'username' => $row2['username'],
                        'fullname' => $row2['fullname'],
                        'email' => $row2['email'],
                        'bio' => $row2['bio'],
                        'photo' => $row2['photo'],
                        'user_status' => $row2['user_status'],
                        'account_status' => $row2['account_status']
                    );
                    array_push($users_array, $user_array);
                endforeach;        
            }
        }
        $stmt2->close();
        
        return $user_array;
    }
    public function users_admin() {
        $users = $this->get_users();
        $users_str = "<div class='row'>
            <div class='col-12'>
                <div class='card mb-3 mb-md-4'>
                    <div class='card-header'>
                        <h5 class='font-weight-semi-bold mb-0'>Recent Orders</h5>
                    </div>

                    <div class='card-body pt-0'>
                        <div class='table-responsive-xl'>
                            <table class='table text-nowrap mb-0'>
                                <thead>
                                <tr>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>#</th>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>Name</th>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>Username</th>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>Firstname</th>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>Lastname</th>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>Account Status</th>
                                    <th class='font-weight-semi-bold border-top-0 py-2'>Actions</th>
                                </tr>
                                </thead>
                                <tbody>";
        $num_of_rows = count($users);
        $results_per_page = 50;
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows/$results_per_page);
        // var_dump($num_of_pages);
        // Determine which page user is currently on
        if(!isset($_GET['page'])) {
            $page = 1;
        } else {
            if($_GET['page'] == 0) {
                $page = 1;
            } else {
                $page = intval($_GET['page']);
            }
        }
        $starting_limit_number = ($page-1)*$results_per_page;

        
        if($page == $num_of_pages) {
            $next = $page;
        } else {
            $next = $page + 1;
        }

        $statusClass = 'user-status';

        for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
            if($x < $num_of_rows) {
                $user = $users[$x];
                $users_str .= "<tr>
                    <td class='py-3'>{$user['id']}</td>
                    <td class='py-3'>
                        <div>{$user['username']}</div>
                    </td>
                    <td class='py-3'>{$user['firstname']}</td>
                    <td class='py-3'>{$user['lastname']}</td>
                    <td class='py-3'>{$user['email']}</td>
                    <td class='py-3'>
                        <span class='$statusClass'>{$user['account_status']}</span>
                    </td>
                    <td class='py-1'>
                        <div class='position-relative'>
                            <a id='dropDown16Invoker' class='link-dark d-flex' href='#' aria-controls='dropDown16' aria-haspopup='true' aria-expanded='false' data-unfold-target='#dropDown16' data-unfold-event='click' data-unfold-type='css-animation' data-unfold-duration='300' data-unfold-animation-in='fadeIn' data-unfold-animation-out='fadeOut'>
                                <i class='fas fa-ellipsis-h' aria-hidden='true'></i>
                            </a>

                            <ul id='dropDown16' class='unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-1 unfold-css-animation unfold-hidden fadeOut' aria-labelledby='dropDown16Invoker' style='min-width: 150px; animation-duration: 300ms; right: -20px;'>
                                <li class='unfold-item'>
                                    <a class='unfold-link media align-items-center text-nowrap' href='user-edit?record={$user['id']}'>
                                        <i class='gd-pencil unfold-item-icon mr-3'></i>
                                        <span class='media-body'>Edit</span>
                                    </a>
                                </li>
                                <li class='unfold-item'>
                                    <a class='unfold-link media align-items-center text-nowrap' href='../controllers/user-handler?deluser={$user['id']}'>
                                        <i class='gd-close unfold-item-icon mr-3'></i>
                                        <span class='delete-link media-body'>Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>";
            }
            if($page == 1) {
                $prev = $page;
            } else {
                $prev = $page - 1;
            }
        }
        $users_str .= "</tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
        </div>";

        // Paging
        $user_paging = "<ul class='pagination'>";
        if($page == 1) {
            $user_paging .= "<li class='page-item disabled'>
                <a class='page-link' href='./users?page=$prev' tabindex='-1'>Previous</a>
            </li>";
        } else {
            $user_paging .= "<li class='page-item'>
                <a class='page-link' href='./users?page=$prev' tabindex='-1'>Previous</a>
            </li>";
        }
        for($p=1; $p<=$num_of_pages; $p++) {
            if($page == $p) {
                $user_paging .= "<li class='page-item active'>
                    <a class='page-link' href='./users?page=$p'>$p</a>
                </li>";
                // $user_paging .= "<a class='page-num current-page' href='./users?page=".$p."'>".$p."</a> ";
            } else {
                if($page == $num_of_pages) {
                    if($p >= $page - 3) {
                        $user_paging .= "<li class='page-item'>
                            <a class='page-link' href='./users?page=$p'>$p</a>
                        </li>";
                    } 
                } else {
                    if($page < 4) {
                        if($p < 5) {
                            $user_paging .= "<li class='page-item'>
                                <a class='page-link' href='./users?page=$p'>$p</a>
                            </li>";
                        }
                    } else {
                        if( ($p > $page - 3 && $p < $page) || ($p > $page && $p < $page + 2)) {
                            $user_paging .= "<li class='page-item active'>
                                <a class='page-link' href='./users?page=$p'>$p</a>
                            </li>";
                        }
                    }                
                }
            }
        }
        if($page == $num_of_pages) {
            $user_paging .= "<li class='page-item disabled'>
                <a class='page-link' href='./users?page=$next' tabindex='-1'>Next</a>
            </li>";
        } else {
            $user_paging .= "<li class='page-item'>
                <a class='page-link' href='./users?page=$next' tabindex='-1'>Next</a>
            </li>";
        }
        $user_paging .= "</ul>";

        $users_str .= $user_paging;

        echo $users_str;
    }
    public function update_password() {
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $password = $_POST['password'];
        $password_repeat = $_POST['repeat_password'];
        if(empty($password) || empty($password_repeat)) {
            $status = '4';
        } else if ($password != $password_repeat) {
            $status = '5';
        } else {
            $current_date = date("U"); 
            
            // SELECT
            // var_dump($_POST);
            $stmt = $this->con->prepare("SELECT * FROM pwd_reset WHERE pwd_reset_selector=? AND pwd_reset_expires>=?");
            $stmt->bind_param('ss', $selector, $current_date);
            $stmt->execute();
            // $stmt->store_result();
            $result = $stmt->get_result();
            
            if ($result->num_rows == 0) {
                $status = '8';
            } else {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row):
                    $token_bin = hex2bin($validator);
                    $token_check = password_verify($token_bin, $row['pwd_reset_token']);
                endforeach;
                
                if($token_check === false) {
                    $status = '7';
                    // echo "You need to resubmit your reset request.";
                    // exit();
                } elseif($token_check === true) {
                    $token_email = $row['pwd_reset_email'];
                    
                    // SELECT FROM users TABLE
                    $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
                    $stmt->bind_param('s', $token_email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows == 0) {
                        $status = '0';
                    } else {
                        // var_dump($selector, $validator, $password, $password_repeat);
                        // UPDATE PASSWORD
                        $stmt = $this->con->prepare("UPDATE users SET pwd=? WHERE email=?");
                        

                        $options = [
                            'cost' => 11
                        ];
                        $pwdHash = password_hash($password, PASSWORD_BCRYPT, $options);

                        $stmt->bind_param('ss', $pwdHash, $token_email);
                        $stmt->execute();    
                        // DELETE TOKEN
                        $stmt = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
                        $stmt->bind_param('s', $token_email);
                        $stmt->execute();
                        
                        $status = '1';
                    }
                    $stmt->close();
                }
            }    
        }    
        echo $status;
    }
    public function email_exists($email) {
        // Check if email exists
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return '1';
        } else {
            return '0';
        }
    }
    public function admin_password_form() {
        return "<div class='tab-pane fade' id='password' role='tabpanel'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>Password</h5>

                    <form>
                        <div id='msg-response'></div>
                        <input type='hidden' name='update_pwd' id='update_pwd' value='true'>
                        <div class='mb-3'>
                            <label class='form-label' for='inputPasswordCurrent'>Current password</label>
                            <input type='password' class='form-control' name='current_password' id='current_password'>
                            <div class='error' id='current_password_error'></div>
                            <!-- <small><a href='#'>Forgot your password?</a></small> -->
                        </div>
                        <div class='mb-3'>
                            <label class='form-label' for='inputPasswordNew'>New password</label>
                            <input type='password' class='form-control' name='new_password' id='new_password'>
                            <div class='error' id='new_password_error'></div>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label' for='inputPasswordNew2'>Verify password</label>
                            <input type='password' class='form-control' name='repeat_password' id='repeat_password'>
                            <div class='error' id='repeat_password_error'></div>
                        </div>
                        <span onclick='update_pwd(event);' type='submit' class='btn btn-primary'>Save changes</span>
                    </form>

                </div>
            </div>
        </div>";
    }
    public function public_info_form() {
        $id = get_uid();
        $user_array = $this->get_user($id);
        
        if(!empty($user_array['photo'])) {
            $profile_img = "<div class='pfp-wrapper'>
                <img id='pfp-img-preview' src='../images/{$user_array['photo']}' alt='{$user_array['username']}' class='rounded-circle img-responsive mt-2' />
            </div>";
        } else {
            $profile_img = "<div class='pfp-wrapper'>
                <img id='pfp-img-preview' src='../images/avi.png' alt='{$user_array['username']}' class='rounded-circle img-responsive mt-2' />
            </div>";

        }
        echo "<form runat='server'>
            
            <input type='hidden' id='update_public_info' name='update_public_info' value='true'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='mb-3'>
                        <label class='form-label' for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Username' value='{$user_array['username']}'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='bio'>Bio</label>
                        <textarea rows='2' class='form-control' id='bio' name='bio' placeholder='Tell something about yourself'>{$user_array['bio']}</textarea>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='text-center'>
                        $profile_img
                        <div class='mt-2'>
                            <input class='input' id='image' type='file' name='image' style='display: none;'>
                            <span id='upload_btn' onclick='return fireButton(event);' class='btn btn-primary'><i class='fas fa-upload'></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                </div>
            </div>
            <div>
                <span onclick='update_public_info(event)' type='submit' class='btn btn-primary'>Save changes</span>
            </div>
            <div id='message-response-1'></div>
        </form>";
    }
    public function update_public_info() {
        $id = get_uid();
        $user_array = $this->get_user($id);

        $username = $_POST['username'];
        $bio = $_POST['bio'];
        if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
            $photo = $user_array['photo'];
        } else {
            $photo = add_img('photo');
        }
        $stmt = $this->con->prepare("UPDATE users SET username=?, bio=?, photo=? WHERE id=?");
        $stmt->bind_param('sssi', $username, $bio, $photo, $id);    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function private_info_form() {
        $id = get_uid();
        $user_array = $this->get_user($id);

        echo "<form>
            
            <input type='hidden' id='update_private_info' name='update_private_info' value='true'>
            <div class='row'>
                <div class='mb-3 col-md-12'>
                    <label class='form-label' for='fname'>Name</label>
                    <input type='text' class='form-control' id='fname' name='fname' placeholder='Name' value='{$user_array['fullname']}'>
                </div>
            </div>
            <div class='mb-3'>
                <label class='form-label' for='email'>Email</label>
                <input type='email' class='form-control' id='email' name='email' placeholder='Email' value='{$user_array['email']}'>
            </div>
            <div class='mb-3'>
                <span onclick='update_private_info(event)' type='submit' class='btn btn-primary'>Save changes</span>
            </div>
            <div id='message-response-2'></div>
        </form>";
    }
    public function update_private_info() {
        $id = get_uid();

        $fname = $_POST['fname'];
        $email = $_POST['email'];

        $stmt = $this->con->prepare("UPDATE users SET fullname=?, email=? WHERE id=?");
        $stmt->bind_param('ssi', $fname, $email, $id);    
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    } 
    /*

    =================================================================
        Verification
    =================================================================  

    */
    public function duplicate_email($email) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            return '1';
        } else {
            return '0';
        }
    }
    public function verify_account($selector, $validator) {
        // $current_date = date("U");


        // Set the desired timezone (e.g., 'America/New_York')
        $timezone = 'America/New_York';
        // Create a DateTime object with the desired timezone
        $date = new \DateTime('now', new \DateTimeZone($timezone));
        // Get the Unix timestamp for the current time in the specified timezone
        $current_date = $date->format('U');


        $stmt = $this->con->prepare("SELECT * FROM verify_email WHERE vrf_selector=? AND vrf_expires>=?");
        $stmt->bind_param('ss', $selector, $current_date);
        // $stmt = $this->con->prepare("SELECT * FROM verify_email WHERE vrf_selector = ?");
        // $stmt->bind_param('s', $selector);
        $stmt->execute();

        
        $result = $stmt->get_result();

        // var_dump($result);
        
        if ($result->num_rows == 0) {
            $status = '8';
        } else {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            foreach($data as $row):
                $token_bin = hex2bin($validator);
                $token_check = password_verify($token_bin, $row['vrf_token']);
            endforeach;
            
            if($token_check === false) {
                $status = '7';
            } elseif($token_check === true) {
                $token_email = $row['vrf_email'];
                // SELECT FROM users TABLE
                $stmt = $this->con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
                $stmt->bind_param('s', $token_email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows == 0) {
                    $status = '0';
                } else {
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $row = $data[0];

                    // Get data for session
                    $logged = 1;
                    $uid = $row['id'];
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $photo = $row['photo'];
                    $user_status = $row['user_status'];
                    
                    // New account status
                    $account_status = 'verified';

                    $stmt = $this->con->prepare("UPDATE users SET account_status=? WHERE email=?");
                    $stmt->bind_param('ss', $account_status, $token_email);
                    $stmt->execute();    
                    // DELETE TOKEN
                    $stmt = $this->con->prepare("DELETE FROM verify_email WHERE vrf_email=?");
                    $stmt->bind_param('s', $token_email);
                    $stmt->execute();

                    $userdata = array(
                        'logged' => $logged,
                        'uid' => $uid,
                        'fullname' => $fullname,
                        'email' => $email,
                        'photo' => $photo,
                        'user_status' => $user_status,
                        'account_status' => $account_status,
                        'access_level' => '',
                    );
                    $_SESSION['user'] = json_encode($userdata, true);
                    
                    
                    $status = '1';
                }
            }
        }
        return $status;
    }
    public function generate_code($user_id) {
        // Generate a 6-digit code
        $code = mt_rand(100000, 999999);
        
        // Calculate the expiration time (30 minutes from now)
        $expires = date("U") + 1800;
        
        // Prepare the SQL statement
        $stmt = $this->con->prepare("INSERT INTO login_verify (user_id, code, expires) VALUES (?, ?, ?)");
        
        // Bind parameters to the statement
        $stmt->bind_param("iss", $user_id, $code, $expires);
        
        // Execute the statement
        $stmt->execute();
        
        // Close the statement and database connection
        $stmt->close();
        
        // Return the generated code
        return $code;
    }
    public function generatePwdLink($email) {
        // GENERATE PASSWORD LINK
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        
        // This link will be sent to the user by email
        $url = "https://uncutcollege.com/new-password?selector=".$selector."&validator=".bin2hex($token);
        // Expiration date for token (1800ms = 1hr)
        $expires = date("U") + 1800;

        // Insert token in the database (we'll need a new table for this)
        // DELETE EXISTING TOKENS
        $stmt = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();

        // INSERT NEW TOKEN
        $stmt = $this->con->prepare("INSERT INTO pwd_reset (pwd_reset_email, pwd_reset_selector, pwd_reset_token, pwd_reset_expires) VALUES (?, ?, ?, ?);");
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $email, $selector, $hashedToken, $expires);
        $stmt->execute();
        $stmt->close();

        return $url;
        
    }
    public function generateVerificationLink($email) {
        // GENERATE PASSWORD LINK
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        
        // This link will be sent to the user by email
        $url = "https://armourydesign.com/hobby-shop/verification?selector=".$selector."&validator=".bin2hex($token);
        // Expiration date for token (1800ms = 1hr)
        $expires = date("U") + 1800;

        // Insert token in the database (we'll need a new table for this)
        // DELETE EXISTING TOKENS
        $stmt = $this->con->prepare("DELETE FROM verify_email WHERE vrf_email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();

        // INSERT NEW TOKEN
        $stmt = $this->con->prepare("INSERT INTO verify_email (vrf_email, vrf_selector, vrf_token, vrf_expires) VALUES (?, ?, ?, ?);");
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $email, $selector, $hashedToken, $expires);
        $stmt->execute();
        $stmt->close();

        return $url;
        
    }
    public function verify_email() {
        $this->startSession();

        if($_SERVER['SERVER_NAME'] != 'localhost') {
            // Get the user ID from the get_uid() function
            $user_id = $this->get_uid();
            
            // Get the verification code from the $_POST['code'] variable
            $verification_code = $_POST['code'];
            
            // Get the current timestamp
            $current = date("U"); 
            
            
            // Prepare the SELECT statement to fetch the matching row
            $stmt = $this->con->prepare("SELECT * FROM login_verify WHERE user_id = ? AND code = ? AND expires >= ? LIMIT 1");
            $stmt->bind_param('iss', $user_id, $verification_code, $current);
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Fetch the row
                $row = $result->fetch_assoc();
                
                // Check if the verification code matches
                if ($verification_code === $row['code']) {
                    // Check if the current timestamp is smaller than or equal to the expiration timestamp
                    if ($current <= $row['expires']) {
                        // Update the session data
                        $userdata = json_decode($_SESSION['user'], true);
                        $userdata['logged'] = 1;
                        
                        // Update the user cookie if it is set
                        if (isset($_COOKIE['user'])) {
                            $cookieData = json_decode($_COOKIE['user'], true);
                            $cookieData['logged'] = 1;
                            setcookie("user", json_encode($cookieData), time() + (10 * 365 * 24 * 60 * 60), '/');
                        }
                        
                        // Set the new user session data
                        $_SESSION['user'] = json_encode($userdata);

                        $status = '1';
                    } else {
                        $status = '2';
                    }
                } else {
                    $status = '3';
                }
            } else {
                $status = '4';
            }
            // Close the statement
            $stmt->close();
            
            // Delete rows with the matching user ID
            $stmt = $this->con->prepare("DELETE FROM login_verify WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->close();
        } else {
            $status = '1';
        }

        echo $status;
    }
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



    public function verify_phone() {
        $this->startSession();

        if($_SERVER['SERVER_NAME'] != 'localhost') {
            // Get the user ID from the get_uid() function
            $user_id = $this->get_uid();
            
            // Get the verification code from the $_POST['code'] variable
            $verification_code = $_POST['code'];
            
            // Get the current timestamp
            $current = date("U"); 
            
            
            // Prepare the SELECT statement to fetch the matching row
            $stmt = $this->con->prepare("SELECT * FROM phone_verify WHERE user_id = ? AND code = ? AND expires >= ? LIMIT 1");
            $stmt->bind_param('iss', $user_id, $verification_code, $current);
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Fetch the row
                $row = $result->fetch_assoc();
                
                // Check if the verification code matches
                if ($verification_code === $row['code']) {
                    // Check if the current timestamp is smaller than or equal to the expiration timestamp
                    if ($current <= $row['expires']) {
                        // Update the session data
                        $userdata = json_decode($_SESSION['user'], true);
                        $userdata['logged'] = 1;
                        
                        // Update the user cookie if it is set
                        if (isset($_COOKIE['user'])) {
                            $cookieData = json_decode($_COOKIE['user'], true);
                            $cookieData['logged'] = 1;
                            setcookie("user", json_encode($cookieData), time() + (10 * 365 * 24 * 60 * 60), '/');
                        }
                        
                        // Set the new user session data
                        $_SESSION['user'] = json_encode($userdata);

                        $status = '1';
                    } else {
                        $status = '2';
                    }
                } else {
                    $status = '3';
                }
            } else {
                $status = '4';
            }
            // Close the statement
            $stmt->close();
            
            // Delete rows with the matching user ID
            $stmt = $this->con->prepare("DELETE FROM phone_verify WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->close();
        } else {
            $status = '1';
        }

        echo $status;
    }


    /*
    =================================================================
        ADMIN
    =================================================================  
    */
    public function get_admin_profile($id) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $profile_array = array(
                "id" => $row['id'],
                "fullname" => $row['fullname'],
                "username" => $row['username'], 
                "bio" => $row['bio'], 
                "email" => $row['email'],
                "photo" => $row['photo'],
                "user_status" => $row['user_status'],
                "account_status" => $row['account_status'],
                "access_level" => $row['access_level'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );
        endforeach;
        $stmt->close();

        return $profile_array;
    }
    public function get_admin_profiles() {
        $profiles_array = array();
        $stmt = $this->con->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $profile_array = array(
                "id" => $row['id'],
                "fullname" => $row['fullname'],
                "username" => $row['username'], 
                "bio" => $row['bio'], 
                "email" => $row['email'],
                "photo" => $row['photo'],
                "user_status" => $row['user_status'],
                "account_status" => $row['account_status'],
                "access_level" => $row['access_level'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );
            array_push($profiles_array, $profile_array);
        endforeach;
        $stmt->close();

        return $profiles_array;
    }
    public function admin_profiles() {
        $profiles = $this->get_admin_profiles();

        $profilesStr = "";

        foreach($profiles as $profile):
            
            if($profile['access_level'] == 'All') {
                $accessClass = "badge badge-pill badge-success";
            } else if($profile['access_level'] == 'Merch') {
                $accessClass = "badge badge-pill badge-warning";
            } else if($profile['access_level'] == 'Events') { 
                $accessClass = "badge badge-pill badge-secondary";
            }

            $profilesStr .= "<tr>
                <td class='py-3'>{$profile['id']}</td>
                <td class='py-3'>
                    <div>{$profile['fullname']}</div>
                </td>
                <td class='py-3'>{$profile['username']}</td>
                <td class='py-3'>{$profile['email']}</td>
                <td class='py-3'>{$profile['account_status']}</td>
                <td class='py-3'>
                    <span class='$accessClass'>{$profile['access_level']}</span>
                </td>
                <td class='py-1'>
                    <div class='position-relative'>
                        <a id='dropDown10Invoker' class='link-dark d-flex' href='#' aria-controls='dropDown10' aria-haspopup='true' aria-expanded='false' data-unfold-target='#dropDown10' data-unfold-event='click' data-unfold-type='css-animation' data-unfold-duration='300' data-unfold-animation-in='fadeIn' data-unfold-animation-out='fadeOut'>
                            <i class='fas fa-ellipsis-h'></i>
                        </a>

                        <ul id='dropDown10' class='unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-1 unfold-css-animation unfold-hidden fadeOut' aria-labelledby='dropDown10Invoker' style='min-width: 150px; animation-duration: 300ms; right: -20px;'>
                            <li class='unfold-item'>
                                <a class='unfold-link media align-items-center text-nowrap' href='admin-edit?id={$profile['id']}'>
                                    <i class='gd-pencil unfold-item-icon mr-3'></i>
                                    <span class='media-body'>Edit</span>
                                </a>
                            </li>
                            <li class='unfold-item'>
                                <a onclick='return pop(this)' class='unfold-link media align-items-center text-nowrap' href='../controllers/user-handler?deladmin={$profile['id']}'>
                                    <i class='gd-close unfold-item-icon mr-3'></i>
                                    <span class='delete-link media-body'>Delete</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>";        
        endforeach;
        echo $profilesStr;
    }
    public function createAdminForm() {
        echo "<form runat='server'>
            
            <input type='hidden' id='create_admin' name='create_admin' value='true'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='mb-3'>
                        <label class='form-label' for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Username' value=''>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='bio'>Bio</label>
                        <textarea rows='2' class='form-control' id='bio' name='bio' placeholder='Tell something about yourself'></textarea>
                    </div>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='fname'>Fullname</label>
                            <input type='text' class='form-control' id='fname' name='fname' placeholder='Fullname' value=''>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='email'>Email</label>
                            <input type='email' class='form-control' id='email' name='email' placeholder='Email' value=''>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='password'>Password</label>
                            <input type='password' class='form-control' id='password' name='password' placeholder='Password' value=''>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='access_level'>Access</label>
                            <select class='form-control' id='access_level' name='access_level'>
                                <option value='All'>All</option>
                                <option value='Merch'>Merch</option>
                                <option value='Events'>Events</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='text-center'>
                        <div class='pfp-wrapper'>
                            <img id='pfp-img-preview' src='../images/avi.png' alt='' class='rounded-circle img-responsive mt-2' />
                        </div>
                        <div class='mt-2'>
                            <input class='input' id='image' type='file' name='image' style='display: none;'>
                            <span id='upload_btn' onclick='return fireButton(event);' class='btn btn-primary'><i class='fas fa-upload'></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                </div>

            </div>
            <div class='mb-3'>
                <span onclick='create_admin(event)' type='submit' class='btn btn-primary'>Create Profile</span>
            </div>
            <div id='message-response-1'></div>
        </form>";
    }
    public function editAdminForm($id) {
        $profile = $this->get_admin_profile($id);
        if(!empty($profile['photo'])) {
            $profile_img = "<div class='pfp-wrapper'>
                <img id='pfp-img-preview' src='../images/{$profile['photo']}' alt='{$profile['username']}' class='rounded-circle img-responsive mt-2' />
            </div>";
        } else {
            $profile_img = "<div class='pfp-wrapper'>
                <img id='pfp-img-preview' src='../images/avi.png' alt='{$profile['username']}' class='rounded-circle img-responsive mt-2' />
            </div>";

        }
        // Account Status
        if($profile['account_status'] == 'active') {
            $accountStr = "<select class='form-control' id='account_status' name='account_status'>
                <option value='active' selected>Active</option>
                <option value='inactive'>Inactive</option>
            </select>";
        } else if($profile['account_status'] == 'inactive') {
            $accountStr = "<select class='form-control' id='account_status' name='account_status'>
                <option value='active'>Active</option>
                <option value='inactive' selected>Inactive</option>
            </select>";
        } 
        // Access
        if($profile['access_level'] == 'All') {
            $accessStr = "<select class='form-control' id='access_level' name='access_level'>
                <option value='All' selected>All</option>
                <option value='Merch'>Merch</option>
                <option value='Events'>Events</option>
            </select>";
        } else if($profile['access_level'] == 'Merch') {
            $accessStr = "<select class='form-control' id='access_level' name='access_level'>
                <option value='All'>All</option>
                <option value='Merch' selected>Merch</option>
                <option value='Events'>Events</option>
            </select>";
        } else if($profile['access_level'] == 'Events') {
            $accessStr = "<select class='form-control' id='access_level' name='access_level'>
                <option value='All'>All</option>
                <option value='Merch'>Merch</option>
                <option value='Events' selected>Events</option>
            </select>";
        }

        echo "<form runat='server'>   
            <input type='hidden' id='user_id' name='user_id' value='$id'>
            <input type='hidden' id='update_admin' name='update_admin' value='true'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='fname'>Fullname</label>
                            <input type='text' class='form-control' id='fname' name='fname' placeholder='Fullname' value='{$profile['fullname']}'>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Username' value='{$profile['username']}'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='bio'>Bio</label>
                        <textarea rows='2' class='form-control' id='bio' name='bio' placeholder='Tell something about yourself'>{$profile['bio']}</textarea>
                    </div>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='email'>Email</label>
                            <input type='email' class='form-control' id='email' name='email' placeholder='Email' value='{$profile['email']}'>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='password'>Password</label>
                            <input type='password' class='form-control' id='password' name='password' placeholder='Password' value=''>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='account_status'>Account Status</label>
                            $accountStr
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='access_level'>Access</label>
                            $accessStr
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='text-center'>
                        $profile_img
                        <div class='mt-2'>
                            <input class='input' id='image' type='file' name='image' style='display: none;'>
                            <span id='upload_btn' onclick='return fireButton(event);' class='btn btn-primary'><i class='fas fa-upload'></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                </div>

            </div>
            <div class='mb-3'>
                <span onclick='update_admin(event)' type='submit' class='btn btn-primary'>Update Profile</span>
            </div>
            <div id='message-response-1'></div>
        </form>";
    }
    public function createAdmin() {
        $username = $_POST['username'];
        $bio = $_POST['bio'];
        if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
            $photo = '';
        } else {
            $photo = add_img('photo');
        }
        $fname = $_POST['fname'];
        // $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $options = [
            'cost' => 11
        ];
        $pwdHash = password_hash($password, PASSWORD_BCRYPT, $options);
        $user_status = 'admin';
        $account_status = 'active';
        $access_level = $_POST['access_level'];
        $created_at = datetime_now();
        $updated_at = $created_at;

        // $stmt = $this->con->prepare("INSERT INTO users (firstname, lastname, username, bio, email, pwd, photo, user_status, account_status, access_level, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // $stmt->bind_param('ssssssssssss', $fname, $lname, $username, $bio, $email, $pwdHash, $photo, $user_status, $account_status, $access_level, $created_at, $updated_at);    
        $stmt = $this->con->prepare("INSERT INTO users (fullname, username, bio, email, pwd, photo, user_status, account_status, access_level, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssssss', $fname, $username, $bio, $email, $pwdHash, $photo, $user_status, $account_status, $access_level, $created_at, $updated_at);

        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function updateAdmin() {
        $id = $_POST['user_id'];
        $profile = $this->get_admin_profile($id);

        $username = $_POST['username'];
        $bio = $_POST['bio'];
        if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
            $photo = $profile['photo'];
        } else {
            $photo = add_img('photo');
        }
        $fname = $_POST['fname'];
        // $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $options = [
            'cost' => 11
        ];
        $pwdHash = password_hash($password, PASSWORD_BCRYPT, $options);
        $user_status = 'admin';
        $account_status = $_POST['account_status'];
        $access_level = $_POST['access_level'];
        $created_at = datetime_now();
        $updated_at = $created_at;

        // if(!empty($password)) {
        //     $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, username=?, bio=?, email=?, pwd=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
        //     $stmt->bind_param('ssssssssssi', $fname, $lname, $username, $bio, $email, $pwdHash, $photo, $account_status, $access_level, $updated_at, $id);    
        // } else {
        //     $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, username=?, bio=?, email=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
        //     $stmt->bind_param('sssssssssi', $fname, $lname, $username, $bio, $email, $photo, $account_status, $access_level, $updated_at, $id);    
        // }

        if(!empty($password)) {
            $stmt = $this->con->prepare("UPDATE users SET fullname=?, username=?, bio=?, email=?, pwd=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
            $stmt->bind_param('sssssssssi', $fname, $username, $bio, $email, $pwdHash, $photo, $account_status, $access_level, $updated_at, $id);    
        } else {
            $stmt = $this->con->prepare("UPDATE users SET fullname=?, username=?, bio=?, email=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssssssssi', $fname, $username, $bio, $email, $photo, $account_status, $access_level, $updated_at, $id);    
        }

        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }


    /*
    =================================================================
        FORM
    =================================================================  
    */
    /*
    =================================================================
        ORDER
    =================================================================  
    */
    public function update_order_status($new_order_status) {
        if(isset($_SESSION['order'])) {
            // var_dump($_SESSION['order']);
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
}


?>