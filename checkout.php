<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<style>
    .page-wrapper {
        padding: 20px 20px 50px 20px;
        min-height: 100vh;
        width: 100%;
        background: rgba(29, 37, 52, .8);
    }
</style>


<!-- Form -->
<style>
    .order-forms form {
        max-width: 980px;
        background-color: #394152;
        border-radius: 6px;
        padding: 25px;
    }
    form .form-header {
        text-align: left;
        margin-bottom: 40px;
    }
    form h2 {
        font-size: 25px;
        line-height: 1;
        font-weight: 600;
        margin: 0 0 15px;
        color: #FFFFFF;
    }

    .input-wrapper {
        margin-bottom: 20px;
    }
    .input-field {
        box-sizing: border-box;
        width: 100%;
        padding: 12px 16px;
        transition: border-color 0.3s, color 0.3s;
        max-height: 45px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 16px;
        line-height: 20px;
        border-radius: 6px;
        color: #fff;
        background-color: #394152;
        border: 1px solid #FFFFFF1A;
    }

    .input-field:focus {
        background-color: #394152;
        border: 1px solid gray;
        outline: none;
    }
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-text-fill-color: #fff !important;
        -webkit-box-shadow: 0 0 0px 1000px #394152 inset !important;
        border: 1px solid gray !important;
        outline: none !important;
    }
    .g-btn {
        border: none;
        padding: 16px 26px 16px 26px;
        font-size: 14px;
        line-height: 20px;
        border-radius: 6px;
        color: #111111;
        background: #FEFA6A;
        min-width: 78px;
        transition: opacity .15s ease,background-color .15s ease,box-shadow .15s ease;
        display: inline-block;
        text-align: center;
        display: block;
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        min-height: 40px;
        font-weight: 600;
        cursor: pointer;
    }


    .forgot-link {
        display: flex;
        justify-content: flex-end;
        font-size: 14px;
        line-height: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .forgot-link .m-flat {
        color: #A6AEC3;
        padding: 0;
        background-color: transparent;
        font-size: 13px;
        line-height: 20px;
        border: none;
        outline: none;
    }
    
    .signup-link {
        font-size: 14px;
        line-height: 20px;
        padding-bottom: 30px;
        padding-top: 30px;
        display: flex;
        justify-content: center;
        color: #fff;
    }
    .signup-link .m-flat {
        color: #FEFA6A;
        padding: 0;
        background-color: transparent;
        font-size: 13px;
        line-height: 20px;
        border: none;
        outline: none;
    }


    #shipping-details-form ::-webkit-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    #shipping-details-form ::-moz-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    #shipping-details-form ::-ms-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }


    /* Invalid / Error */
    .invalid input.input-field {
        border-color: #ff6060;
    }
    .error-text {
        color: #ff6060;
        font-size: 12px;
        margin-top: 10px;
        line-height: 1;
        padding: 0 3px;
    }
</style>


<style>
    .order-forms {
        display: flex;
        flex-flow: column nowrap;
        max-width: 900px;
    }
    .order-forms form {
        padding: 25px;
    }
    .order-forms form:first-child {
        margin-right: 0;
        margin-bottom: 30px;
        width: 100%;
    }
    .order-forms form:nth-child(2) {
        width: 100%;
    }
    .input-row {
        display: flex;
        flex-flow: row nowrap;
        width: 100%;
    }
    .input-row .input-wrapper {
        width: 49%;
    }
    .input-wrapper label {
        font-size: 14px;
        font-weight: 400;
        color: rgba(255, 255, 255, 1);
        margin-bottom: 10px;
    }
    .input-row .input-wrapper:first-child {
        margin-right: 2%;
    }
    p.disclaimer {
        font-size: 12px;
        font-weight: 400;
        color: rgba(254, 250, 106, 1);
        text-align: right;
    }
    @media screen and (min-width: 1280px) {
        .order-forms {
            display: flex;
            flex-flow: row nowrap;
            max-width: 1250px;
            margin: 0 auto;
        }
        .order-forms form {
            padding: 50px;
        }
        .order-forms form:first-child {
            margin-right: 2%;
            margin-bottom: 0px;
            width: 65%;
        }
        .order-forms form:nth-child(2) {
            width: 33%;
        }
    }
</style>



<style>
    .collection {
        display: flex;
        flex-flow: column nowrap;
    }
    .collection .content-wrapper {
        width: 100%;
        margin-right: 0;
    }
    .collection .content-main {
        width: 100%;
        padding: 20px 0px;
    }
    .collection .content-main > .title {
        font-weight: 600;
        font-size: 18px;
        padding-bottom: 10px;
        color: #FFFFFF;
        border-bottom: 1px solid #E6EBF31A;
    }
    .collection .body {
        width: 100%;
        padding: 0px 0px 20px 0px;
    }
    .collection .body .rows .c-row {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #E6EBF31A;
        color: #fff;
    }
    .collection .c-row .item:first-child {
        width: 50%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .collection .c-row .item:first-child .thumbnail {
        border-radius: 10px;
        width: 51px;
        height: 51px;
        overflow: hidden;
        margin-right: 20px;
    }
    .collection .c-row .item:first-child .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .collection .c-row .item:nth-child(2) {
        height: 100%;
        width: 25%;
        display: flex;
        align-items: center;
    }
    .collection .c-row .item:nth-child(3) {
        height: 100%;
        width: 15%;
    }
    
    .content-main {
        max-width: 100%;
    }
    .content-main .content {
        min-width: 700px;
    }

    @media screen and (min-width: 768px) {  
        
    } 
    @media screen and (min-width: 1280px) {   
        .collection {
            display: flex;
            flex-flow: row nowrap;
        }
        .collection .content-main {
            width: 100%;
            padding: 20px 20px 50px 20px;
        }
        .collection .content-wrapper {
            width: 100%;
            margin-right: 2%;
        }
    }
</style>


<!-- Form Right (Order Summary) -->
<style>
    .order-summary {

        width: 100%;
        margin-top: 50px;
    }
    .order-info-title {
        font-size: 16px;
        font-weight: 400;
        color: rgba(255, 255, 255, 1);
        margin-bottom: 10px;
    }
    .order-info-row {
        box-sizing: border-box;
        width: 100%;
        padding: 12px 16px;
        transition: border-color 0.3s, color 0.3s;
        max-height: 45px;
        padding-top: 10px;
        padding-bottom: 10px;
        line-height: 20px;
        border-radius: 6px;
        color: #fff;
        background-color: #394152;
        border: 1px solid #FFFFFF1A;    
        margin-bottom: 20px;

        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
    }
    .order-info-row span {
        font-size: 14px;
        font-weight: 400;
        color: rgba(255, 255, 255, 1);
    }
</style>



<div class='page-wrapper'>

    <?php
        include './header-with-cart.php';
    ?>


    <div class='order-forms'>
        <!-- Shipping details form -->
        <form action="" id='shipping-details-form'>
            <div class="form-header">
                <h2>Shipping Address</h2>
            </div>
            <!-- <h4 class="form-heading">Create Account</h4> -->
            <div class="input-row">
                <div class="input-wrapper" id='name-wrapper'>
                    <label for="name">Deliver to</label>
                    <input name="name" id="name-field" type="name" class="input-field" placeholder='Your name'>
                    <div id='name-error' class="error-text"></div>
                </div>
                <div class="input-wrapper" id='phone-wrapper'>
                    <label for="phone">Phone number</label>
                    <input name="phone" id="phone-field" type="phone" class="input-field" placeholder='Enter your number'>
                    <div id='phone-error' class="error-text"></div>
                </div>
            </div>
            <div class="input-row">
                <div class="input-wrapper" id='address-wrapper'>
                    <label for="address">Billing address</label>
                    <input name="address" id="address-field" type="text" class="input-field" placeholder='Enter your address'>
                    <div id='address-error' class="error-text"></div>
                </div>
                <div class="input-wrapper" id='email-wrapper'>
                    <label for="phone">Email</label>
                    <input name="email" id="email-field" type="email" class="input-field" placeholder='Enter your email'>
                    <div id='email-error' class="error-text"></div>
                </div>
            </div>



            <div class='collection'>
                <div class="content-wrapper">
                    <div class="content-main">
                        <div class="title">Products</div>
                        <div class="content-inner scrollable-div">
                            <div class="content">
                                <div class="body">
                                    <div class="rows" id='checkout-items'>

                                        <?php
                                            $cart = new MyApp\Classes\Cart;
                                            $cart->checkout_items();
                                        ?>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
                    

    
    
        </form>
    
        <!-- Checkout form -->
        <form action="" class='shipping-details-form checkout-form' id='shipping-details-form'>
            <div class="form-header">
                <h2>Shipping Address</h2>
            </div>
            <!-- <h4 class="form-heading">Create Account</h4> -->
            
            <div class="input-wrapper" id='promo-wrapper'>
                <label for="promo-field">Promo Code</label>
                <input name="name" id="promo-field" type="text" class="input-field" placeholder='Enter Code'>
                <div id='promo-error' class="error-text"></div>
            </div>

            <?php
                $order = new MyApp\Classes\Order;
                $order->order_summary();
            ?>
    
            <p class='disclaimer'>VAT included, where applicable</p>
            <?php
                if(!isset($_SESSION['user'])) {
            ?>
                <span id='signup-submit' class="g-btn" onclick='create_order();'>Log In</span>
            <?php      
                } else if(isset($_SESSION['user'])) {
            ?>
                <span id='signup-submit' class="g-btn" onclick='create_order();'>Checkout</span>
            <?php      
                }
            ?>


            <!-- Response -->
            <div class='message-response' id='message-response-1'></div>
    
    
        </form>
    </div>

</div>


    









<script defer>
    async function create_order() {


        const nameValue = $('#name-field').val().trim();
        const phoneValue = $('#phone-field').val().trim();
        const addressValue = $('#address-field').val().trim();
        const emailValue = $('#email-field').val().trim();
        const promoValue = $('#promo-field').val().trim();

        let isValid = true;

        if (!nameValue) {
            $('#name-error').html('<div>The Name field is required</div>');
            $('#name-wrapper').addClass('invalid');
            isValid = false;
        } else {
            $('#name-error').html('');
            $('#name-wrapper').removeClass('invalid');
        }

        if (!phoneValue || !phoneValue.match(/^\d+$/)) {
            $('#phone-error').html('<div>Please enter a valid phone number</div>');
            $('#phone-wrapper').addClass('invalid');
            isValid = false;
        } else {
            $('#phone-error').html('');
            $('#phone-wrapper').removeClass('invalid');
        }

        if (!addressValue) {
            $('#address-error').html('<div>The Address field is required</div>');
            $('#address-wrapper').addClass('invalid');
            isValid = false;
        } else {
            $('#address-error').html('');
            $('#address-wrapper').removeClass('invalid');
        }

        if (!emailValue || !emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error').html('<div>Please enter a valid email address</div>');
            $('#email-wrapper').addClass('invalid');
            isValid = false;
        } else {
            $('#email-error').html('');
            $('#email-wrapper').removeClass('invalid');
        }

        if (!promoValue) {
            $('#promo-error').html('');
            $('#promo-wrapper').removeClass('invalid');
        }

        if (isValid) {
            var formData = new FormData();

            formData.append('inititate_order', 'true');
            formData.append('name', nameValue);
            formData.append('phone', phoneValue);
            formData.append('address', addressValue);
            formData.append('email', emailValue);
            formData.append('promo', promoValue);

            try {
                // 1. Initiate Order
                var res = await fetch('./controllers/order-handler.php', {
                    method: 'POST',
                    body: formData
                });
                var responseText = await res.text();
                load_end();

                console.log(responseText);

                var InitOrderRes = JSON.parse(responseText);

                // 2. Create Order
                if (InitOrderRes.status == 'in progress') {
                    
                    var formData2 = new FormData();
                    formData2.append('create_order', 'true');

                    try {
                        var createOrder = await fetch('./controllers/order-handler', {
                            method: 'POST',
                            body: formData2
                        });
                        var createOrderResponse = await createOrder.text();
                        console.log(createOrderResponse);

                        if(createOrderResponse == '1') {
                            window.location.href = 'stripe-integration/create-checkout-session';
                        }
                    } catch (err) {
                        console.log(err);
                    }

                } else if(InitOrderRes.status == 'requires login') {
                    window.location.href = './login';
                } else if(InitOrderRes.status == 'requires email verification') {
                    window.location.href = './signup-confirmation';
                }
            } catch (err) {
                console.log(err);
            }
        }
    }
</script>



<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>