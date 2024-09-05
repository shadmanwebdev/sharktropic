
function reply(event) {
    event.preventDefault();

    const email = $('#email').val();
    const reply = $('#reply').val();

    // console.log(email, reply);

    if(email && reply) {
        $('#replyError').html('');
        var formData = new FormData();

        formData.append('send_reply', 'true');
        formData.append('email', email);
        formData.append('reply', reply);

        fetch('../controllers/contact-message-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();   
        })
        .then(response => {
            // console.log(response);
            if($.trim(response) == '1') {
                $('#message-response').html("<div class='success'>Reply sent!</div>");
            } else {
                $('#message-response').html("<div class='error'>There was an error</div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        if(reply) {
            $('#replyError').html('');
        } else {
            $('#replyError').html('<div>Field cannot be blank</div>');
        }
    }
}


function update_contact_details(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_contact_details = $('#update_contact_details').val();
    const address = $('#address').val();
    const phone = $('#phone').val();
    const email = $('#email').val();
    const website = $('#website').val();

    if(update_contact_details) {
        load_start();
        
        formData.append('update_contact_details', update_contact_details);
        formData.append('address', address);
        formData.append('phone', phone);
        formData.append('email', email);
        formData.append('website', website);

        // // console.log(update_hero_slide, hero_slide_id, title, subtitle, link, image);

        fetch('../controllers/contact-message-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();   
        })
        .then(response => {
            // console.log(response);
            setTimeout(function() {
                load_end();
                if($.trim(response) == '1') {
                    $('#message-response-1').html("<div class='success'>Contact details updated!</div>");
                } else {
                    $('#message-response-1').html("<div class='error'>There was an error</div>");
                }
            }, 500);
        })
        .catch( err => console.log(err));
    } else {
        $('#message-response-1').html("<div class='error'>There was an error</div>");
    }

}