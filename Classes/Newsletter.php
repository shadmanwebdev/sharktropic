
<?php
/*
=================================================================

    CRUD

=================================================================  
*/

namespace MyApp\Classes;

class Newsletter extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    
    public function add_to_mailing_list() {
        $email = $_POST['email'];
        $notification = ($_POST['notification'] == '2') ? 'Yes' : 'No';

        var_dump($email, $notification);

        // Add email to mailchimp audience
        // $mStatus = add_to_audience($_POST['email'], $tags = ['free']);
    }
}


