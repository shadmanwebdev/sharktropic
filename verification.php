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

    .g-btn:hover {
        color: #111111;
        font-weight: 500;
        opacity: .8;
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
    
        <div class="checkmark">
            <img src="assets/checkmark.svg" alt="" class="img-fluid">
        </div>
    
        <div class="form-header">
            <h2>Verification Completed</h2>
            <p class="subtitle">Email verification completed successfully.</p>
        </div>
    
        <a href='./' id='login-submit' class="g-btn">Continue to home</a>
        
    </form>
</div>


    








<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>