<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    if(isset($_SESSION['uploads'])) {
        unset($_SESSION['uploads']);
    }
    $type = $_GET['type'];
?>






<!-- Upload Section -->
<style>
    .upload-area {
        width: 100%;
        height: 200px;
    }
</style>


<div class='add-product-popup'>   
    <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
    <div id='cross' onclick='closePopup()'>
        <img src="assets/cross.svg" alt="">
    </div>
    <div>
        <div id="popup-heading">
            Drop Products
        </div>
        <!-- Checkout form -->
        <form action="" class='popup-form scrollable-div-y' id='popup-form'>
            <!-- <div class="form-header">
                <h2>Drop Products</h2>
            </div> -->
            
            <div class="row" id='row-1'>
                <div class="coluumn" id='column-1'>


                    <div class="upload-area" id="uploadfile">
                        <div class="upload-area-inner">
                            <div class='upload-icon'>
                                <img src="assets/upload.svg" alt="">
                            </div>
                            
                            <div class='select-text'>
                                Drag and Drop file here or 
                                <span id="fileElem">Choose File</span>
                            </div>
                        </div>
                    </div>

                    <div class="uploaded-images" id="uploadedImages"></div>

                    <input type="file" id="fileInput" style="display: none;">



                    <!-- Sizes -->
                    <style>
                        .sizes-label {
                            margin-bottom: 15px;
                            font-size: 15px;
                        }
                        .size-options {
                            display: flex;
                            flex-flow: row nowrap;
                            width: 100%;
                        }

                        .size-option {
                            width: 50px;
                            height: 40px;
                            color: #fff;
                            background: #FFFFFF1A;

                            font-size: 16px;
                            border-radius: 10px;
                            margin-right: 10px;
                            
                            cursor: pointer;
                            text-align: center;
                            display: flex;
                            flex-flow: row nowrap;
                            align-items: center;
                            justify-content: center;
                        }
                        .size-option.selected {
                            background: #FEFA6A;
                            color: #111111;
                        }
                    </style>

                    <div class='sizes size-wrapper'>
                        <div class='sizes-label'>Sizes</div>
                        <div class='size-options'>
                            <span class='size-option s' data-key='s' data-value='s' onclick="select_size('s')">S</span>
                            <span class='size-option m' data-key='m' data-value='m' onclick="select_size('m')">M</span>
                            <span class='size-option l' data-key='l' data-value='l' onclick="select_size('l')">L</span>
                            <span class='size-option xl' data-key='xl' data-value='xl' onclick="select_size('xl')">XL</span>
                            <span class='size-option xxl' data-key='xxl' data-value='xxl' onclick="select_size('xxl')">XXL</span>
                        </div>
                        <div id='size-error' class="error-text"></div>
                    </div>

                </div>
                <div class="coluumn" id='column-2'>
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
                    <div class="input-row">
                        <div class="input-wrapper" id='price-wrapper'>
                            <label for="price">Price</label>
                            <input name="price" id="price-field" type="text" class="input-field" placeholder='Type here'>
                            <div id='price-error' class="error-text"></div>
                        </div>
                        <div class="input-wrapper" id='stock-wrapper'>
                            <label for="stock">In Stock</label>
                            <input name="stock" id="stock-field" type="number" class="input-field" placeholder='Type here'>
                            <div id='stock-error' class="error-text"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id='row-2'>
           
                <span class='btns'>
                    <span class='btn admin-btn-2' onclick='closePopup()'>
                        Cancel
                    </span>
                    <span class='btn admin-btn-1' onclick='create_product(event)'>
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
</script>