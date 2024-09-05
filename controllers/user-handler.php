<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    require_once '../vendor/autoload.php';
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    include '../Classes/MyAccount.php';
    $user = new MyApp\Classes\User();

    // Create Account
    if(isset($_POST['signup'])) {
        $user->create_account();
    }
    // Login
    if(isset($_POST['login'])) {
        $user->login();
    }
    if(isset($_POST['update_user'])) {
        $user = new MyApp\Classes\User();
        $user->update_user();
    }
    if(isset($_POST['update_public_info'])) {
        $user = new MyApp\Classes\User();
        $user->update_public_info();
    }
    if(isset($_POST['update_private_info'])) {
        $user = new MyApp\Classes\User();
        $user->update_private_info();
    }
    if(isset($_POST['validate_email'])) {    
        $user_status = $user->get_user_status();    
        if($user_status == 'admin') {
            $em = $user->get_user_email();
            if($em != $_POST['email']) {
                $user->validate_email();
            } else {
                if($em == $_POST['email']) {
                    echo '7';
                } else {
                    echo '8';
                }
            }
        }
    }
    
    // if(isset($_POST['update_admin'])) {
    //     $user->update_admin();
    // }
    // if(isset($_GET['del_user'])) {
    //     $user->delete($_GET['del_user']);
    // }
    if(isset($_POST['login_user'])) {
        $user->login();
    }
    if(isset($_POST['forgot'])) {
        $check_email = $user->email_exists($_POST['email']);
        if($check_email == '1') {
            $url = $user->generatePwdLink($_POST['email']);
            $subject = 'JustPearlyThings Password Reset';
            $msgBody = "<p>Your password reset link: </p>
            <a href='$url'>$url</a>";

            $smtp_details = $user->smtp_details();
            
            $host = $smtp_details['smtp_host'];
            $encryption = $smtp_details['smtp_encryption'];
            $port = $smtp_details['smtp_port'];
            $username = $smtp_details['username'];
            $pwd = $smtp_details['pwd'];

    
            sendEmailSwiftMailer($host, $port, $encryption, $username, $pwd, $_POST['email'], $subject, $msgBody);
            echo '1';

        } else {
            echo '0';
        }
    }
    if(isset($_POST['update_password'])) {
        $user->update_password();
    }
    if(isset($_POST['create_admin'])) {
        $user->createAdmin();
    }
    if(isset($_POST['update_admin'])) {
        $user->updateAdmin();
    }
    if(isset($_GET['deladmin'])) {
        $user->delete($_GET['deladmin']);
    }

    // Update User Details
    if(isset($_POST['update_user_details'])) {
        $myaccount = new MyApp\Classes\MyAccount;
        $myaccount->update_general_info();
    }
    if(isset($_POST['del'])) {
        // var_dump($_POST);
        $myaccount = new MyApp\Classes\MyAccount;
        $myaccount->delete_user($_POST['del_id']);
    }
    if(isset($_POST['upload_profile_photo'])) {
        $myaccount = new MyApp\Classes\MyAccount;
        $myaccount->update_profile_photo();
    }
?>