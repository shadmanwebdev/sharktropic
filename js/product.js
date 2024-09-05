function update_item_total_for_qty(id, price, qty) {
    var item_total = parseFloat(price).toFixed(2) * qty;
    $("#item-total-"+id).text(item_total);
}
function check_billing_form() {
    var checkout = $('#checkout').val();
    var country = $('#country').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var address = $('#address').val();
    var address2 = $('#address2').val();
    var towncity = $('#towncity').val();
    var province = $('#province').val();
    var zippostalcode = $('#zippostalcode').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var payment_method = check_payment_radio();
    var tos = $('#tos').prop('checked');

    if(
        country && fname && lname && address && towncity && province && zippostalcode &&
        email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && phone
        && payment_method && tos
    ) {
        $('#emailError').html('');
        $('#countryError').html('');
        $('#fnameError').html('');
        $('#lnameError').html('');
        $('#addressError').html('');
        $('#towncityError').html('');
        $('#provinceError').html('');
        $('#zipcodeError').html('');
        $('#phoneError').html('');
        $('#payError').html('');

        $('#check').prop('checked', true);
        console.log('found billing details');
    } else {
        // Email
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#emailError').html('');
            $('#email').removeClass('invalid');
        } else {
            if(email) {
                $('#emailError').html('<div>Please enter a valid email address</div>');
                $('#email').addClass('invalid');
            } else {
                $('#emailError').html('<div>Email cannot be blank</div>');
                $('#email').addClass('invalid');
            }
        }
        // Country
        if(country) {
            $('#countryError').html('');
            $('#country').removeClass('invalid');
        } else {
            $('#countryError').html('<div>Country cannot be blank</div>');
            $('#country').addClass('invalid');
        }
        // Firstname
        if(fname) {
            $('#fnameError').html('');
            $('#fname').removeClass('invalid');
        } else {
            $('#fnameError').html('<div>Firstname cannot be blank</div>');
            $('#fname').addClass('invalid');
        }
        // Lastname
        if(lname) {
            $('#lnameError').html('');
            $('#lname').removeClass('invalid');
        } else {
            $('#lnameError').html('<div>Lastname cannot be blank</div>');
            $('#lname').addClass('invalid');
        }
        // Address
        if(address) {
            $('#addressError').html('');
            $('#address').removeClass('invalid');
        } else {
            $('#addressError').html('<div>Address cannot be blank</div>');
            $('#address').addClass('invalid');
        }
        // Town/City
        if(towncity) {
            $('#towncityError').html('');
            $('#towncity').removeClass('invalid');
        } else {
            $('#towncityError').html('<div>Town/City cannot be blank</div>');
            $('#towncity').addClass('invalid');
        }
        // State/Province
        if(province) {
            $('#provinceError').html('');
            $('#province').removeClass('invalid');
        } else {
            $('#provinceError').html('<div>Province cannot be blank</div>');
            $('#province').addClass('invalid');
        }
        // Zip/Postal Code
        if(zippostalcode) {
            $('#zipcodeError').html('');
            $('#zipcode').removeClass('invalid');
        } else {
            $('#zipcodeError').html('<div>Zip/Postal Code cannot be blank</div>');
            $('#zipcode').addClass('invalid');
        }
        // Phone
        if(phone) {
            $('#phoneError').html('');
            $('#phone').removeClass('invalid');
        } else {
            $('#phoneError').html('<div>Phone cannot be blank</div>');
            $('#phone').addClass('invalid');
        }
    }

}

function submit_billing_form() {
    
    console.log('product.js');

    var checkout = $('#checkout').val();
    var country = $('#country').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var address = $('#address').val();
    var address2 = $('#address2').val();
    var towncity = $('#towncity').val();
    var province = $('#province').val();
    var zippostalcode = $('#zippostalcode').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var payment_method = check_payment_radio();
    var tos = $('#tos').prop('checked');

    if(
        country && fname && lname && address && towncity && province && zippostalcode &&
        email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && phone
        && payment_method && tos
    ) {
        $('#emailError').html('');
        $('#countryError').html('');
        $('#fnameError').html('');
        $('#lnameError').html('');
        $('#addressError').html('');
        $('#towncityError').html('');
        $('#provinceError').html('');
        $('#zipcodeError').html('');
        $('#phoneError').html('');
        $('#payError').html('');

        $('#check').prop('checked', true);

        var loader = document.getElementById('loader');
        loader.classList.add('loader-animation');

        var formData = new FormData();
    
        formData.append('checkout', checkout);
        formData.append('country', country);
        formData.append('fname', fname);
        formData.append('lname', lname);
        formData.append('address', address);
        formData.append('address2', address2);
        formData.append('towncity', towncity);
        formData.append('province', province);
        formData.append('zippostalcode', zippostalcode);
        formData.append('email', email);
        formData.append('phone', phone);
        
    
        
        fetch('./controllers/product-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                // error processing
                throw new Error("HTTP status " + response.status);
            }
            return response.text(); 
        })
        .then(response => { 
            setTimeout(function() {
                loader.classList.remove('loader-animation');
                console.log(response);
                
                if(payment_method == 'stripe') {
                    window.location.href = './stripe-integration/create-checkout-session.php';
                } else if(payment_method == 'paypal') {
                    return '1';
                }
            }, 1000);
        });
    } else {
        $('#check').prop('checked', false);
        // Email
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#emailError').html('');
            $('#email').removeClass('invalid');
        } else {
            if(email) {
                $('#emailError').html('<div>Please enter a valid email address</div>');
                $('#email').addClass('invalid');
            } else {
                $('#emailError').html('<div>Email cannot be blank</div>');
                $('#email').addClass('invalid');
            }
        }
        // Country
        if(country) {
            $('#countryError').html('');
            $('#country').removeClass('invalid');
        } else {
            $('#countryError').html('<div>Country cannot be blank</div>');
            $('#country').addClass('invalid');
        }
        // Firstname
        if(fname) {
            $('#fnameError').html('');
            $('#fname').removeClass('invalid');
        } else {
            $('#fnameError').html('<div>Firstname cannot be blank</div>');
            $('#fname').addClass('invalid');
        }
        // Lastname
        if(lname) {
            $('#lnameError').html('');
            $('#lname').removeClass('invalid');
        } else {
            $('#lnameError').html('<div>Lastname cannot be blank</div>');
            $('#lname').addClass('invalid');
        }
        // Address
        if(address) {
            $('#addressError').html('');
            $('#address').removeClass('invalid');
        } else {
            $('#addressError').html('<div>Address cannot be blank</div>');
            $('#address').addClass('invalid');
        }
        // Town/City
        if(towncity) {
            $('#towncityError').html('');
            $('#towncity').removeClass('invalid');
        } else {
            $('#towncityError').html('<div>Town/City cannot be blank</div>');
            $('#towncity').addClass('invalid');
        }
        // State/Province
        if(province) {
            $('#provinceError').html('');
            $('#province').removeClass('invalid');
        } else {
            $('#provinceError').html('<div>Province cannot be blank</div>');
            $('#province').addClass('invalid');
        }
        // Zip/Postal Code
        if(zippostalcode) {
            $('#zipcodeError').html('');
            $('#zipcode').removeClass('invalid');
        } else {
            $('#zipcodeError').html('<div>Zip/Postal Code cannot be blank</div>');
            $('#zipcode').addClass('invalid');
        }
        // Phone
        if(phone) {
            $('#phoneError').html('');
            $('#phone').removeClass('invalid');
        } else {
            $('#phoneError').html('<div>Phone cannot be blank</div>');
            $('#phone').addClass('invalid');
        }
        // Payment method
        if(payment_method) {
            $('#payError').html('');
            $('#payment_method').removeClass('invalid');
        } else {
            $('#payError').html('<div>Please select a payment method</div>');
            $('#payment_method').addClass('invalid');
        }
        // TOS
        if(tos) {
            $('#tosError').html('');
            $('#tos').removeClass('invalid');
        } else {
            $('#tosError').html('<div>Agree to the terms and conditions</div>');
            $('#tos').addClass('invalid');
        }
        // // Address 2
        // if(addres2) {
        //     $('#addres2Error').html('');
        //     $('#addres2').removeClass('invalid');
        // } else {
        //     $('#addres2Error').html('<div>Lastname cannot be blank</div>');
        //     $('#addres2').addClass('invalid');
        // }
    }

}

function getQtyValues() {
    var cartArray = [];
  
    $(".qty-text").each(function() {
      var id = $(this).attr("id");
      var value = $(this).val();
  
      var idParts = id.split("-");
      var productId = idParts[1];
      var size = idParts[2];
      var color = idParts[3];
  
      var variantArray = {
        "product_id": productId,
        "size": size,
        "color": color,
        "qty": value
      };
  
      cartArray.push(variantArray);
    });
  
    return cartArray;
}
  
function update_cart() {
    var qtyArray = getQtyValues();
    var qtyString = JSON.stringify(qtyArray);
    
	var formData = new FormData();
    formData.append('update_cart', 'true');
    formData.append('qtyString', qtyString);
    
    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');

    console.log(qtyArray);

    fetch('./controllers/product-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            // error processing
            throw new Error("HTTP status " + response.status);
        }
        return response.text(); 
    })
    .then(response => { 
        setTimeout(function() {
            console.log(response);
            loader.classList.remove('loader-animation');
            return;
        }, 1000);
        // window.location.href = 'cart';
    });
}
function clear_cart(event) {
    event.preventDefault();

	var formData = new FormData();
    formData.append('clear_cart', 'true');
    
    fetch('./controllers/product-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            // error processing
            throw new Error("HTTP status " + response.status);
        }
        return response.text(); 
    })
    .then(response => { 
        if(response == '1') {
            window.location.href = 'cart';
        } 
    });
}
function remove_from_cart(event, id, size, color) {
    event.preventDefault();

	var formData = new FormData();
    formData.append('remove_from_cart', 'true');
    formData.append('id', id);
    formData.append('size', size);
    formData.append('color', color);

    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');

    fetch('./controllers/product-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            // error processing
            throw new Error("HTTP status " + response.status);
        }
        return response.text();
    })
    .then(response => {
        setTimeout(function() {
            console.log('remove from cart');
            loader.classList.remove('loader-animation');
            if (typeof isMyScript !== 'undefined') {
                window.location.href = 'cart';
            } else {
                $('#cart-btn').html(response);   
                $('#cart-dropdown').addClass('cart-data-open');
            }
        }, 1000);
    });
	
}

function add_to_cart(event, product_id) {
	event.preventDefault();

    var formData = new FormData();

    var qty = document.querySelector('#pdt-qty').value;

    let size = $('.size-option.selected[data-key]').data('value');

    console.log(product_id, size, qty);

    if(product_id && size && qty) {
        load_start();

        formData.append('add_to_cart', 'true');
        formData.append('id', product_id);
        formData.append('size', size);
        formData.append('qty', qty);
    
        fetch('./controllers/cart-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                // error processing
                throw new Error("HTTP status " + response.status);
            }
            return response.text(); 
        })
        .then(response => { 
            setTimeout(function() {
                // console.log('add to cart');
                console.log('product.js', response);
                load_end();
                if(!$('#cart-dropdown').hasClass('cart-data-open')) {
                    $('#header-cart-btn').html(response);   
                    $('#cart-dropdown').addClass('cart-data-open');
                    setTimeout(function() {
                        $('#cart-dropdown').removeClass('cart-data-open');
                    }, 5000);
                } else {
                    $('#header-cart-btn').html(response);
                }
            }, 1000);
        });
    } else {
        // Size error
        if (size) {
            $('#size-error').html('');
            $('#size-wrapper').removeClass('invalid');
        } else {
            $('#size-error').html('<div>Select a size to continue</div>');
            $('#size-wrapper').addClass('invalid');
        }
    }

	
}


function buy_now(event, product_id) {
	event.preventDefault();

    var formData = new FormData();

    var qty = document.querySelector('#pdt-qty').value;

    let size = $('.size-option.selected[data-key]').data('value');

    console.log(product_id, size, qty);

    if(product_id && size && qty) {
        load_start();

        formData.append('add_to_cart', 'true');
        formData.append('id', product_id);
        formData.append('size', size);
        formData.append('qty', qty);
    
        fetch('./controllers/cart-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                // error processing
                throw new Error("HTTP status " + response.status);
            }
            return response.text(); 
        })
        .then(response => { 
            setTimeout(function() {
                // console.log('add to cart');
                console.log('product.js', response);
                load_end();
                if(!$('#cart-dropdown').hasClass('cart-data-open')) {
                    $('#header-cart-btn').html(response);   
                    $('#cart-dropdown').addClass('cart-data-open');
                    setTimeout(function() {
                        $('#cart-dropdown').removeClass('cart-data-open');
                    }, 5000);
                } else {
                    $('#header-cart-btn').html(response);
                }

                window.location.href = './checkout';
            }, 1000);
        });
    } else {
        // Size error
        if (size) {
            $('#size-error').html('');
            $('#size-wrapper').removeClass('invalid');
        } else {
            $('#size-error').html('<div>Select a size to continue</div>');
            $('#size-wrapper').addClass('invalid');
        }
    }

	
}
function cart_dropdown() {
    // var cartList = document.querySelector('.cart-list');
    // if (cartList.children.length > 0) {
        $('#cart-dropdown').toggleClass('cart-data-open');
    // }
}








function increase_cart_qty(product_id, type) {
    update_cart_qty(product_id, 1, type);
}

function decrease_cart_qty(product_id, type) {
    update_cart_qty(product_id, -1, type);
}

function update_cart_qty(product_id, qty_change, type) {
    var formData = new FormData();

    if (product_id && qty_change) {
        // load_start();

        formData.append('update_cart_qty', 'true');
        formData.append('type', type);
        formData.append('id', product_id);
        formData.append('qty_change', qty_change);

        fetch('./controllers/cart-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP status " + response.status);
            }
            return response.text();
        })
        .then(response => {
            setTimeout(function() {
                console.log('update cart', response);
                // load_end();

                if(type == 'cart-btn') {
                    $('#header-cart-btn').html(response);

                    if (!$('#cart-dropdown').hasClass('cart-data-open')) {
                        $('#cart-dropdown').addClass('cart-data-open');
                    }
                    let page = get_page();
                    if(page == 'checkout') {
                        $('#checkout-items').load(window.location.href + " #checkout-items");
                    }
                } else if(type == 'checkout') {
                    $('#checkout-items').html(response);
                    $("#header-cart-btn").load(window.location.href + " #header-cart-btn");
                }


            }, 200);
        });
    }
}







// Click event outside of cart button and dropdown
$(document).on('click', function(event) {
    const $cartBtn = $('#cart-btn');
    const $cartDropdown = $('#cart-dropdown');
    if (!$cartBtn.is(event.target) && !$cartBtn.has(event.target).length &&
    !$cartDropdown.is(event.target) && !$cartDropdown.has(event.target).length) {
        $cartDropdown.removeClass('cart-data-open');
    }
});

