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
        padding: 20px 20px 50px 20px;
        min-height: 100vh;
        width: 100%;
        background: rgba(29, 37, 52, .8);
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
    }
    .dt-now {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 15px;
        margin-left: 35px;
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













<div class='page-wrapper'>

    <div class='logo-outer'>
        <div class="logo-dt">
            <div class="logo float-left">
                <a href="./">
                    <!-- Logo -->
                    <img src="assets/logo.png?v=1" alt="" class="img-fluid">
                </a>
            </div>
            <div class='dt-now'>03/17/2024 1:33am DMV</div>
        </div>
    </div>

    

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


        <style>
            /* range input */
            .range-status {
                margin-bottom: 10px;
            }
            .range-container {
                margin-top: 3px;
            }
            input[type=range] {
                background: transparent;
                -webkit-appearance: none;
                width: 35px;
                margin: 0;
            }

            /* Track styles */
            input[type=range]::-webkit-slider-runnable-track {
                width: 100%;
                height: 22px;
                cursor: pointer;
                box-shadow: none;
                border-radius: 20px;
                border: 0;
            }
            input[type=range]::-moz-range-track {
                width: 100%;
                height: 22px;
                cursor: pointer;
                box-shadow: none;
                border-radius: 20px;
                border: 0;
            }
            input[type=range]::-ms-track {
                width: 100%;
                height: 22px;
                cursor: pointer;
                box-shadow: none;
                border-radius: 20px;
                border: 0;
                background: transparent;
                color: transparent;
            }

            input[type=range].light-track::-webkit-slider-runnable-track {
                background: #2F405F;
                border: 2px solid #FEFA6A; /* Yellow border */
            }
            input[type=range].light-track::-moz-range-track {
                background: #2F405F;
                border: 2px solid #FEFA6A; /* Yellow border */
            }
            input[type=range].light-track::-ms-fill-lower {
                background: #2F405F;
            }
            input[type=range].light-track::-ms-fill-upper {
                background: #2F405F;
            }

            input[type=range].dark-track::-webkit-slider-runnable-track {
                background: #FEFA6A;
            }
            input[type=range].dark-track::-moz-range-track {
                background: #FEFA6A;
            }
            input[type=range].dark-track::-ms-fill-lower {
                background: #FEFA6A;
            }
            input[type=range].dark-track::-ms-fill-upper {
                background: #FEFA6A;
            }

            /* Thumb styles */
            input[type=range]::-webkit-slider-thumb {
                box-sizing: border-box;
                -webkit-appearance: none;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                cursor: pointer;
            }
            input[type=range]::-moz-range-thumb {
                box-sizing: border-box;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                cursor: pointer;
            }
            input[type=range]::-ms-thumb {
                box-sizing: border-box;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                cursor: pointer;
            }

            input[type=range].light-track::-webkit-slider-thumb {
                width: 18px;
                height: 18px;
                box-sizing: border-box;
                background-color: #FEFA6A; /* Yellow thumb */
                border: 3px solid #2F405F; /* Dark blue border */
            }
            input[type=range].light-track::-moz-range-thumb {
                width: 18px;
                height: 18px;
                box-sizing: border-box;
                background-color: #FEFA6A; /* Yellow thumb */
                border: 3px solid #2F405F; /* Dark blue border */
            }
            input[type=range].light-track::-ms-thumb {
                width: 18px;
                height: 18px;
                box-sizing: border-box;
                background-color: #FEFA6A; /* Yellow thumb */
                border: 3px solid #2F405F; /* Dark blue border */
            }

            input[type=range].dark-track::-webkit-slider-thumb {
                width: 21.5px;
                height: 21.5px;
                background-color: #2F405F; /* Dark blue thumb */
                border: 2px solid #FEFA6A; /* Yellow border */
            }
            input[type=range].dark-track::-moz-range-thumb {
                width: 21.5px;
                height: 21.5px;
                background-color: #2F405F; /* Dark blue thumb */
                border: 2px solid #FEFA6A; /* Yellow border */
            }
            input[type=range].dark-track::-ms-thumb {
                width: 21.5px;
                height: 21.5px;
                background-color: #2F405F; /* Dark blue thumb */
                border: 2px solid #FEFA6A; /* Yellow border */
            }

            /* Focus styles */
            input[type=range]:focus {
                outline: none;
            }

        </style>


        <!-- Newsletter -->
        <div class="newsletter">
            <div class="newsletter_content">
                <div class="newsletter_content_inner">
                    <div class="row">
                        <div class="col">
                            <div class="section_title_container text-center">
                                <div class="section_title">Add my email to your mailing list</div>
                                <div class="section_subtitle">I understand that i can opt out at any time</div>
                            </div>
                        </div>
                    </div>
                    <div class='row newsletter_container'>
                        <div class='col-lg-10 offset-lg-1'>
                            <div class='newsletter_form_container' id='email-wrapper'>
                                <form action='#'>
                                    <input id='email-field' type='email' class='newsletter_input' required='required' placeholder='Enter your email'>
                                    <button type='submit' class='newsletter_button' onclick='add_to_mailing_list(event)'>Subscribe</button>
                                </form>
                                <div class='error' id='email-error'></div>
                                <div class='message-response' id='message-response-1'></div>
                            </div>
                            <div class="newsletter_text">
                                <div class='range-wrapper' style='margin-bottom: 10px; margin-left: 10px; margin-right: 10px;'>
                                    <div class='range-container'>
                                        <input style='background: transparent;' onchange='changeTheme();' type='range' min='1' max='2' value='2' class='theme dark-track' id='theme' name='theme'>
                                    </div>
                                </div>
                                <span style='margin-bottom: 10px;'>
                                    Notify me when the web shop is updated with new items
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

<script defer>
    function changeTheme() {   
        var theme = document.getElementById('theme');
        var themeValue = theme.value;

        if(themeValue == '2') {
            theme.classList.remove('light-track');
            theme.classList.add('dark-track');
        } else if(themeValue == '1') {
            theme.classList.remove('dark-track');
            theme.classList.add('light-track');
        }

        
    }
</script>
    

<script defer>
    function add_to_mailing_list(event) {
        event.preventDefault();
        var formData = new FormData();

        const email = $('#email-field').val();

        // console.log(email, password);

        if(
            email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
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
                        $('#message-response-1').html("<div class='error'>Invalid email or password</div>");
                    } 
                    else {
                        $('#message-response-1').html("<div class='error'>Invalid email or password</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Email error
            if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                $('#email-error').html('');
                $('#email-wrapper').removeClass('invalid');
            } else {
                if(email) {
                    $('#email-error').html('<div>Please enter a valid email address</div>');
                    $('#email-wrapper').addClass('invalid');
                } else {
                    $('#email-error').html('<div>The Email field is required</div>');
                    $('#email-wrapper').addClass('invalid');
                }
            }
        }
    }
</script>





<?php
    include './partials/footer.php';
?>