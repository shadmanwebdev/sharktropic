function pay() {
    var formData = new FormData();

    const interval_length = $('#interval_length').val();
    const total_price = $('#total_price').val();
    const emailValue = $('#email-field-1').val();
    const fnameValue = $('#fname-field-1').val();
    const lnameValue = $('#lname-field-1').val();
    const cardnumValue = $('#cardnum-field').val();
    const expireValue = $('#expire-field').val().trim();

    var currentDate = new Date(); // Get the current date
    var inputDate = new Date(expireValue + '-01'); // Assuming day as 01

    if(
        total_price && interval_length &&
        cardnumValue && expireValue && expireValue.match(/^\d{4}-\d{2}$/) && inputDate > currentDate &&
        fnameValue && lnameValue &&
        emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
    ) {
        
        load_start();


        $('#email-wrapper-1').removeClass('invalid');
        $('#fname-wrapper-1').removeClass('invalid');
        $('#lname-wrapper-1').removeClass('invalid');
        $('#cardnum-wrapper').removeClass('invalid');
        $('#expire-wrapper').removeClass('invalid');

        $('#email-error-1').html('');
        $('#fname-error-1').html('');
        $('#lname-error-1').html('');
        $('#cardnum-error').html('');
        $('#expire-error').html('');

        formData.append('create_subscription', 'true');
        formData.append('interval_length', interval_length);
        formData.append('total_price', total_price);
        formData.append('email', emailValue);
        formData.append('firstname', fnameValue);
        formData.append('lastname', lnameValue);
        formData.append('cardnum', cardnumValue);
        formData.append('expire', expireValue);

        fetch('./authorize.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.json()      
        })
        .then(response => {
            console.log(response); 
            setTimeout(function() {
                load_end();
                var result_code = response.result_code;
                var rescode = response.response_code;
                console.log(result_code, rescode);
                // var subscription_id = response.subscription_id;
                
                // console.log('./confirmation?rescode='+rescode+'&result='+result_code);
                window.location.href = './confirmation2?rescode='+rescode+'&result='+result_code;
            }, 1000);     
        })
        .catch( err => console.log(err));
    } else {
        // Card Number
        if(cardnumValue) {
            $('#cardnum-error').html('');
            $('#cardnum-wrapper').removeClass('invalid');
        } else {
            $('#cardnum-error').html('<div>Field cannot be blank</div>');
            $('#cardnum-wrapper').addClass('invalid');
        }
        // Expiration
        if(expireValue) {
            if (expireValue.match(/^\d{4}-\d{2}$/)) { // Check if input matches 'yyyy-mm' format
                var inputDate = new Date(expireValue + '-01'); // Assuming day as 01

                if (inputDate > currentDate) { // Check if input is a future month
                    $('#expire-error').html('');
                    $('#expire-wrapper').removeClass('invalid');
                    enableSinglePayButton(amountInput1.value, emailInput1.value, fnameInput1.value, lnameInput1.value, cardnumInput1.value, expireInput1.value, cvcInput1.value, addressInput1.value, cityInput1.value, stateInput1.value, countryInput1.value, zipcodeInput1.value);
                } else {
                    $('#payment-submit').removeClass('active');
                    $('#expire-error').html('<div>Must be a future month</div>');
                    $('#expire-wrapper').addClass('invalid');
                }
            } else {
                $('#payment-submit').removeClass('active');
                $('#expire-error').html('<div>Invalid format (yyyy-mm)</div>');
                $('#expire-wrapper').addClass('invalid');
            }
        } else {      
            $('#payment-submit').removeClass('active');        
            $('#expire-error').html('<div>Required</div>');
            $('#expire-wrapper').addClass('invalid');
        }
        // First name
        if(fnameValue) {
            $('#fname-error-1').html('');
            $('#fname-wrapper-1').removeClass('invalid');
        } else {
            $('#fname-error-1').html('<div>Field cannot be blank</div>');
            $('#fname-wrapper-1').addClass('invalid');
        }
        // Last name
        if(lnameValue) {
            $('#lname-error-1').html('');
            $('#lname-wrapper-1').removeClass('invalid');
        } else {
            $('#lname-error-1').html('<div>Field cannot be blank</div>');
            $('#lname-wrapper-1').addClass('invalid');
        }
        // Email
        if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-1').html('');
            $('#email-wrapper-1').removeClass('invalid');
        } else {
            if(emailValue) {
                $('#email-error-1').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-1').addClass('invalid');
            } else {
                $('#email-error-1').html('<div>The Email field is required</div>');
                $('#email-wrapper-1').addClass('invalid');
            }
        }
    }
    // console.log('payment');
}
function one_time_payment() {
    var formData = new FormData();

    const emailValue = $('#email-field-1').val();
    const fnameValue = $('#fname-field-1').val();
    const lnameValue = $('#lname-field-1').val();
    const cardnumValue = $('#cardnum-field').val();
    const expireValue = $('#expire-field').val().trim();
    const cvcValue = $('#cvc-field').val();

    // Billing details
    const addressValue = $('#address-field').val();
    const cityValue = $('#city-field').val();
    const stateValue = $('#state-field').val();
    const countryValue = $('#country-field').val();
    const zipcodeValue = $('#zipcode-field').val();
    const amountValue = $('#amount-field').val();

    
    var currentDate = new Date(); // Get the current date
    var inputDate = new Date(expireValue + '-01'); // Assuming day as 01

    if(
        amountValue && cardnumValue &&
        expireValue && expireValue.match(/^\d{4}-\d{2}$/) && inputDate > currentDate &&
        cvcValue && fnameValue && lnameValue &&
        emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
        && addressValue && cityValue && stateValue && countryValue && zipcodeValue
    ) {
        
        load_start();


        $('#amount-wrapper').removeClass('invalid');
        $('#email-wrapper-1').removeClass('invalid');
        $('#fname-wrapper-1').removeClass('invalid');
        $('#lname-wrapper-1').removeClass('invalid');
        $('#cardnum-wrapper').removeClass('invalid');
        $('#expire-wrapper').removeClass('invalid');
        $('#cvc-wrapper').removeClass('invalid');
        $('#address-wrapper').removeClass('invalid');
        $('#city-wrapper').removeClass('invalid');
        $('#state-wrapper').removeClass('invalid');
        $('#country-wrapper').removeClass('invalid');
        $('#zipcode-wrapper').removeClass('invalid');

        $('#amount-error').html('');
        $('#email-error-1').html('');
        $('#fname-error-1').html('');
        $('#lname-error-1').html('');
        $('#cardnum-error').html('');
        $('#expire-error').html('');
        $('#cvc-error').html('');
        $('#address-error').html('');
        $('#city-error').html('');
        $('#state-error').html('');
        $('#country-error').html('');
        $('#zipcode-error').html('');

        formData.append('create_singlepayment', 'true');
        formData.append('amount', amountValue);
        formData.append('email', emailValue);
        formData.append('firstname', fnameValue);
        formData.append('lastname', lnameValue);
        formData.append('cardnum', cardnumValue);
        formData.append('cvc', cvcValue);
        formData.append('expire', expireValue);
        formData.append('address', addressValue);
        formData.append('city', cityValue);
        formData.append('state', stateValue);
        formData.append('country', countryValue);
        formData.append('zipcode', zipcodeValue);

        fetch('./authorize2.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.json()      
        })
        .then(response => {
            setTimeout(function() {
                load_end();
                
                console.log(response);
                var result_code = response.result_code;
                var rescode = response.response_code;
                
                // console.log('./confirmation?rescode='+rescode+'&result='+result_code);
                window.location.href = './confirmation?rescode='+rescode+'&result='+result_code;
            }, 1000);
        })
        .catch( err => console.log(err));
    } else {
        // Card Number
        if(amountValue) {
            $('#amount-error').html('');
            $('#amount-wrapper').removeClass('invalid');
        } else {
            $('#amount-error').html('<div>Required<</div>');
            $('#amount-wrapper').addClass('invalid');
        }
        // Card Number
        if(cardnumValue) {
            $('#cardnum-error').html('');
            $('#cardnum-wrapper').removeClass('invalid');
        } else {
            $('#cardnum-error').html('<div>Required<</div>');
            $('#cardnum-wrapper').addClass('invalid');
        }
        // Expiration
        if(expireValue) {
            var currentDate = new Date(); // Get the current date

            if (expireValue.match(/^\d{4}-\d{2}$/)) { // Check if input matches 'yyyy-mm' format
                var inputDate = new Date(expireValue + '-01'); // Assuming day as 01

                if (inputDate > currentDate) { // Check if input is a future month
                    $('#expire-error').html('');
                    $('#expire-wrapper').removeClass('invalid');
                } else {
                    $('#payment-submit').removeClass('active');
                    $('#expire-error').html('<div>Must be a future month</div>');
                    $('#expire-wrapper').addClass('invalid');
                }
            } else {
                $('#payment-submit').removeClass('active');
                $('#expire-error').html('<div>Invalid format (yyyy-mm)</div>');
                $('#expire-wrapper').addClass('invalid');
            }
        } else {      
            $('#payment-submit').removeClass('active');        
            $('#expire-error').html('<div>Required</div>');
            $('#expire-wrapper').addClass('invalid');
        }
        // CVC
        if(cvcValue) {
            $('#cvc-error').html('');
            $('#cvc-wrapper').removeClass('invalid');
        } else {
            $('#cvc-error').html('<div>Required<</div>');
            $('#cvc-wrapper').addClass('invalid');
        }
        // First name
        if(fnameValue) {
            $('#fname-error-1').html('');
            $('#fname-wrapper-1').removeClass('invalid');
        } else {
            $('#fname-error-1').html('<div>Required<</div>');
            $('#fname-wrapper-1').addClass('invalid');
        }
        // Last name
        if(lnameValue) {
            $('#lname-error-1').html('');
            $('#lname-wrapper-1').removeClass('invalid');
        } else {
            $('#lname-error-1').html('<div>Required<</div>');
            $('#lname-wrapper-1').addClass('invalid');
        }
        // Email
        if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email-error-1').html('');
            $('#email-wrapper-1').removeClass('invalid');
        } else {
            if(emailValue) {
                $('#email-error-1').html('<div>Please enter a valid email address</div>');
                $('#email-wrapper-1').addClass('invalid');
            } else {
                $('#email-error-1').html('<div>The Email field is required</div>');
                $('#email-wrapper-1').addClass('invalid');
            }
        }
        // Address
        if(addressValue) {
            $('#address-error').html('');
            $('#address-wrapper').removeClass('invalid');
        } else {
            $('#address-error').html('<div>Required<</div>');
            $('#address-wrapper').addClass('invalid');
        }
        // City
        if(cityValue) {
            $('#city-error').html('');
            $('#city-wrapper').removeClass('invalid');
        } else {
            $('#city-error').html('<div>Required<</div>');
            $('#city-wrapper').addClass('invalid');
        }
        // State
        if(stateValue) {
            $('#state-error').html('');
            $('#state-wrapper').removeClass('invalid');
        } else {
            $('#state-error').html('<div>Required<</div>');
            $('#state-wrapper').addClass('invalid');
        }
        // Country
        if(countryValue) {
            $('#country-error').html('');
            $('#country-wrapper').removeClass('invalid');
        } else {
            $('#country-error').html('<div>Required<</div>');
            $('#country-wrapper').addClass('invalid');
        }
        // Zipcode
        if(zipcodeValue) {
            $('#zipcode-error').html('');
            $('#zipcode-wrapper').removeClass('invalid');
        } else {
            $('#zipcode-error').html('<div>Required<</div>');
            $('#zipcode-wrapper').addClass('invalid');
        }
    }
    // console.log('payment');
}
function enablePayButton(email, fname, lname, cardnum, expire) {
    if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && fname && lname && cardnum && expire) {
        $('#payment-submit').addClass('active');
    }
}
function enableSinglePayButton(amount, email, fname, lname, cardnum, expire, cvc, address, city, state, country, zipcode) {
    if(
        amount && email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) 
        && fname && lname && cardnum && expire && cvc 
        && address && city && state && country && zipcode
    ) {
        $('#payment-submit').addClass('active');
    }
}