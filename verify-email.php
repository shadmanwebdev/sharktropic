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
            <h2>Verify Email</h2>
            <p class="subtitle">We sent a verification code via email. </p>
        </div>
        <div class="input-wrapper" id='code-wrapper-1'>
            <input value="<?= $_SESSION['code']; ?>" name="code" id="code" type="text" class="input-field" placeholder='Enter code'>
            <div id='code-error-1' class="error-text"></div>
        </div>
        
        <span id='login-submit' class="g-btn" onclick='verify(event)'>Verify</span>
        
    </form>
</div>


    









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
        formData.append('verify_login', 'true');

        if (code) {
            fetch('./controllers/user-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();
            })
            .then(response => {
                console.log(response);
                if ($.trim(response) == '1') {
                    window.location.href = './verification';
                } else {
                    window.location.href = './verification';
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
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>