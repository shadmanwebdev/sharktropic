<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    $type = $_GET['type'];
?>





<div id='bookingPopupInner' class='add-news-popup' style='overflow: hidden;'>   
    <div>
        <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
        <div id='cross' onclick='closePopup()'>
            <img src="assets/cross.svg" alt="">
        </div>
        <div>
            <div id="popup-heading">
                Create Coupon
            </div>
            
            <form action="" class='popup-form scrollable-div-y' id='popup-form'>
                <input name="coupon_id" id="coupon_id" type="hidden" value='<?= $coupon_id; ?>'>
                
                <div class="row" id='row-1'>
                    <div class="coluumn" id='column-1'>
    
                        <div class="input-wrapper" id='name-wrapper'>
                            <label for="title">Offer Title<span class='required'>*</span></label>
                            <input name="name" id="title-field" type="name" class="input-field" placeholder='Type here'>
                            <div id='title-error' class="error-text"></div>
                        </div>
                        <div class="input-wrapper" id='name-wrapper'>
                            <label for="coupon">Coupon Code<span class='required'>*</span></label>
                            <input name="coupon" id="coupon-field" type="name" class="input-field" placeholder='Type here'>
                            <div id='coupon-error' class="error-text"></div>
                        </div>
                        <div class="input-wrapper" id='name-wrapper'>
                            <label for="amount">Expiry Date<span class='required'>*</span></label>
                            <input name="expiry" id="expiry-field" type="name" class="input-field" placeholder='Type here'>
                            <div id='expiry-error' class="error-text"></div>
                        </div>
                        <div class="input-wrapper" id='name-wrapper'>
                            <label for="percent">Add percentage<span class='required'>*</span></label>
                            <input name="percent" id="percent-field" type="name" class="input-field" placeholder='Type here'>
                            <div id='percent-error' class="error-text"></div>
                        </div>
                    </div>
                </div>
                <div class="row" id='row-2'>
               
                    <span class='btns'>
                        <span class='btn admin-btn-2' onclick='closePopup()'>
                            Cancel
                        </span>
                        <span class='btn admin-btn-1' onclick='create_coupon(event)'>
                            Save
                        </span>
                    </span>
            
                </div>
                <div class="row" id='row-3'>
               
                    <!-- Response -->
                    <div class='message-response' id='message-response-1'></div>
            
                </div>
        
            </form>
    
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
    function create_coupon(event) {
        event.preventDefault();
        var formData = new FormData();

        const title = $('#title-field').val();
        const coupon = $('#coupon-field').val();
        const expiry = $('#expiry-field').val();
        const percent = $('#percent-field').val();

        let page = get_page();

        if (page == 'subscribers') {
            page = page;
        } else if (page == 'index') {
            page = '';
        }
        let return_url = '../admin/' + page;

        console.log(title, coupon, expiry, percent);

        if (title && coupon && expiry && percent) {
            
            load_start();

            // Clear error messages
            $('#title-error, #coupon-error, #expiry-error, #percent-error').html('');
            
            formData.append('create_coupon', 'true');
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

                                const couponsDiv = $('.content .rows');
                                
                                if (couponsDiv.length) {
                                    couponsDiv.prepend(response.html);
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
