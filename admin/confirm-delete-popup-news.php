<?php
    $type = $_GET['type'];
    $id = $_GET['id'];
?>


<div class='delete-popup'>   
    <input type="hidden" name='type' id='type' value='<?= $type; ?>'>
    <input type="hidden" name='del_id' id='del_id' value='<?= $id; ?>'>
    <div id='cross' onclick='closePopup()'>
        <img src="assets/cross.svg" alt="">
    </div>
    <div>
        <div id="popup-heading">
            Edit the Drop or Delete
        </div>
        <div id='btnLockedOuterWrapper'>
            <span class='del-popup-btn' id="edit-btn" onclick='get_popup_content_edit_news(<?= $id; ?>)'>
                <img src="assets/edit-2.svg" alt="">
                <span class='text'>Edit</span>
            </span>
            <span class='del-popup-btn' id="delete-btn" onclick='confirm_delete_news(<?= $id; ?>)'>
                <img src="assets/trash.svg" alt="">
                <span class='text'>Delete</span>
            </span>
        </div>

        <div class='message-response' id='message-response-1'></div>
    </div>
</div>