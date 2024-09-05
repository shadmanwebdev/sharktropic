<?php
    
    include '../functions.php';
    include '../Classes/Db.php';
    // include '../Classes/User.php';
    include '../Classes/ContactMessage.php';

    $ms = new MyApp\Classes\ContactMessage();
    
    if(isset($_POST['send_message'])) {
        $ms->create();
    }
    if(isset($_POST['send_reply'])) {
        $ms->reply();
    }
    if(isset($_POST['update_contact_details'])) {
        $ms->update_contact_details();
    }
    if(isset($_POST['update_contact_page'])) {
        $ms->update_contact_page();
    }

?>