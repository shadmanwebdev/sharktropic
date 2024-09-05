<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }
        
        require '../functions.php';
        require '../vendor/autoload.php';

        require '../Classes/Db.php';
        require '../Classes/StripePayment.php';
        include '../Classes/Order.php';



        // var_dump($_GET['session_id']);

        

        $sp = new MyApp\Classes\StripePayment();
        $sp->checkout_success($_GET['session_id']);


        $payment = $sp->get_payment_by_checkout_session_id($_GET['session_id']);

        $order_id = $payment['order_id'];

        $order = new MyApp\Classes\Order;
        $order->update_created_order_status($order_id, 'Paid');
    ?>
</body>
</html>