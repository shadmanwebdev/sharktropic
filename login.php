<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<?php
    // include './partials/announcement.php';
?>


<!-- Form -->
<style>
    form {
        max-width: 460px;
        padding: 50px 30px;
        margin: 0px auto;
        background-color: #394152;
        border-radius: 6px;
    }
    form .form-header{
        text-align: center;
        margin-bottom: 40px;
    }
    form h2 {
        font-size: 25px;
        line-height: 1;
        font-weight: 600;
        margin: 0 0 15px;
        color: #FFFFFF;
    }
    form p.subtitle {
        margin: 0;
        font-size: 14px;
        font-weight: 500;
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
        color: #ffffff;
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


    #login-form ::-webkit-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    #login-form ::-moz-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    #login-form ::-ms-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    @media screen and (min-width: 576px) { 
        form {
            padding: 50px;
        }  
    }
</style>


<div class='page-wrapper'>
    <style>
        .logo-outer {
            width: 100%;
            padding: 0px 100px 50px 100px;
        }
    </style>


    <div class='logo-outer'>
        <div class="logo float-left">
            <a href="./">
                <!-- Logo -->
                <img src="assets/logo-new.svg?v=1" alt="" class="img-fluid">
            </a>
        </div>
    </div>
    <!-- Log in form -->
    <form action="" id='login-form'>
        <div class="form-header">
            <h2>Welcome Back!</h2>
            <p class="subtitle">Enter Your Details</p>
        </div>
        <div class="input-wrapper" id='email-wrapper-2'>
            <input name="email" id="email-field-2" type="email" class="input-field" placeholder='Enter your email'>
            <div id='email-error-2' class="error-text"></div>
        </div>
        <div class="input-wrapper" id='pwd-wrapper-1'>
            <input name="password" id="pwd-field-1" type="password" class="input-field" placeholder='Password'>
            <div id='pwd-error-1' class="error-text"></div>
        </div>
    
        
        <div class="forgot-link-wrapper" >
            <span class="forgot-link">
                <button onclick="popup('forgot-pwd-popup');" type="button" at-attr="forgot_password" class="m-flat"> Forgot password? </button>
            </span>
        </div>
    
        <span id='login-submit' class="g-btn" onclick="login();">Log In</span>
        
        <!-- Response -->
        <div class='ms-response' id='ms-response-1'></div>
    
        <div class="signup-link">
            <span>
                Don't have an account? <a id='show-signup-button' class="m-flat" href='./signup'> Sign Up </a>
            </span>
        </div>


        <style>
            .google-btn {
                width: 100%;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgba(255, 255, 255, 0.1);
                color: rgba(255, 255, 255, 1);
                border: 1px solid #dadce0;
                border-radius: 4px;
                font-family: 'Roboto', Arial, sans-serif;
                font-size: 14px;
                font-weight: 500;
                padding: 0;
                height: 50px;
                cursor: pointer;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
                transition: background-color 0.3s, box-shadow 0.3s;
            }
            
            /* .google-btn:hover {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
                background-color: #f8f8f8;
            } */
            
            .google-btn:active {
                background-color: #eee;
            }
            
            .google-icon-wrapper {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
            }
            
            .google-icon {
                width: 18px;
                height: 18px;
            }
            
            .btn-text {
                padding: 0 12px 0 6px;
                font-family: 'Roboto', sans-serif;
            }
        </style>

        <span class="google-btn" onclick="window.location.href='auth/google.php'">
            <div class="google-icon-wrapper">
                <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    <path fill="none" d="M0 0h48v48H0z"/>
                </svg>
            </div>
            <span class="btn-text">Continue with Google</span>
        </span>


        <!-- <div class="cotinue-with-google" style='width: 100%; margin-bottom: 15px;'>
            <img src="assets/cotinue-with-google.png" alt="" style='width: 100%;'>
        </div>
        <div class="cotinue-with-facebook" style='width: 100%;'>
            <img src="assets/cotinue-with-facebook.png" alt="" style='width: 100%;'>
        </div> -->
    
    </form>
</div>


    









<script>

    function login_onchage() {
        var emailInput2 = document.getElementById('email-field-2');
        var pwdInput1 = document.getElementById('pwd-field-1');
    
        if(typeof(emailInput2) != 'undefined' && emailInput2 != null) {
            emailInput2.addEventListener('change', function() {
                if(emailInput2.value && emailInput2.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                    $('#email-error-2').html('');
                    $('#email-wrapper-2').removeClass('invalid');
                    if(typeof(pwdInput1) != 'undefined' && pwdInput1 != null) {
                        if(pwdInput1.value) {
                            $('#login-submit').addClass('active');
                        } else {
                            $('#login-submit').removeClass('active');
                        }
                    }
                } else {
                    $('#login-submit').removeClass('active');
                    if(emailInput2.value) {
                        $('#email-error-2').html('<div>Please enter a valid email address</div>');
                        $('#email-wrapper-2').addClass('invalid');
                    } else {
                        $('#email-error-2').html('<div>The Email field is required</div>');
                        $('#email-wrapper-2').addClass('invalid');
                    }
                }
            });
        }
        if(typeof(pwdInput1) != 'undefined' && pwdInput1 != null) {
            pwdInput1.addEventListener('change', function() {
                if(pwdInput1.value) {
                    console.log(pwdInput1.value);
                    $('#pwd-error-1').html('');
                    $('#pwd-wrapper-1').removeClass('invalid');
                    if(emailInput2.value && emailInput2.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                        if(emailInput2.value) {
                            $('#login-submit').addClass('active');
                        } else {
                            $('#login-submit').removeClass('active');
                        }
                    }
                } else {
                    $('#pwd-error-1').html('<div>The Password field is required</div>');
                    $('#pwd-wrapper-1').addClass('invalid');
                }
            });
        }
    }
    login_onchage();

    
</script>



<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>