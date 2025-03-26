<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    if(isset($_SESSION['uploads'])) {
        unset($_SESSION['uploads']);
    }
    
    $type = $_GET['type'];
    $donation_id = $_GET['donation_id'];
    
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Donations.php';
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
                Edit Donation
            </div>
            
            
            <?php
                $donations = new MyApp\Classes\Donations;
                $donations->edit_donation_form($donation_id);
            ?>
    
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
    const uploadArea = document.getElementById('uploadfile');
    const fileInput = document.getElementById('fileInput');
    const fileElem = document.getElementById('fileElem');
    const uploadedImages = document.getElementById('uploadedImages');

    fileElem.addEventListener('click', () => {
        fileInput.click();
    });

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#3F8BB7';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '#ccc';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#ccc';
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    function handleFiles(files) {
        const formData = new FormData();
        for (const file of files) {
            formData.append('file[]', file);
        }

        fetch('upload.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(result => {
            displayImages(result);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function displayImages(images) {

        images.forEach(image => {
            const imgContainer = document.createElement('div');
            imgContainer.classList.add('img-container');

            const img = document.createElement('img');
            img.src = image.url;
            imgContainer.appendChild(img);

            const removeIcon = document.createElement('span');
            removeIcon.classList.add('remove-icon');
            removeIcon.innerHTML = '&times;';
            removeIcon.addEventListener('click', () => {

                // console.log(uploadedImages, imgContainer);
                uploadedImages.removeChild(imgContainer);
                removeImageFromServer(image.url);
            });
            imgContainer.appendChild(removeIcon);

            uploadedImages.appendChild(imgContainer);
        });
    }

    function removeImageFromServer(imageUrl) {
        fetch('delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ url: imageUrl })
        }).then(response => response.json())
        .then(result => {
            if (result.success) {
                console.log('Image successfully deleted');
            } else {
                console.error('Error deleting image:', result.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    function delete_old_donation_image(el, donation_id, imageUrl) {
        const uploadedImages = document.getElementById('uploadedImages');
        console.log(el, imageUrl);
        fetch('edit-donation-delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({donation_id: donation_id, url: imageUrl })
        }).then(response => response.json())
        .then(result => {
            if (result.success) {
                console.log('Image successfully deleted');

                
                var imgContainer = el.closest('.img-container');
                uploadedImages.removeChild(imgContainer);

            } else {
                console.error('Error deleting image:', result.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

<script>
    function update_donation(event) {
        event.preventDefault();
        var formData = new FormData();

        const donation_id = $('#donation_id').val();
        const title = $('#title-field').val();
        const amount = $('#amount-field').val();
        const description = $('#description-field').val();

        let page = get_page();

        if (page == 'donations') {
            page = page;
        } else if (page == 'index') {
            page = '';
        }
        let return_url = '../admin/' + page;

        console.log(donation_id, title, amount, description);

        // Validate required fields
        if (title && amount) {
            
            load_start();

            // Clear error messages
            $('#title-error, #amount-error, #description-error').html('');

            formData.append('update_donation', 'true');
            formData.append('donation_id', donation_id);
            formData.append('title', title);
            formData.append('amount', amount);
            formData.append('description', description);

            fetch('../controllers/donation-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(response => {
                setTimeout(function() {

                    // Response
                    console.log(response);

                    setTimeout(function() {
                        load_end();
                        closePopup();

                        // Response
                        console.log(response);

                        var page = get_page();

                        // Check status
                        if($.trim(response.status) == '1') {
                            $('#message-response-1').html("<div class='success'>Donation updated!</div>");

                            const donationsDiv = $('.content .rows');
                            
                            if (donationsDiv.length) {
                                // Update the donation item in the UI
                                // For example, replace the existing HTML of the donation row
                                donationsDiv.find(`#donation-${donation_id}`).replaceWith(response.html);
                            }

                        } else {
                            $('#message-response-1').html("<div class='error'>An error occurred while updating this donation!</div>");
                        }

                    }, 500);

                }, 500);
            })
            .catch(err => console.log(err));
        } else {
            // Validation
            if (!title) {
                $('#title-error').html('<div>Field cannot be blank</div>');
            }
            if (!amount) {
                $('#amount-error').html('<div>Field cannot be blank</div>');
            }
        }
    }

</script>