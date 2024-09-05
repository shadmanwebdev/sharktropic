<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    if(isset($_SESSION['uploads'])) {
        unset($_SESSION['uploads']);
    }
    $type = $_GET['type'];
    $id = $_GET['id'];
        
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Product.php';
?>






<!-- Upload Section -->
<style>
    .upload-area {
        width: 100%;
        height: 200px;
    }
</style>





<?php
    
    $p = new MyApp\Classes\Product();
    $p->edit_product_form($id);
    
?>



<script defer>
    $(document).ready(function(){
        $(".scrollable-div-y").mCustomScrollbar({
            axis: "y", // Enable vertical scrolling
            theme: "minimal"
        });
    });
</script>


<script defer>        
    const uploadedImages = document.getElementById('uploadedImages');
    const uploadArea = document.getElementById('uploadfile');
    const fileInput = document.getElementById('fileInput');
    const fileElem = document.getElementById('fileElem');

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
    function delete_old_image(el, product_id, imageUrl) {
        const uploadedImages = document.getElementById('uploadedImages');
        console.log(el, imageUrl);
        fetch('edit-product-delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({product_id: product_id, url: imageUrl })
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


