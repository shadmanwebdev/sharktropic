function forgot_password(event) {
    event.preventDefault();
    var formData = new FormData();

    const emailValue = $('#email-field-1').val();

    if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        $('#email-wrapper-1').removeClass('invalid');
        $('#email-error-1').html('');

        formData.append('forgot_password', 'true');
        formData.append('email', emailValue);
    
        fetch('./controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            // var alert = document.getElementById('msg-response');

            // if($.trim(response) == '1') {
            //     console.log($.trim(response));
            //     // alert.innerHTML = "<div class='success'>Reset email sent</div>";
            // } else if ($.trim(response) == '2') {
            //     alert.innerHTML = "<div class='error'>This email is not registered</div>";
            // } else {
            //     alert.innerHTML = "<div class='error'>There was an error.</div>";
            // }
        })
        .catch( err => console.log(err));
    } else {
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-1').html('');
            $('#email-wrapper-1').removeClass('invalid');
        } else {
            if(email) {
                $('#email-error-1').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-1').addClass('invalid');
            } else {
                $('#email-error-1').html('<div>The Email field is required</div>');
                $('#email-wrapper-1').addClass('invalid');
            }
        }
    }
}
async function login() {
    var formData = new FormData();

    const email = $('#email-field-2').val();
    const password = $('#pwd-field-1').val();

    formData.append('email', email);
    formData.append('password', password);
    formData.append('login', 'true');

    const emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (email && email.match(emailPattern) && password) {
        load_start();

        $('#email-wrapper-2').removeClass('invalid');
        $('#email-error-2').html('');
        $('#pwd-wrapper-1').removeClass('invalid');
        $('#pwd-error-1').html('');

        try {
            var res = await fetch('./controllers/user-handler.php', {
                method: 'POST',
                body: formData
            });
            var responseText = await res.text();
            load_end();

            console.log(responseText);

            if ($.trim(responseText) == '1') {
                window.location.href = './admin/';
            } else if ($.trim(responseText) == '7' || $.trim(responseText) == '8') {
                window.location.href = './';
            } else if ($.trim(responseText) == '11') {
                var formData2 = new FormData();
                formData2.append('create_order', 'true');

                try {
                    var createOrder = await fetch('./controllers/order-handler', {
                        method: 'POST',
                        body: formData2
                    });
                    var createOrderResponse = await createOrder.text();
                    console.log(createOrderResponse);
                } catch (err) {
                    console.log(err);
                }
            } else if ($.trim(responseText) == '12') {
                window.location.href = './signup-confirmation';
            } else {
                $('#ms-response-1').html("<div class='error'>Invalid email or password</div>");
            }
        } catch (err) {
            console.log(err);
        }
    } else {
        // Email error
        if (email && email.match(emailPattern)) {
            $('#email-error-2').html('');
            $('#email-wrapper-2').removeClass('invalid');
        } else {
            if (email) {
                $('#email-error-2').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-2').addClass('invalid');
            } else {
                $('#email-error-2').html('<div>The Email field is required</div>');
                $('#email-wrapper-2').addClass('invalid');
            }
        }
        // Password error
        if (password) {
            $('#pwd-error-1').html('');
            $('#pwd-wrapper-1').removeClass('invalid');
        } else {
            $('#pwd-error-1').html('<div>Password cannot be blank</div>');
            $('#pwd-wrapper-1').addClass('invalid');
        }
    }
}

function signup() {
    var formData = new FormData();

    const name = $('#name-field-1').val();
    const email = $('#email-field-3').val();
    const password = $('#pwd-field-2').val();

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

        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('signup', 'true');


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
                    window.location.href = './verify-email';
                } 
                else {
                    $('#ms-response-2').html("<div class='error'>Invalid email or password</div>");
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
function verify_login(event) {
    event.preventDefault();
    var formData = new FormData();

    const code = $('#code').val();

    formData.append('code', code);
    formData.append('verify_login', 'true');

    if (code) {
        fetch('./controllers/login-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            setTimeout(function() {
                load_end();
                console.log(response);
                if ($.trim(response) == '1') {
                    window.location.href = './admin/index';
                    // $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New FAQ created!</div></div>");
                } else {
                    $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> Incorrect Code!</div></div>");
                }
            }, 500);
        })
        .catch(err => console.log(err));
    } else {
        $('#code').addClass('invalid');
        $('#codeError').html('<div>Code cannot be blank</div>');
    }
}
function update_password(event) {
    event.preventDefault();
    var formData = new FormData();

    const selector = $('#selector').val();
    const validator = $('#validator').val();
    const new_password = $('#pwd-field-3').val();
    const repeat_password = $('#pwd-field-4').val();
    
    if(new_password && repeat_password && new_password == repeat_password) {
        load_start();

        $('#pwd-wrapper-3').removeClass('invalid');
        $('#pwd-error-3').html('');

        $('#pwd-wrapper-4').removeClass('invalid');
        $('#pwd-error-4').html('');
        
        formData.append('update_password', 'true');
        formData.append('selector', selector);
        formData.append('validator', validator);
        formData.append('new_password', new_password);
        formData.append('repeat_password', repeat_password);
    
        fetch('./controllers/user-handler', {
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
                    $('#ms-response-4').html("<div class='success'>Password updated!</div>");
                } else {
                    $('#ms-response-4').html("<div class='error'>There was an error</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else if (!new_password || !repeat_password) {

        // Password error
        if(new_password) {
            $('#pwd-error-3').html('');
            $('#pwd-wrapper-3').removeClass('invalid');
        } else {
            $('#pwd-error-3').html('<div>The Password field is required</div>');
            $('#pwd-wrapper-3').addClass('invalid');
        }

        if(new_password) {
            $('#pwd-error-4').html('');
            $('#pwd-wrapper-4').removeClass('invalid');
        } else {
            $('#pwd-error-4').html('<div>The Password field is required</div>');
            $('#pwd-wrapper-4').addClass('invalid');
        }
    } else if (new_password != repeat_password) {
        
        $('#pwd-error-4').html("<div>Passwords don't match</div>");
        $('#pwd-wrapper-4').addClass('invalid');
        
    }
}
function email_setup(event) {
    event.preventDefault();
    var formData = new FormData();

    const email_setup = $('#email_setup').val();
    const smtp_host = $('#smtp_host').val();
    const smtp_encryption = $('#smtp_encryption').val();
    const smtp_port = $('#smtp_port').val();
    const username = $('#username').val();
    const password = $('#password').val();
    
    if(
        email_setup
    ) {
        formData.append('email_setup', email_setup);
        formData.append('smtp_host', smtp_host);
        formData.append('smtp_encryption', smtp_encryption);
        formData.append('smtp_port', smtp_port);
        formData.append('username', username);
        formData.append('password', password);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> SMTP details updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        // console.log(email_setup, smtp_host, smtp_encryption, smtp_port, username, password);
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
    }
}
function update_user() {
    var formData = new FormData();

    const photo = $('input#image')[0].files[0];
    const name = $('#name-field').val();
    const email = $('#email-field').val();
    const password = $('#password-field').val();
    const password_repeat = $('#password-field-2').val();
    
    if(
        name && email && (password && password_repeat && password == password_repeat) || (!password && !password_repeat)
    ) {
        load_start();

        formData.append('update_user', 'true');
        formData.append('name', name);
        formData.append('email', email);
        if(password) {
            formData.append('pwd', password);
        }
        formData.append('photo', photo);

        fetch('./controllers/user-handler', {
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
                    $('#message-response').html("<div class='success'>Profile information updated!</div></div>");
                } else {
                    $('#message-response').html("<div class='error'>There was an error</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response').html("<div class='error'>There was an error</div>");
    }
}