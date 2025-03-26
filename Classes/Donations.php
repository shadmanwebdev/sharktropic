<?php

namespace MyApp\Classes;

class Donations extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    private function get_donation($donation_id) {
        $sql = "SELECT 
            donations.id AS donation_id,
            donations.title AS donation_title,
            donations.amount AS donation_amount,
            donations.description AS donation_description,
            donations.created_at AS created_at,
            donations.updated_at AS updated_at,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg
        FROM 
            donations
        LEFT JOIN 
            donation_images i ON donations.id = i.donation_id
        WHERE 
            donations.id = ?";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        
        $stmt->bind_param('i', $donation_id);
        $stmt->execute();
        $result = $stmt->get_result();

    
        $data = array();

        $image_ids = array();

        while ($row = $result->fetch_assoc()) {
            // Donation Id
            $donation_id = $row['donation_id'];
            
            if (!isset($data[$donation_id])) {
                $data[$donation_id] = array(
                    'id' => $row['donation_id'],
                    'title' => $row['donation_title'],
                    'amount' => $row['donation_amount'],
                    'description' => $row['donation_description'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                    'images' => array()
                );
            }

            // Store images associated with the donation
            if($row['image_id']) {
                if(!in_array($row['image_id'], $image_ids)) {
                    $data[$donation_id]['images'][] = array(
                        'id' => $row['image_id'],
                        'image_filename_sm' => $row['image_filename_sm'],
                        'image_filename_md' => $row['image_filename_md'],
                        'image_filename_lg' => $row['image_filename_lg']
                    );
                }
                array_push($image_ids, $row['image_id']);
            }
        
        }
    
        $stmt->close();
        
        return $data[$donation_id];
    }
    private function get_donations() {
        $donations = array();
        $image_ids = array();
        
        $sql = "SELECT 
                    donations.id AS donation_id,
                    donations.title AS donation_title,
                    donations.amount AS donation_amount,
                    donations.description AS donation_description,
                    donations.created_at AS created_at,
                    donations.updated_at AS updated_at,
                    i.id AS image_id,
                    i.image_filename_sm,
                    i.image_filename_md,
                    i.image_filename_lg
                FROM 
                    donations
                LEFT JOIN 
                    donation_images i ON donations.id = i.donation_id
                ORDER BY donation_id DESC";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $donation_id = $row['donation_id'];
            
            if (!isset($donations[$donation_id])) {
                $donations[$donation_id] = array(
                    'id' => $row['donation_id'],
                    'title' => $row['donation_title'],
                    'amount' => $row['donation_amount'],
                    'description' => $row['donation_description'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                    'images' => array()
                );
            }
            
            if ($row['image_id'] && !in_array($row['image_id'], $image_ids)) {
                $donations[$donation_id]['images'][] = array(
                    'id' => $row['image_id'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg']
                );
                $image_ids[] = $row['image_id'];
            }
        }
        
        $stmt->close();
        return array_values($donations); // Reindex array before returning
    }
    private function get_donations_current_year() {
        $donations = array();
        $image_ids = array();
        $total_amount = 0;
        
        $current_year = date("Y");
        
        $sql = "SELECT 
                    donations.id AS donation_id,
                    donations.title AS donation_title,
                    donations.amount AS donation_amount,
                    donations.description AS donation_description,
                    donations.created_at AS created_at,
                    donations.updated_at AS updated_at,
                    i.id AS image_id,
                    i.image_filename_sm,
                    i.image_filename_md,
                    i.image_filename_lg
                FROM 
                    donations
                LEFT JOIN 
                    donation_images i ON donations.id = i.donation_id
                WHERE YEAR(donations.created_at) = ?
                ORDER BY donation_id DESC";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        
        $stmt->bind_param("i", $current_year);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $donation_id = $row['donation_id'];
                
                if (!isset($donations[$donation_id])) {
                    $donations[$donation_id] = array(
                        'id' => $row['donation_id'],
                        'title' => $row['donation_title'],
                        'amount' => $row['donation_amount'],
                        'description' => $row['donation_description'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'images' => array()
                    );
                    $total_amount += floatval($row['donation_amount']);
                }
                
                if ($row['image_id'] && !in_array($row['image_id'], $image_ids)) {
                    $donations[$donation_id]['images'][] = array(
                        'id' => $row['image_id'],
                        'image_filename_sm' => $row['image_filename_sm'],
                        'image_filename_md' => $row['image_filename_md'],
                        'image_filename_lg' => $row['image_filename_lg']
                    );
                    $image_ids[] = $row['image_id'];
                }
            }
        }
        
        $stmt->close();
        return [
            'donations' => array_values($donations), // Reindex array before returning
            'total_amount' => $total_amount
        ];
    }
    public function create_donation() {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $created_at = datetime_now();
    
        $stmt = $this->con->prepare('INSERT INTO donations (title, description, amount, created_at) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $title, $description, $amount, $created_at);
    
        if ($stmt->execute()) {   
            $status = '1';
    
            $donation_id = $stmt->insert_id;
    
            // Insert Images
            if(isset($_SESSION['uploads'])) {
                $uploads = json_decode($_SESSION['uploads'], true);
                if(count($uploads) > 0) {
                    foreach($uploads as $img_filename) {
                        $image_filename_sm = $img_filename;
                        $image_filename_md = $img_filename;
                        $image_filename_lg = $img_filename;
        
                        $stmtImg = $this->con->prepare("INSERT INTO donation_images (donation_id, image_filename_sm, image_filename_md, image_filename_lg, created_at) VALUES (?, ?, ?, ?, ?)");
                        $stmtImg->bind_param("issss", $donation_id, $image_filename_sm, $image_filename_md, $image_filename_lg, $created_at);
                        $stmtImg->execute();
                        $stmtImg->close();
                    }
                }
            }
            
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
        // Created donation array
        if ($donation_id) {
            $donation_array = $this->get_donation($donation_id);
            $html = $this->donations_row_html($donation_array);
        } else {
            $donation_array = array();
            $html = '';
        }
    
        $create_response = json_encode(array(
            'status' => $status,
            'donation_array' => $donation_array,
            'html' => $html
        ), true);
    
        echo $create_response;
    }
    public function update_donation($donation_id) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $updated_at = datetime_now();
    
        $stmt = $this->con->prepare("UPDATE donations SET title=?, description=?, amount=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssssi', $title, $description, $amount, $updated_at, $donation_id);
        if ($stmt->execute()) {   
            $status = '1';

            // var_dump($_SESSION['uploads']);
    
            // Insert Images
            if(isset($_SESSION['uploads'])) {
                $uploads = json_decode($_SESSION['uploads'], true);
                if(count($uploads) > 0) {
                    foreach($uploads as $img_filename) {
                        $image_filename_sm = $img_filename;
                        $image_filename_md = $img_filename;
                        $image_filename_lg = $img_filename;
        
                        // var_dump($donation_id, $image_filename_sm, $image_filename_md, $image_filename_lg, $updated_at);

                        $stmtImg = $this->con->prepare("INSERT INTO donation_images (donation_id, image_filename_sm, image_filename_md, image_filename_lg, created_at) VALUES (?, ?, ?, ?, ?)");
                        $stmtImg->bind_param("issss", $donation_id, $image_filename_sm, $image_filename_md, $image_filename_lg, $updated_at);
                        
                        if ($stmtImg->execute()) { 
                            $status = '1';
                        } else {
                            die('prepare() failed: ' . htmlspecialchars($this->con->error));
                            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                            die('execute() failed: ' . htmlspecialchars($stmt->error));
                        }

                        $stmtImg->close();
                    }
                }
            }
        } else {
            $status = '0';
                
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
            
        // Created donation array
        if ($donation_id) {
            $donation_array = $this->get_donation($donation_id);
            $html = $this->donations_row_html($donation_array);
        } else {
            $donation_array = array();
            $html = '';
        }
    
        $update_response = json_encode(array(
            'status' => $status,
            'donation_array' => $donation_array,
            'html' => $html
        ), true);
    
        echo $update_response;
    }
    public function delete_donation_image($donation_id, $image_filename) {

        // var_dump($donation_id, $image_filename);
        $stmt = $this->con->prepare("DELETE FROM donation_images WHERE donation_id=? AND image_filename_sm=?");
        $stmt->bind_param('is', $donation_id, $image_filename);
        $stmt->execute();
        $stmt->close();

        // $stmt = $this->con->prepare("UPDATE donations SET photo=null WHERE id=?");
        // $stmt->bind_param('i', $donation_id);
        // $stmt->execute();
        // $stmt->close();
    }
    private function get_donations_total() {
        
        $total_amount = 0;
        
        $sql = "SELECT amount FROM donations";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        if(count($data) > 0) {
            foreach ($data as $row) {
                $total_amount += floatval($row['amount']);
            }
        }
    
        $stmt->close();
    
        return $total_amount;
    }
    public function donations_table_header() {
        return "<div class='content-inner scrollable-div'>
            <div class='content'>
                <div class='header'>
                    <div class='item'>Name</div>
                    <div class='item'>Amount Raised</div>
                    <div class='item'>Descriptions</div>
                    <div class='item'>Edit</div>
                </div>
                <div class='body'>
                    <div class='rows'>";
    }
    public function donations_table_footer() {
        return "</div></div></div></div>";
    }
    public function donations_row_html($donation) {
        $output = "";
    
        // Dollar sign prefix for the amount
        $dollar_sign = "$";

        $img = $donation['images'][0]['image_filename_sm'];
    
        // Generating HTML output for the donation row
        $output .= "<div class='c-row'>
            <div class='item'>
                <div class='thumbnail'>
                    <img src='./uploads/{$img}' alt=''>
                </div>
                {$donation['title']}
            </div>
            <div class='item'>
                <img class='arrow-up' src='./assets/arrow-up-04-solid-standard 1.svg' alt=''>
                {$dollar_sign}{$donation['amount']}+
            </div>
            <div class='item'>{$donation['description']}</div>
            <div class='item'>
                <button onclick='edit_donation_popup(\"{$donation['id']}\")' class='edit-button' data-id='{$donation['id']}'>
                    <img src='./assets/compose.svg' alt=''>
                </button>
            </div>
        </div>";
    
        return $output;
    }
    public function donations_admin($isIndex = false) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Fetch the array of donations
        $donations_array = $this->get_donations(); // Replace with your method to fetch donations
    
        $num_of_rows = count($donations_array);
    
        // Results per page
        $results_per_page = 20;
    
        // Calculate the total number of pages
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine the current page
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        // Calculate the starting point for the current page
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        // Initialize content
        $contentStr = "";
    
        // Add the table header
        $contentStr .= $this->donations_table_header();
    
        // Add rows for the current page
        foreach (array_slice($donations_array, $starting_limit_number, $results_per_page) as $donation) {
            $contentStr .= $this->donations_row_html($donation);
        }
    
        // Add the table footer
        $contentStr .= $this->donations_table_footer();
    
        // Add pagination links
        $contentStr .= "<div class='pagination'>";
    
        if ($num_of_pages > 1) {
            // Previous page link
            $prev_page = max(1, $page - 1);
            $contentStr .= "<a class='page-num arrow' href='./$pagename?page=$prev_page'>Prev</a>";
    
            // Page number links
            for ($p = 1; $p <= $num_of_pages; $p++) {
                $class = ($p == $page) ? "current-page" : "";
                $contentStr .= "<a class='page-num $class' href='./$pagename?page=$p'>$p</a>";
            }
    
            // Next page link
            $next_page = min($num_of_pages, $page + 1);
            $contentStr .= "<a class='page-num arrow' href='./$pagename?page=$next_page'>Next</a>";
        }
    
        $contentStr .= "</div>";
    
        // Output the complete table
        echo $contentStr;
    }
    public function donations_widget() {
        $donations_total = $this->get_donations_total();
        $current_year_donations_amount = $this->get_donations_current_year();

        // $imgStr = "<img src='./assets/my-donation.svg' alt=''>";
        $donationsTitle = "My Donation";
        $donationsSubtitle = "<span class='amount'>$" . $current_year_donations_amount['total_amount'] . "</span> Donated in 2025";
        $imgStr = "<img src='./assets/logo-yellow.svg' alt=''>";
        // $donationHeading = "SAVE THE SHARKS";
        $donationHeading = "SPREAD THE GOSPEL";
        


        echo "<div class='my-donation'>
            <div class='title'>
                $donationsTitle
                <p class='donations-subtitle'>
                    $donationsSubtitle
                </p>
            </div>
            <div class='image-wrapper'>
                $imgStr
            </div>
            <div class='middle'>
                <h2>$donationHeading</h2>
                <p>Total Contributed: $"."$donations_total</p>
            </div>
        </div>";
    }
    public function edit_donation_form($donation_id) {
        $donation = $this->get_donation($donation_id);
        
        $imagesStr = "";

        $uploads = array();

        if(count($donation['images']) > 0) {
            // var_dump($donation['images']);
            foreach($donation['images'] as $image) {
                $image_filename_sm = $image['image_filename_sm'];
                $image_dir = "uploads/{$image_filename_sm}";
    
                $imagesStr .= "<div class='img-container'>
                    <img src='$image_dir'>
                    <span onclick='delete_old_donation_image(this, $donation_id, \"$image_dir\")' class='remove-icon'>&times;</span>
                </div>";
    
                
                array_push($uploads, basename($image_filename_sm));
            }
        }

        if(isset($_SESSION['old_uploads'])) {
            unset($_SESSION['old_uploads']);
        }
        $_SESSION['old_uploads'] = json_encode($uploads, true);
        
        $contentStr = "
        <form action='' class='popup-form scrollable-div-y' id='popup-form'>
            <div class='row' id='row-1'>
                <div class='column' id='column-1'>

                    <div class='upload-area' id='uploadfile'>
                        <div class='upload-area-inner'>
                            <div class='upload-icon'>
                                <img src='assets/upload.svg' alt=''>
                            </div>
                            <div class='select-text'>
                                Drag and Drop file here or <span id='fileElem' style='color: #3F8BB7; cursor: pointer;'>Choose File</span>
                            </div>
                        </div>
                    </div>

                    <div class='uploaded-images' id='uploadedImages'>
                        $imagesStr
                    </div>

                    <input type='file' id='fileInput' style='display: none;'>

                    <div class='input-wrapper' id='title-wrapper'>
                        <label for='title'>Title<span class='required'>*</span></label>
                        <input value='{$donation['title']}' name='title' id='title-field' type='text' class='input-field' placeholder='Type here'>
                        <div id='title-error' class='error-text'></div>
                    </div>

                    <div class='input-wrapper' id='amount-wrapper'>
                        <label for='amount'>Amount Raised<span class='required'>*</span></label>
                        <input value='{$donation['amount']}' name='amount' id='amount-field' type='text' class='input-field' placeholder='Type here'>
                        <div id='amount-error' class='error-text'></div>
                    </div>

                    <div class='input-wrapper' id='description-wrapper'>
                        <label for='description'>Description</label>
                        <textarea name='description' rows='5' id='description-field' class='textarea-field' placeholder='Type here'>{$donation['description']}</textarea>
                        <div id='description-error' class='error-text'></div>
                    </div>
                </div>
            </div>

            <div class='row' id='row-2'>
                <span class='btns'>
                    <span class='btn admin-btn-2' onclick='closePopup()'>
                        Cancel
                    </span>
                    <span class='btn admin-btn-1' onclick='update_donation(event)'>
                        Save
                    </span>
                </span>
            </div>

            <div class='row' id='row-3'>
                <!-- Response -->
                <div class='message-response' id='message-response-1'></div>
            </div>

        </form>";
    
        echo $contentStr;
    }
    // Credit
    public function donation_credit_items() {
        $donations = $this->get_donations();
        
        $donationStr = "";
        foreach ($donations as $donation) {
            // Fetch donation images from donation_images table
            $images = $this->get_donation_images($donation['id']);
    
            // Ensure at least one image exists
            if (!empty($images)) {

                $image = $images[0];
                
                $donationStr .= "<div onclick='get_donation_credit_popup(\"{$donation['id']}\")' class='item' style='cursor: pointer;'>";
                
                $donationStr .= "<img src=\"./admin/uploads/{$image['image_filename_md']}\" alt='Donation Image'>";

                $donationStr .= "</div>";
            }
        }
        
        echo $donationStr;
    }
    // Function to fetch images for a donation
    private function get_donation_images($donation_id): array {
        $stmt = $this->con->prepare("SELECT image_filename_md FROM donation_images WHERE donation_id = ?");
        $stmt->bind_param('i', $donation_id);  // 'i' for integer type (assuming donation_id is an integer)
        $stmt->execute();
        $result = $stmt->get_result();  // Get result set
        
        // Fetch results
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        
        return $images;
    }
    public function donation_credit_popup($donations_id) {
        $donation = $this->get_donation($donations_id);
    
        $images = $this->get_donation_images($donations_id);
        
        $imgStr = '';
    
        foreach ($images as $image) {
            $photo = htmlspecialchars($image['image_filename_md']);
            $imgStr .= "<div class='image'>
                <img src='./admin/uploads/$photo' alt=''>
            </div>";
        }
    
        // Get other donation details
        $title = htmlspecialchars($donation['title']);
        $description = htmlspecialchars($donation['description']);
                            
        echo "<div class='popup-wrapper'>
                <div class='popup hide_popup' id='drop-popup'>
                    <div class='popup-inner'>
    
                        <div id='cross' onclick='closePopup()'>
                            <img src='assets/cross.svg' alt=''>
                        </div>
    
                        <div class='popup-div'>
                            
                            <div class='drop'>
                                <div class='col-left'>
                                    <div class='drop-images owl-carousel'>
                                        $imgStr
                                    </div>
                                </div>
                                <div class='col-right'>
                                    <div class='drop-title'>
                                        <h2>$title</h2>
                                    </div>
                                    <div class='text-row'>
                                        <p>$description</p>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
    
                    </div>
                </div>
            </div>";
    }
}


