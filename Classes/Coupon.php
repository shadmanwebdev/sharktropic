<?php

namespace MyApp\Classes;

class Coupon extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    function create_coupon() {
        $offer = $_POST['title'];
        $coupon_code = $_POST['coupon'];
        $expiration_date = $_POST['expiry'];
        $percent = $_POST['percent'];
        $created_at = datetime_now();
    
        $stmt = $this->con->prepare(
            'INSERT INTO coupon_codes (offer, coupon_code, expiration_date, percent, created_at) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssss', $offer, $coupon_code, $expiration_date, $percent, $created_at);
    
        if ($stmt->execute()) {
            $status = '1';
    
            $coupon_id = $stmt->insert_id;
    
            // Assuming you want to fetch the new row for display or other purposes
            $coupon = $this->get_coupon($coupon_id); // A method to retrieve the newly inserted coupon
            $coupon_row_html = $this->coupons_row_html($coupon); // A method to generate HTML for the coupon
        } else {
            $status = '0';
            $coupon_row_html = '';
    
            // Log errors for debugging
            error_log('prepare() failed: ' . htmlspecialchars($this->con->error));
            error_log('bind_param() failed: ' . htmlspecialchars($stmt->error));
            error_log('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
        // Return JSON response
        echo json_encode(
            array(
                'status' => $status,
                'coupon_id' => $coupon_id ?? null,
                'html' => $coupon_row_html
            ),
            true
        );
    }
    function update_coupon() {
        $coupon_id = $_POST['coupon_id'];
        $offer = $_POST['title'];
        $coupon_code = $_POST['coupon'];
        $expiration_date = $_POST['expiry'];
        $percent = $_POST['percent'];
        
        $stmt = $this->con->prepare(
            'UPDATE coupon_codes 
             SET offer = ?, coupon_code = ?, expiration_date = ?, percent = ? 
             WHERE id = ?'
        );
        $stmt->bind_param('ssssi', $offer, $coupon_code, $expiration_date, $percent, $coupon_id);
    
        if ($stmt->execute()) {
            $status = '1';
    
            $coupon = $this->get_coupon($coupon_id);
            $coupon_row_html = $this->coupons_row_html($coupon);
        } else {
            $status = '0';
            $coupon_row_html = '';

            error_log('prepare() failed: ' . htmlspecialchars($this->con->error));
            error_log('bind_param() failed: ' . htmlspecialchars($stmt->error));
            error_log('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
        echo json_encode(
            array(
                'status' => $status,
                'coupon_id' => $coupon_id,
                'html' => $coupon_row_html
            ),
            true
        );
    }

    public function get_coupon($coupon_id) {
        $sql = "SELECT 
            coupon_codes.id AS coupon_id,
            coupon_codes.offer AS coupon_offer,
            coupon_codes.coupon_code AS coupon_code,
            coupon_codes.expiration_date AS expiration_date,
            coupon_codes.percent AS percent_discount,
            coupon_codes.created_at AS created_at
        FROM 
            coupon_codes
        WHERE 
            id = ?";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        
        $stmt->bind_param('i', $coupon_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $coupon = array(
                'id' => $row['coupon_id'],
                'offer' => $row['coupon_offer'],
                'coupon_code' => $row['coupon_code'],
                'expiration_date' => $row['expiration_date'],
                'percent' => $row['percent_discount'],
                'created_at' => $row['created_at']
            );
        } else {
            $coupon = null; // Return null if no coupon found
        }
    
        $stmt->close();
        return $coupon;
    }
    public function get_coupons() {
        $coupons = array();
        
        $sql = "SELECT 
            coupon_codes.id AS coupon_id,
            coupon_codes.offer AS coupon_offer,
            coupon_codes.coupon_code AS coupon_code,
            coupon_codes.expiration_date AS expiration_date,
            coupon_codes.percent AS percent_discount,
            coupon_codes.created_at AS created_at
        FROM 
            coupon_codes
        ORDER BY coupon_id DESC";
        
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        foreach ($data as $row) {
            $coupon = array (
                'id' => $row['coupon_id'],
                'offer' => $row['coupon_offer'],
                'coupon_code' => $row['coupon_code'],
                'expiration_date' => $row['expiration_date'],
                'percent' => $row['percent_discount'],
                'created_at' => $row['created_at']
            );
            array_push($coupons, $coupon);
        }
    
        $stmt->close();
    
        return $coupons;
    }

    function coupons_table_header() {
        return "<div class='content-inner scrollable-div'>
            <div class='content'>
                <div class='header'>
                    <div class='item'>Offer</div>
                    <div class='item'>Coupon Code</div>
                    <div class='item'>Expiry Date</div>
                    <div class='item'>Edit</div>
                </div>
                <div class='body'>
                    <div class='rows'>";
    }
    function coupons_table_footer() {
        return "</div></div></div></div>";
    }
    function coupons_row_html($coupon) {
        $output = "";
    
        $output .= "<div class='c-row' id='coupon-{$coupon['id']}'>
            <div class='item'>
                {$coupon['offer']}
            </div>
            <div class='item'>
                {$coupon['coupon_code']}
            </div>
            <div class='item'>{$coupon['expiration_date']}</div>
            <div class='item'>
                <button onclick='edit_coupon_popup(\"{$coupon['id']}\")' class='edit-button' data-id='{$coupon['id']}'>
                    <img src='./assets/compose.svg' alt=''>
                </button>
            </div>
        </div>";
    
        return $output;
    }
    public function coupons_admin($isIndex = false) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Fetch the array of coupons
        $coupons_array = $this->get_coupons(); // Replace with your method to fetch coupons
    
        $num_of_rows = count($coupons_array);
    
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
        $contentStr .= $this->coupons_table_header();
    
        // Add rows for the current page
        foreach (array_slice($coupons_array, $starting_limit_number, $results_per_page) as $coupon) {
            $contentStr .= $this->coupons_row_html($coupon);
        }
    
        // Add the table footer
        $contentStr .= $this->coupons_table_footer();
    
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
    
    public function coupon_edit_form($coupon_id) {
        // Fetch coupon details
        $coupon = $this->get_coupon($coupon_id);
        
        // Check if the coupon exists
        if (!$coupon) {
            echo "<div class='error-text'>Coupon not found.</div>";
            return;
        }
        
        // Populate the form HTML with the coupon details
        $form_html = "
            <form action='' class='popup-form scrollable-div-y' id='popup-form'>
                <input name='coupon_id' id='coupon_id' type='hidden' value='{$coupon['id']}'>
                
                <div class='row' id='row-1'>
                    <div class='column' id='column-1'>
                        <div class='input-wrapper' id='name-wrapper'>
                            <label for='title'>Offer Title<span class='required'>*</span></label>
                            <input name='name' id='title-field' type='name' class='input-field' placeholder='Type here' value='{$coupon['offer']}'>
                            <div id='title-error' class='error-text'></div>
                        </div>
                        <div class='input-wrapper' id='name-wrapper'>
                            <label for='coupon'>Coupon Code<span class='required'>*</span></label>
                            <input name='coupon' id='coupon-field' type='name' class='input-field' placeholder='Type here' value='{$coupon['coupon_code']}'>
                            <div id='coupon-error' class='error-text'></div>
                        </div>
                        <div class='input-wrapper' id='name-wrapper'>
                            <label for='amount'>Expiry Date<span class='required'>*</span></label>
                            <input name='expiry' id='expiry-field' type='name' class='input-field' placeholder='Type here' value='{$coupon['expiration_date']}'>
                            <div id='expiry-error' class='error-text'></div>
                        </div>
                        <div class='input-wrapper' id='name-wrapper'>
                            <label for='percent'>Add Percentage<span class='required'>*</span></label>
                            <input name='percent' id='percent-field' type='name' class='input-field' placeholder='Type here' value='{$coupon['percent']}'>
                            <div id='percent-error' class='error-text'></div>
                        </div>
                    </div>
                </div>
                <div class='row' id='row-2'>
                    <span class='btns'>
                        <span class='btn admin-btn-2' onclick='closePopup()'>
                            Cancel
                        </span>
                        <span class='btn admin-btn-1' onclick='update_coupon(event)'>
                            Save
                        </span>
                    </span>
                </div>
                <div class='row' id='row-3'>
                    <div class='message-response' id='message-response-1'></div>
                </div>
            </form>
        ";
        
        // Echo the populated form HTML
        echo $form_html;
    }
    
    
}


