<?php

    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }

    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/SiteSettings.php';
    include '../Classes/StripePayment.php';
    include '../Classes/Service.php';
    include '../Classes/Booking.php';


    $s = new MyApp\Classes\SiteSettings;



    require_once '../vendor/autoload.php';

    if(isset($_GET['cancel'])) {
        // // Payment
        // $sp = new MyApp\Classes\StripePayment;
        // $payment = $sp->get_payment_by_booking_id($_GET['id']);
        // // // Payment Intent Id
        // // $payment_intent_id = $payment['payment_intent_id'];

        // // // Cancel Payment
        // // $paymentIntent = $sp->cancel($payment_intent_id);
        // // var_dump($paymentIntent);

        // Delete Booking
        $booking = new Booking();
        $cancel_response = $booking->cancel_booking($_GET['id']);

        // header('location: ../services');

        // echo $paymentIntent;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $s->sitename(); ?></title>
    <meta name='title' content='<?= $s->title_tag(); ?>'>
    <meta name='description' content='<?= $s->meta_description(); ?>'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        html, body {
            min-width: 100%;
            width: 100vw;
            margin: 0px;
            overflow-x: hidden; 
        }
        body {
            color: #242529;
            font-family: 'Poppins', Arial, sans-serif;
            /* font-family: sans-serif; */
            font-size: 16px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>



    <style>
        body {
            background: #A1A1A1;
        }
        .popup {
            padding: 50px;
            max-width: 538px;
            position: static;
            margin: 200px auto;
            border-radius: 15px;
            background: #FFFFFF;
            box-shadow: 0px 2px 10px 0px #00000026;
            text-align: center;
        }
        .popup-title {  
            font-size: 20px;
            font-weight: 600;
            line-height: 30px;
            letter-spacing: 0em;
            text-align: center;
            color: #000;
        }
        .popup-subtitle {
            margin: 10px 0;
            line-height: 1.5;
        }
        form.verify-code input {
            color: #ADADAD;
            border: 2px solid #ADADAD;
            padding: 10px 20px;
            radius: 7px;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
        form.verify-code .form-group {
            display: flex;
        }
        form.verify-code div.submit {
            padding: 10px 20px;
            border-radius: 7px;
            background: #FFB600;
            color: #0E0E0E;
            width: 100%;
            cursor: pointer;
            transition: .4s;
        }
        form.verify-code div.submit:hover {
            background: #ffc73c;
        }
        .popup .icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .popup .icon.check {
            background-color: rgb(27,187,101);
        }
        .popup .icon.cross {
            background-color: red;
        }
        .popup .icon i {
            font-size: 25px;
            color: #fff;
        }
        .back a {
            font-weight: 600;
            color: #000;
        }
        @media screen and (max-width: 576px) {
            .popup {
                width: 98%;
                padding: 30px 10px;
            }
            .popup .icon {
                width: 55px;
                height: 55px;
            }
            .popup-title {  
                font-size: 18px;
                font-weight: 600;
            }
            .popup-subtitle {
                font-size: 13px;
            }
        }
    </style>

    <?php
        if ($cancel_response == '1') {
            $status_text = "Success!";
            $status_msg = "Booking was canceled";
            $icon = "<div class='icon check'>
                <i class='fa fa-check'></i>
            </div>";


            // $sp = new MyApp\Classes\StripePayment;
            // $sp->create_discount_code();
        } else {
            $status_text = "Error!";
            $icon = "<div class='icon cross'>
                <i class='ion-android-close'></i>
            </div>";
            $status_msg = "Cancellation attempt failed";
        }
    ?>


    <div class='popup'>
        <div class='popup-inner-div'>
            
            <?= $icon; ?>
            <div class='popup-title'><?= $status_text; ?></div>
            <div class='popup-subtitle'>
                <div class='success'>
                    <?= $status_msg; ?>
                </div>
                <div class='back' style='margin-top: 20px;'>
                    <a href='../'>Back to Home</a>
                </div>
            </div>
        </div>
    </div>





</body>
</html>