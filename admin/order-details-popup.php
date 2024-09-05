<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }
    $fileDir = dirname(__FILE__);

    define('ROOT_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR);
    define('CLASSES_PATH', dirname($fileDir) . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR);
    include('./functions.php');
    include('./Classes/Db.php');
    include('./Classes/Post.php');
    include('./Classes/Booking.php');

?>




<?php
    if(isset($_SESSION['uploads'])) {
        unset($_SESSION['uploads']);
    }

    $id = $_GET['id'];
    $type = $_GET['type'];
?>




<!-- Form -->
<style>
    #deletePopup {
        max-width: 400px;
        padding: 40px;
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 1000;
        margin-top: -150px;
        margin-left: -200px;
        row-gap: 10px;
        border-radius: 10px;
        background: #fff;
        color: #fff;
        box-shadow: 0px 4px 10px 0px #0000001A;
    }
    #deletePopup .card {
        border: none;
        box-shadow: none;
    }
    #deletePopup .card-header {
        color: #111111;
        padding: 0;
        margin-bottom: 20px;
        background-color :transparent;
        border-bottom: none;
    }
    #bookingPopupInner {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 5px;
    }
    #popup-heading {
        font-size: 16px;
        font-weight: 500;
        line-height: 21.12px;
        text-align: left;
        color: #FFFFFF;


    }
    #btnOuterWrapper, #btnLockedOuterWrapper {
        display: flex;
        flex-flow: column nowrap;
        margin-top: 10px;
    }
    .del-popup-btn {
        margin-top: 30px;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        font-size: 16px;
        font-weight: 500;
        line-height: 21.12px;
        text-align: left;

        padding: 0;
        cursor: pointer;
    }
    .del-popup-btn img {
        width: 25px;
        height: 25px;
        margin-right: 10px;
    }
    #cross {
        background: #2b2b2b1a;
        width: 40px;
        height: 40px;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        
        position: absolute;
        right: -8px;
        top: -7px;
        
        z-index: 1;
    }
    #cross img {
        width: 14px;
        height: 14px;
        cursor: pointer;
    }
    @media screen and (max-width: 576px) {
        #deletePopup {
            width: 350px;
            height: auto;
            margin-left: -175px;
            margin-top: -250px;
            padding: 50px 30px;
            align-items: center;
        }
        #popup-heading {
            font-size: 18px;
            margin-bottom: 10px;
        }
        #btnOuterWrapper {
            margin-top: 0;
        }
        #bookBtn, #bookCancelBtn {
            width: 120px;
        }
    }
</style>
<style>
    #deletePopup {
        min-width: 500px !important;
        padding: 40px !important;
        position: fixed;
        top: 50px !important;
        left: 50%;
        z-index: 1000;
        margin-top: 0px !important;
        margin-left: -250px !important;
        row-gap: 10px;
        border-radius: 10px;
    }
    #popup-heading {
        font-size: 22px;
        font-weight: 600;
        line-height: 30px;
        text-align: left;

    }
    #popup-form .required {
        color: #FEFA6A;
    }

    #popup-form .btns {

        min-width: 100%;
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        margin: 20px auto 20px auto;
    }

    #popup-form .btns .btn:first-child {
        margin-right: 10px;
    }
    .li-group-item {
        color: #111111;
        margin-bottom: 10px;
    }
</style>

<div id='bookingPopupInner'>   
    <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
    <div id='cross' onclick='closePopup()'>
        <img src="assets/svg/x-icon.svg" alt="">
    </div>
    <div>
        <?php
            $order = new MyApp\Classes\Order;
            $order->my_booking_details($id);
        ?>
    </div>
</div>