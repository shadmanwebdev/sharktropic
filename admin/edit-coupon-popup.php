<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    include '../functions.php';
    include '../Classes/Db.php';
    include('../Classes/Coupon.php');
    
    $type = $_GET['type'];
    $coupon_id = $_GET['coupon_id'];
?>


<div id='bookingPopupInner' class='add-news-popup' style='overflow: hidden;'>   
    <div>
        <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
        <div id='cross' onclick='closePopup()'>
            <img src="assets/cross.svg" alt="">
        </div>
        <div>
            <div id="popup-heading">
                Edit Coupon
            </div>

            <?php
                $c = new MyApp\Classes\Coupon;
                $c->coupon_edit_form($coupon_id);
            ?>
    
        </div>
    </div>
</div>


<script defer>
    $(document).ready(function(){
        $(".scrollable-div-y").mCustomScrollbar({
            axis: "y", // Enable vertical scrolling
            theme: "minimal"
        });
    });
</script>


<script defer>
    function update_coupon(event) {
        event.preventDefault();
        var formData = new FormData();

        const coupon_id = $('#coupon_id').val();
        const title = $('#title-field').val();
        const coupon = $('#coupon-field').val();
        const expiry = $('#expiry-field').val();
        const percent = $('#percent-field').val();

        let page = get_page();

        if (page == 'coupons') {
            page = page;
        } else if (page == 'index') {
            page = '';
        }
        let return_url = '../admin/' + page;

        console.log(title, coupon, expiry, percent);

        if (coupon_id && title && coupon && expiry && percent) {
            
            load_start();

            // Clear error messages
            $('#title-error, #coupon-error, #expiry-error, #percent-error').html('');
            
            formData.append('update_coupon', 'true');
            formData.append('coupon_id', coupon_id);
            formData.append('title', title);
            formData.append('coupon', coupon);
            formData.append('expiry', expiry);
            formData.append('percent', percent);
        
            fetch('../controllers/coupon-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(response => {
                setTimeout(function() {

                    // Response
                    console.log(response);

                        setTimeout(function() {
                            load_end();
                            closePopup();

                            // Response
                            console.log(response);

                            // Page
                            var page = get_page();

                            // Check status
                            if($.trim(response.status) == '1') {
                                $('#message-response-1').html("<div class='success'>Coupon created!</div>");

                                const couponDiv = $('#coupon-' + response.coupon_id);
                                if (couponDiv.length) {
                                    couponDiv.replaceWith(response.html);  // Replace with updated HTML
                                }

                            } else {
                                $('#message-response-1').html("<div class='error'>An error occurred while submitting this form!</div>");
                            }

                        }, 500);
                    

                }, 500);
            })
            .catch(err => console.log(err));
        } else {
            // Validation
            if (!title) {
                $('#title-error').html('<div>Field cannot be blank</div>');
            }
            if (!coupon) {
                $('#coupon-error').html('<div>Field cannot be blank</div>');
            }
            if (!expiry) {
                $('#expiry-error').html('<div>Field cannot be blank</div>');
            }
            if (!percent) {
                $('#percent-error').html('<div>Field cannot be blank</div>');
            }
        }
    }

</script>
