<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    if(isset($_SESSION['uploads'])) {
        unset($_SESSION['uploads']);
    }
    $type = $_GET['type'];
    $subscriber_id = $_GET['subscriber_id'];
?>



<!-- Form Upload Section -->
<style>
    .upload-area {
        width: 100%;
        height: 200px;
    }
</style>



<div id='bookingPopupInner' class='add-news-popup' style='overflow: hidden;'>   
    <div>
        <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
        <div id='cross' onclick='closePopup()'>
            <img src="assets/cross.svg" alt="">
        </div>
        <div>
            <div id="popup-heading">
                Write your message
            </div>
            <!-- Checkout form -->
            <form action="" class='popup-form scrollable-div-y' id='popup-form'>
                <!-- <div class="form-header">
                    <h2>Drop Products</h2>
                </div> -->
                <input name="subscriber_id" id="subscriber_id" type="hidden" value='<?= $subscriber_id; ?>'>
                <div class="row" id='row-1'>
                    <div class="coluumn" id='column-1'>
                        <div class="input-wrapper" id='name-wrapper'>
                            <label for="title">Title<span class='required'>*</span></label>
                            <input name="name" id="title-field" type="name" class="input-field" placeholder='Type here'>
                            <div id='title-error' class="error-text"></div>
                        </div>
                        <div class="input-wrapper" id='description-wrapper'>
                            <label for="description">Description</label>
                            <textarea name="description" rows='5' id="description-field" type="name" class="textarea-field" placeholder='Type here'></textarea>
                            <div id='description-error' class="error-text"></div>
                        </div>
                    </div>
                </div>
                <div class="row" id='row-2'>
               
                    <span class='btns'>
                        <span class='btn admin-btn-2' onclick='closePopup()'>
                            Cancel
                        </span>
                        <span class='btn admin-btn-1' onclick='create_subscriber_message(event)'>
                            Save
                        </span>
                    </span>
            
                </div>
                <div class="row" id='row-3'>
               
                    <!-- Response -->
                    <div class='message-response' id='message-response-1'></div>
            
                </div>
        
            </form>
    
        </div>
    </div>
</div>


<script defer>
    $(document).ready(function(){
        $(".scrollable-div-y").mCustomScrollbar({
            axis: "y", // Enable vertical scrolling
            theme: "minimal"
        });
    });
</script>

<script defer>
    
    function create_subscriber_message(event) {
        event.preventDefault();
        var formData = new FormData();

        const type = $('#type').val();
        const subscriber_id = $('#subscriber_id').val();
        const title = $('#title-field').val();
        const description = $('#description-field').val();

        let page = get_page();

        if(page == 'subscribers') {
            page = page;
        } else if (page == 'index') {
            page = '';
        }
        let return_url = '../admin/' + page;

        console.log(title, description);

        if (title && description) {
            
            load_start();
            
            $('#title-error').html('');
            $('#description-error').html('');

            formData.append('create_subscriber_message', 'true');
            formData.append('type', type);
            formData.append('subscriber_id', subscriber_id);
            formData.append('title', title);
            formData.append('content', description);
        
            fetch('../controllers/mailing-list-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(response => {
                setTimeout(function() {
                    load_end();
                    closePopup();

                    // Response
                    // console.log(response);

                    // Page
                    var page = get_page();

                    // Check status
                    if($.trim(response.status) == '1') {
                        $('#message-response-1').html("<div class='success'>Message sent!</div>");
                        if($.trim(response.subscriber_id) != 'false') {
                            const subscriberDiv = $('#subscriber-' + response.subscriber_id);
                            if (subscriberDiv.length) {
                                subscriberDiv.replaceWith(response.html);
                            }
                        } else {
                            console.log(response.html);
                            $('.rows').html(response.html);
                        }

                    } else {
                        $('#message-response-1').html("<div class='error'>An error occurred while submitting this form!</div>");
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
        }
    }
</script>