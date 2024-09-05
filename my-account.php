<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<?php
    // include './partials/announcement.php';
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
    form {
        max-width: 460px;
        padding: 50px;
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


    #signup-form ::-webkit-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    #signup-form ::-moz-input-placeholder {
        font-size: 14px;
        color: rgba(166, 174, 195, 1);
    }
    #signup-form ::-ms-input-placeholder {
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


<!-- User Avatar -->
<style>
    /* Profile pic */
    .choose-photo {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        row-gap: 30px;
        border-radius: 20px;
        border-radius: 50%;
        overflow: hidden;
        box-sizing: content-box;
        border: 5px solid rgba(200, 200, 200, .5);
    }
    /* .choose-photo svg {
        margin-bottom: -40px;
        color: rgba(200, 200, 200, .5);
    } */
    #selected-img {
        position: relative;
        width: 120px;
        height: 120px;
        display: none;
        margin: 0 auto;
        border-radius: 20px;
        overflow: hidden;
    }
    #selected-img img {
        width: inherit;
        height: inherit;
        object-fit: cover;
    }
    #selected-img img.img-success {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        right: 5px;
    }
    .profile-placeholder {
        width: 120px;
        height: 120px;
        overflow: hidden;
        margin: 0 auto;
        /* overflow: hidden;
        margin: 0 auto; */
        /* border-style: dotted; */
    }
    .profile-placeholder img {
        width: 100%;
        height: 100%;    
        object-fit: cover;
    }
    .register-btn-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #pfpBtn  {
        margin: 10px auto 0px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        min-width: 145px;
        padding: 12px 16px 12px 16px;
        border-radius: 1000px;
        background: transparent;
        border: 1px solid #44577A;
        color: #FFFFFF;
        font-weight: 600;
        cursor: pointer;
    }
    .profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #err {
        display: none;
        padding: 8px 30px;
        border-radius: 30px;
        background: #D70000;
        margin: 0 auto;
        font-size: 16px;
        position: absolute;
        color: #fff;
    }
    #err.s {
        display: block;
    }
    .selected-option {
        font-weight: 500;
    }
    textarea#description {
        font-weight: 500;
    }
    #img-error .error {
        color: #ff6060;
        font-size: 12px;
        letter-spacing: .6px;
        line-height: 20px;
        padding: 0 12px;
        text-align: center;
        margin-bottom: 10px;
    }
    /* #selected-img img.img-success {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        right: 5px;
    } */
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
                <img src="assets/logo.png?v=1" alt="" class="img-fluid">
            </a>
        </div>
    </div>


    <!-- Sign up form -->
    <?php
        $user = new MyApp\Classes\User();
        $user->updateUserForm();
    ?>
 
</div>


    








<script defer>
    function update_account(event) {
        event.preventDefault();
        var formData = new FormData();

        const update_user = $('#update_user').val();
        const name = $('#name-field-1').val();
        const email = $('#email-field-3').val();
        const password = $('#pwd-field-2').val();
        const photo = $('input#image')[0].files[0];
        

        // console.log(email, password);

        if(
            name && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
        ) {
            load_start();

            $('#name-wrapper-1').removeClass('invalid');
            $('#name-error-1').html('');
            $('#email-wrapper-3').removeClass('invalid');
            $('#email-error-3').html('');
            $('#pwd-wrapper-2').removeClass('invalid');
            $('#pwd-error-2').html('');

            formData.append('update_user', update_user);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('photo', photo);

            fetch('./controllers/user-handler.php', {
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
                        $('#message-response-1').html("<div class='success'>Profile Updated!</div>");
                    } else {
                        $('#message-response-1').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {
            // Name error
            if(name) {
                $('#name-error-1').html('');
                $('#name-wrapper-1').removeClass('invalid');
            } else {
                $('#name-error-1').html('<div>The Name field is required</div>');
                $('#name-wrapper-1').addClass('invalid');
            }
            // Email error
            if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                $('#email-error-3').html('');
                $('#email-wrapper-3').removeClass('invalid');
            } else {
                if(email) {
                    $('#email-error-3').html('<div>Please enter a valid email address</div>');
                    $('#email-wrapper-3').addClass('invalid');
                } else {
                    $('#email-error-3').html('<div>The Email field is required</div>');
                    $('#email-wrapper-3').addClass('invalid');
                }
            }
            // Password error
            if(password) {
                $('#pwd-error-2').html('');
                $('#pwd-wrapper-2').removeClass('invalid');
            } else {
                $('#pwd-error-2').html('<div>The Password field is required</div>');
                $('#pwd-wrapper-2').addClass('invalid');
            }
        }
    }

</script>


<script defer>
    function fireButton(event) {
        event.preventDefault();
        document.getElementById('image').click()
    }


    // Preview Profile Photo
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result);
                $('.profile-placeholder').css({"display":"none"});
                $('#selected-img').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
        var imageInput = document.getElementById('image');
        var imgErrorElement = document.getElementById('img-error');
        var errElement = document.getElementById('err');

        if (imageInput.files.length === 0) {
            imgErrorElement.innerHTML = '';
            errElement.classList.remove('s');
            return;
        }

        var file = imageInput.files[0];
        var imgType = file.name.split('.').pop(); // Get the file extension
        var imgSize = file.size; // Get the file size in bytes

        if (!allowed.includes(imgType)) {
            errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Incorrect File Type</div>';
        } else if (imgSize > 1500000) { // 1.5MB in bytes
            errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Image is too large (max 1.5MB)</div>';
        } else {
            errElement.classList.remove('s');
            imgErrorElement.innerHTML = '';
            readURL(this); // Assuming readURL is a function to handle image preview
        }
    });
</script>



<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>