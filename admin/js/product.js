function create_product(event) {
    event.preventDefault();
    var formData = new FormData();

    const title = $('#title-field').val();
    const description = $('#description-field').val();
    const price = $('#price-field').val();
    const stock = $('#stock-field').val();

    // Create an array to hold the selected sizes
    let sizes = [];

    // Loop through all size options with the class 'selected' and having the attribute 'data-key'
    $('.size-option.selected[data-key]').each(function() {
        // Get the value of the data attribute 'value'
        let sizeValue = $(this).data('value');
        
        // Add the value to the sizes array
        sizes.push(sizeValue);
    });

    // Convert the sizes array to a JSON string
    let sizesJsonString = JSON.stringify(sizes);

    console.log(sizesJsonString);

    console.log(title, description, price, stock, sizesJsonString);

    let page = get_page();

    if(page == 'products') {
        page = page;
    } else if (page == 'index') {
        page = '';
    }
    let return_url = '../admin/' + page;

    if (title && description && price && stock && sizes.length > 0) {
        
        load_start();
        
        $('#title-error').html('');
        $('#description-error').html('');
        $('#price-error').html('');
        $('#stock-error').html('');
        $('#size-error').html('');

        formData.append('create_product', 'true');
        formData.append('title', title);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('stock', stock);
        formData.append('size', sizesJsonString);
    
        fetch('../controllers/product-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(response => {
            // Response
            console.log(response);

            // Page
            var page = get_page();
            
            setTimeout(function() {
                load_end();
                closePopup();

                if($.trim(response.status) == '1') {
                    $('#message-response-1').html("<div class='success'>Product created!</div>");

                    setTimeout(function() {

                        const productArray = response.product_array;
    
                        // Extract the required data
                        const imgSm = productArray.images[0].image_filename_sm;
                        const sizes = JSON.parse(productArray.size);
                        const sizesStr = sizes.join(', ');
                    
                        let html = `<div class='c-row' id='product-id-${productArray.id}'>
                            <div class='item'>
                                <div class='thumbnail'>
                                    <img src='./uploads/${imgSm}' alt=''>
                                </div>
                                <span>${productArray.title}</span>
                            </div>
                            <div class='item'>$${productArray.sale_price}</div>`;
                    
                        if (page == 'products') {
                            html += `<div class='item' style='text-transform: uppercase;'>${sizesStr}</div>`;
                        } else if (page == '' || page == 'index') {
                            html += `<div class='item'>50</div>
                            <div class='item'>$6.492.44</div>`;
                        }
                    
                        html += `<div class='item' onclick='get_popup_content_product("${productArray.id}")'>
                                <img src='./assets/edit.svg' alt=''>
                            </div>
                        </div>`;
                    
                        // Append the generated HTML to the last .c-row element
                        document.querySelector('.c-row:last-of-type').insertAdjacentHTML('afterend', html);

                        // Scroll to the newly added element smoothly
                        const newElement = document.getElementById(`product-id-${productArray.id}`);
                        newElement.scrollIntoView({ behavior: 'smooth' });

                        // window.location.href = return_url;
                    }, 500);
                } else {
                    $('#message-response-1').html("<div class='error'>An error occurred!</div>");
                }
            }, 500);
        })
        .catch(err => console.log(err));
    } else {
        // Title
        if (title) {
            $('#title-error').html('');
            $('#name-wrapper').removeClass('invalid');
        } else {
            $('#title-error').html('<div>Field cannot be blank</div>');
            $('#name-wrapper').addClass('invalid');
        }
        // Description
        if (description) {
            $('#description-error').html('');
            $('#description-wrapper').removeClass('invalid');
        } else {
            $('#description-error').html('<div>Field cannot be blank</div>');
            $('#description-wrapper').addClass('invalid');
        }
        // Price
        if (price) {
            $('#price-error').html('');
            $('#price-wrapper').removeClass('invalid');
        } else {
            $('#price-error').html('<div>Field cannot be blank</div>');
            $('#price-wrapper').addClass('invalid');
        }
        // Stock
        if (stock) {
            $('#stock-error').html('');
            $('#stock-wrapper').removeClass('invalid');
        } else {
            $('#stock-error').html('<div>Field cannot be blank</div>');
            $('#stock-wrapper').addClass('invalid');
        }
        // Size
        if (sizes.length > 0) {
            $('#size-error').html('');
            $('#size-wrapper').removeClass('invalid');
        } else {
            $('#size-error').html('<div>Field cannot be blank</div>');
            $('#size-wrapper').addClass('invalid');
        }
    }
}

function update_product(event) {
    event.preventDefault();
    var formData = new FormData();

    const product_id = $('#product_id').val();
    const title = $('#title-field').val();
    const description = $('#description-field').val();
    const price = $('#price-field').val();
    const stock = $('#stock-field').val();

    // Create an array to hold the selected sizes
    let sizes = [];

    // Loop through all size options with the class 'selected' and having the attribute 'data-key'
    $('.size-option.selected[data-key]').each(function() {
        // Get the value of the data attribute 'value'
        let sizeValue = $(this).data('value');
        
        // Add the value to the sizes array
        sizes.push(sizeValue);
    });

    // Convert the sizes array to a JSON string
    let sizesJsonString = JSON.stringify(sizes);

    console.log(sizesJsonString);

    console.log(title, description, price, stock, sizesJsonString);


    let page = get_page();

    if(page == 'products') {
        page = page;
    } else if (page == 'index') {
        page = '';
    }
    let return_url = '../admin/' + page;


    if (title && description && price && stock && sizes.length > 0) {
        
        load_start();
        
        $('#title-error').html('');
        $('#description-error').html('');
        $('#price-error').html('');
        $('#stock-error').html('');
        $('#size-error').html('');

        formData.append('update_product', 'true');
        formData.append('product_id', product_id);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('stock', stock);
        formData.append('size', sizesJsonString);
    
        fetch('../controllers/product-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            setTimeout(function() {
                loader.classList.remove('loader-animation');
                if($.trim(response) == '1') {
                    $('#message-response-1').html("<div class='success'>Product updated!</div>");
                    
                    setTimeout(function() {
                        closePopup();
                        window.location.href = return_url;
                    }, 500);
                } else {
                    $('#message-response-1').html("<div class='error'>An error occurred!</div>");
                }
            }, 500);
        })
        .catch(err => console.log(err));
    } else {
        // Title
        if (title) {
            $('#title-error').html('');
            $('#name-wrapper').removeClass('invalid');
        } else {
            $('#title-error').html('<div>Field cannot be blank</div>');
            $('#name-wrapper').addClass('invalid');
        }
        // Description
        if (description) {
            $('#description-error').html('');
            $('#description-wrapper').removeClass('invalid');
        } else {
            $('#description-error').html('<div>Field cannot be blank</div>');
            $('#description-wrapper').addClass('invalid');
        }
        // Price
        if (price) {
            $('#price-error').html('');
            $('#price-wrapper').removeClass('invalid');
        } else {
            $('#price-error').html('<div>Field cannot be blank</div>');
            $('#price-wrapper').addClass('invalid');
        }
        // Stock
        if (stock) {
            $('#stock-error').html('');
            $('#stock-wrapper').removeClass('invalid');
        } else {
            $('#stock-error').html('<div>Field cannot be blank</div>');
            $('#stock-wrapper').addClass('invalid');
        }
        // Size
        if (sizes.length > 0) {
            $('#size-error').html('');
            $('#size-wrapper').removeClass('invalid');
        } else {
            $('#size-error').html('<div>Field cannot be blank</div>');
            $('#size-wrapper').addClass('invalid');
        }
    }
}



// Sizes
function select_size(className) {
    if(!$('.'+className).hasClass('selected')) {
        $('.'+className).addClass('selected');
    } else {
        $('.'+className).removeClass('selected');
    }
}





function get_popup_content_product(id) {
    // console.log(id);

    fetch('./confirm-delete-popup-product.php?type=product&id='+id)
    .then(response => response.text())
    .then(response => {
        // console.log(response);
        // setTimeout(function() {
            // Insert Content
            $('#deletePopup').html(response);
            // Show Pop Up
            popup('deletePopup');
        // }, 500);
    })
    .catch( err => console.log(err));
}
function confirm_delete_product() {
    var formData = new FormData();

    const del_id = $('#del_id').val();

    formData.append('del', 'true');
    formData.append('del_id', del_id);

    const url = '../controllers/product-handler.php';
    

    let page = get_page();

    if(page == 'products') {
        page = page;
    } else if (page == 'index') {
        page = '';
    }
    let return_url = '../admin/' + page;

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        // console.log(response);
        if(response == '1') {
            $('#message-response-1').html("<div class='success'>The Item was Deleted!</div>");
            setTimeout(function() {
                window.location.href = return_url;
            }, 500);
        } else {
            $('#message-response-1').html("<div class='error'>There was an error</div>");
        }
    })
    .catch( err => console.log(err));
}