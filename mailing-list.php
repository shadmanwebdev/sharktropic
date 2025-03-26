<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<?php
    // include './partials/announcement.php';
?>

<?php 
    // include './partials/navigation-2.php'; 
?>

<?php 
    // include './partials/cover-section.php'; 
?>





<style>
    .page-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .logo-outer {
        max-width: 1440px;
        margin: 0px auto 50px auto;
        display: flex;
        /* text-align: center; */
        flex-flow: column nowrap;
        justify-content: space-between;
        align-items: center;
    }
    .logo-outer .logo {
        max-width: 250px;
        display: flex;
        justify-content: center;
    }
    .dt-now {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 15px;
        margin-left: 8px;
        color: rgba(255, 255, 255, 1);
    }
    @media screen and (min-width: 1280px) {
        .page-wrapper {
            padding: 20px 50px 50px 50px;
        }
        .logo-outer .logo {
            max-width: 280px;
        }    
        .dt-now {
            font-size: 18px;
        }
    }

</style>


<!-- Form -->
<style>
    .popup {
        position: fixed;
        top: 50%;
        left: 2.5%;
        background-color: #fff;
        padding: 0px;
        width: 95%;
        margin-top: -150px;
        margin-left: 0px;
        z-index: 1000;
        border-radius: 6px;
    }
    .hide_popup {
        display: none;
    }
    .show_popup {
        display: block;
    }
    .popup form {
        width: 100%;
        padding: 50px 30px;
        margin: 0px auto;
        background-color: #394152;
        /* border-radius: 6px; */
    }
    .popup form .form-header{
        text-align: center;
        margin-bottom: 40px;
    }
    .popup form h2 {
        font-size: 25px;
        line-height: 1;
        font-weight: 600;
        margin: 0 0 15px;
        color: #FFFFFF;
    }
    .popup form p.subtitle {
        margin: 0;
        font-size: 14px;
        font-weight: 500;
        color: #FFFFFF;
    }

    .popup .input-wrapper {
        margin-bottom: 20px;
    }
    .popup .input-field {
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
        color: #ffffff;
        background-color: #394152;
        border: 1px solid #FFFFFF1A;
    }

    .popup .input-field:focus {
        background-color: #394152;
        border: 1px solid gray;
        outline: none;
    }
    .popup input:-webkit-autofill,
    .popup input:-webkit-autofill:hover,
    .popup input:-webkit-autofill:focus,
    .popup input:-webkit-autofill:active {
        -webkit-text-fill-color: #fff !important;
        -webkit-box-shadow: 0 0 0px 1000px #394152 inset !important;
        border: 1px solid gray !important;
        outline: none !important;
    }
    .popup .g-btn {
        border: none;
        padding: 16px 26px 16px 26px;
        font-size: 14px;
        line-height: 20px;
        border-radius: 6px;
        color: #111111;
        background: #FEFA6A;
        min-width: 78px;
        transition: opacity .15s ease,background-color .15s ease,box-shadow .15s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        min-height: 45px;
        cursor: pointer;
        font-weight: 500;
        opacity: 1;
        transition: .3s;
    }

    .popup .g-btn:hover {
        color: #111111;
        font-weight: 500;
        opacity: .8;
    }


    .popup ::-webkit-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    .popup ::-moz-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    .popup ::-ms-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    @media screen and (min-width: 576px) { 
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            background-color: #fff;
            padding: 0px;
            width: 500px;
            margin-top: -150px;
            margin-left: -250px;
            z-index: 1000;
            border-radius: 6px;
        }
        .popup form {
            padding: 50px;
        }  
    }
</style>

<style>
    .checkmark {
        width: 90px;
        height: 90px;
        margin: 0 auto 30px auto;
    }
    .checkmark img {
        width: 100%;
        height: 100%;
    }
</style>

<!-- Range Slider -->
<style>
    .notification-slider {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
    }
    .range-wrapper {
        width: 40px;
        margin-bottom: 10px;
    }
    
    .range-container {
        position: relative;
        height: 31px;
        padding: 3px;
        cursor: pointer;
    }
    
    .track {
        position: absolute;
        height: 24px;
        width: 100%;
        background: #1c1c1c;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #f0ed35;
    }
    
    .thumb {
        position: absolute;
        height: 24px;
        width: 24px;
        background: #f0ed35;
        border-radius: 50%;
        top: 3px;
        z-index: 2;
        transition: left 0.2s ease;
    }
    
    .thumb .dot {
        position: absolute;
        height: 22px;
        width: 22px;
        background: #000;
        border-radius: 50%;
        top: 1px;
        left: 1px;
    }
    
    .hidden-input {
        display: none;
    }
    
    /* For the filled part of the track */
    .fill {
        position: absolute;
        height: 100%;
        width: 0;
        background: #f0ed35;
        border-radius: 10px 0 0 10px;
        transition: width 0.2s ease;
    }

    .notify-text {
        font-size: 16px;
        color: #fff;
        margin-left: 15px;
    }

    @media screen and (min-width: 768px) {
        .notification-slider {
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
        }
        .range-wrapper {
            margin-bottom: 0px;
        }
    }
</style>

<div class='popup hide_popup' id='verifyPopup' style='padding: 0;'>
    
    <form action="" id='login-form'>
        <div class="form-header">
            <h2>Verify Phone Number</h2>
            <p class="subtitle">We sent a verification code via sms. </p>
        </div>
        <div class="input-wrapper" id='code-wrapper-1'>
            <input name="code" id="code" type="text" class="input-field" placeholder='Enter code'>
            <div id='code-error-1' class="error-text"></div>
        </div>
        
        <span id='login-submit' class="g-btn" onclick='verify(event)'>Verify</span>
        
    </form>
</div>


<div class='popup hide_popup' id='verifySuccessPopup' style='padding: 0;'>
    
    <form action="" id='login-form'>
        
        <div class="checkmark">
            <img src="assets/checkmark.svg" alt="" class="img-fluid">
        </div>
        
        <div class="form-header">
            <h2>Verification Completed</h2>
            <p class="subtitle">SMS verification completed successfully. </p>
        </div>
        
        <a href='./' id='login-submit' class="g-btn">Continue to home</a>
        
    </form>
</div>





<div class='page-wrapper'>

    
    <?php
        include './logo-centered.php';
    ?>

    

    <div class='mailing-list'>

        <style>
            .mailing-list {
                width: 95%;
                margin: 0 auto;
            }
            
            .newsletter_content {
                width: 100%;
                padding-top: 20px;
                padding-bottom: 94px;
                display: block;
                position: relative;
            }
            .newsletter_content_inner {
                width: 100%; 
            }
            .section_title_container {
                margin-bottom: 30px;
            }
            .section_title {
                font-size: 28px;
                line-height: 1.4;
                color: #FFFFFF;
                font-weight: 600;
                margin-bottom: 18px;
            }
            .section_subtitle {
                font-size: 14px;
                font-weight: 600;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 20px;
                font-weight: 400;
            }

            .newsletter {
                width: 100%;
            }
            .newsletter_form_container {
                display: block;
                position: relative;
            }
            .newsletter_input  {
                width: 100%;
                height: 64px;
                background: #FFFFFF;
                padding-left: 25px;
                border: none;
                outline: none;
                border-radius: 44px;
            }
            .newsletter_input::-webkit-input-placeholder {
                font-size: 15px !important;
                font-weight: 400 !important;
                color: #b3b3b3 !important;
            }
            .newsletter_input:-moz-placeholder {
                font-size: 15px !important;
                font-weight: 400 !important;
                color: #b3b3b3 !important;
            }
            .newsletter_input::-moz-placeholder {
                font-size: 15px !important;
                font-weight: 400 !important;
                color: #b3b3b3 !important;
            } 
            .newsletter_input:-ms-input-placeholder { 
                font-size: 15px !important;
                font-weight: 400 !important;
                color: #b3b3b3 !important;
            }
            .newsletter_input::input-placeholder {
                font-size: 12px !important;
                font-weight: 400 !important;
                color: #b3b3b3 !important;
            }
            .newsletter_button {
                position: absolute;
                top: 7px;
                right: 7px;
                width: 142px;
                height: 50px;
                background: rgba(53, 61, 77, 1);
                color: #FFFFFF;
                font-size: 15px !important;
                letter-spacing: 0.7px;
                border-radius: 44px;
                border: none;
                outline: none;
                cursor: pointer;
                -webkit-transition: all 200ms ease;
                -moz-transition: all 200ms ease;
                -ms-transition: all 200ms ease;
                -o-transition: all 200ms ease;
                transition: all 200ms ease;
            }
            .newsletter_button:hover {
                background: #272c35;
                color: #fff;
            }
            .newsletter_text {
                font-size: 14px;
                color: #FFFFFF;
                margin-top: 19px;
                text-align: center;
                display: flex;
                flex-flow: row wrap;
                justify-content: center;
                align-items: center;
                font-weight: 400;
            }
            .mailing-list .error {
                text-align: center;
                margin-top: 10px;
            }
            
            @media only screen and (min-width: 991px) {
                
                .mailing-list {
                    width: 95%;
                    max-width: 1100px;
                    margin: 0 auto;
                }
                .newsletter {
                    width: 100%;
                    padding-left: 62px;
                    padding-right: 62px;
                }
                .newsletter_content {
                    padding-top: 40px;
                    padding-bottom: 94px;
                }
                .section_title {
                    font-size: 32px;
                }
                
            }
        </style>


        <!-- Newsletter -->
        <div class="newsletter">
            <div class="newsletter_content">
                <div class="newsletter_content_inner">
                    <div class="row">
                        <div class="col">
                            <div class="section_title_container text-center">
                                <div class="section_title">Add your number to our SMS list</div>
                                <!-- <div class="section_title">Add my email to your mailing list</div> -->
                                <div class="section_subtitle">I understand that i can opt out at any time</div>
                            </div>
                        </div>
                    </div>
                    <div class='row newsletter_container'>
                        <div class='col-lg-10 offset-lg-1'>
                            <div class='newsletter_form_container' id='email-wrapper'>
                                <form action='#'>
                                    <input id='email-field' type='email' class='newsletter_input' required='required' placeholder='Enter your number'>
                                    <button type='submit' class='newsletter_button' onclick='add_to_mailing_list(event)'>Subscribe</button>
                                </form>
                                <div class='error' id='email-error'></div>
                                <div class='message-response' id='message-response-1'></div>
                            </div>
                            <div class="newsletter_text">
                            
                            
                                <!-- Range Slider -->
                                <div class='notification-slider'>
                                    <div class="range-wrapper">
                                        <div class="range-container" id="slider-container">
                                            <div class="track">
                                                <div class="fill" id="fill"></div>
                                            </div>
                                            <div class="thumb" id="thumb">
                                                <div class="dot"></div>
                                            </div>
                                            <input type="hidden" id="theme" name="theme" value="2" class="hidden-input">
                                        </div>
                                    </div>

                                    <div class='notify-text'>
                                        <span>Notify me of upcoming drops</span>
                                    </div>
                                </div>
                                
                            
                            </div>
                            
                        </div>
                    </div>


                </div>
            </div>
        </div>


    <?php
        include './partials/bottom-menu.php';
    ?>
</div>



<!-- Range Slider -->
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('slider-container');
        const thumb = document.getElementById('thumb');
        const fill = document.getElementById('fill');
        const hiddenInput = document.getElementById('theme');
        
        // Initialize to position 2 (right side)
        let currentValue = 2;
        updateSliderPosition();
        
        // Toggle function to switch between values 1 and 2
        function toggleValue() {
            // Toggle between 1 and 2
            currentValue = currentValue === 1 ? 2 : 1;
            hiddenInput.value = currentValue;
            
            // Update the visual representation
            updateSliderPosition();
            
            // Call the changeTheme function if it exists
            if (typeof changeTheme === 'function') {
                changeTheme();
            }
        }
        
        // Function to update slider position based on current value
        function updateSliderPosition() {
            // If value is 1, position at 0%, if 2, position at 100%
            const percentage = currentValue === 1 ? 0 : 100;
            
            // Update the thumb position
            const maxOffset = container.clientWidth - thumb.clientWidth; 
            thumb.style.left = `${(percentage / 100) * maxOffset + 2}px`;
            
            // Update the fill width
            fill.style.width = `${percentage}%`;
        }
        
        // Click event for the container
        container.addEventListener('click', toggleValue);
        
        // Click event for the thumb (to ensure it works when clicking directly on thumb)
        thumb.addEventListener('click', function(e) {
            toggleValue();
            e.stopPropagation();
        });
    });
</script>



<script defer>
    function add_to_mailing_list(event) {
        event.preventDefault();
        var formData = new FormData();

        const email = $('#email-field').val();

        // console.log(email, password);

        if(
            email
            // && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
        ) {
            load_start();

            $('#email-wrapper').removeClass('invalid');
            $('#email-error').html('');

            var theme = document.getElementById('theme');
            var themeValue = theme.value;

            formData.append('add_to_mailing_list', 'true');
            formData.append('email', email);
            formData.append('notification', themeValue);


            fetch('./controllers/mailing-list-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    load_end();
                    console.log(response);

                    if($.trim(response) == '1') {
                        popup('verifyPopup');
                    } else {
                        $('#message-response-1').html("<div class='error'>Invalid phone number</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Email error
            // if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            //     $('#email-error').html('');
            //     $('#email-wrapper').removeClass('invalid');
            // } else {
                if(email) {
                    $('#email-error').html('<div>Please enter a valid email address</div>');
                    $('#email-wrapper').addClass('invalid');
                } else {
                    $('#email-error').html('<div>The Email field is required</div>');
                    $('#email-wrapper').addClass('invalid');
                }
            // }
        }
    }
</script>


<script>

    function code_onchage() {
        var codeInput = document.getElementById('code');
    
        if(typeof(codeInput) != 'undefined' && codeInput != null) {
            codeInput.addEventListener('change', function() {
                if(codeInput.value) {
                    console.log(codeInput.value);
                    $('#code-error-1').html('');
                    $('#code-wrapper-1').removeClass('invalid');
                } else {
                    $('#code-error-1').html('<div>The code field is required</div>');
                    $('#code-wrapper-1').addClass('invalid');
                }
            });
        }
    }
    code_onchage();
    
    function verify(event) {
        event.preventDefault();
        var formData = new FormData();

        const code = $('#code').val();

        formData.append('code', code);
        formData.append('verify_phone', 'true');

        if (code) {
            fetch('./controllers/mailing-list-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();
            })
            .then(response => {
                console.log(response);

                if(response == 'approved') {
                    popup('verifySuccessPopup');
                }
                
            })
            .catch(err => console.log(err));
        } else {
            $('#code').addClass('invalid');
            $('#code-error-1').html('<div>Code cannot be blank</div>');
        }
    }
</script>


<?php
    include './partials/footer.php';
?>