<?php
/*
=================================================================
    CRUD
    DISPLAY
    FORMS
=================================================================  
*/

namespace MyApp\Classes;

class MyAccount extends User {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    /*
    =================================================================
        CRUD
    =================================================================  
    */
    public function update_general_info() {
        // Get user ID from session or however you're managing sessions
        $userId = get_uid();
        
        // Get user account type from session or wherever it's stored
        $accountType = get_account_type(); // Assuming you have a function for this
        
        // Retrieve data from POST request
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $age = $_POST['age'];
        $locateAddress = $_POST['location'];
        $bio = $_POST['bio'];
        
        // Update the common user table
        $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, email=?, phone=?, updated_at=NOW() WHERE id=?");
        $stmt->bind_param('ssssi', $firstname, $lastname, $email, $phone, $userId);
        $stmt->execute();

        // Update Session
        $this->update_user_session();

        
        // Update the account details based on account type
        if ($accountType === 'coach') {
            $stmt = $this->con->prepare("UPDATE coach_account_details SET locate_address=?, dob=?, age=?, bio=? WHERE coach_uid=?");
        } elseif ($accountType === 'athlete') {
            $stmt = $this->con->prepare("UPDATE athlete_account_details SET locate_address=?, dob=?, age=?, bio=? WHERE athlete_uid=?");
        } else {
            // Handle invalid account type
            return "Invalid account type";
        }
        
        $stmt->bind_param('ssisi', $locateAddress, $dob, $age, $bio, $userId);
        if ($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;

    }
    public function delete_user($id) {
        // ACCOUNT TYPE
        $account_type = get_account_type();

        // // DELETE ACCOUNT
        // $sql = "DELETE FROM users WHERE id = ?";
        // $stmt = $this->con->prepare($sql);
        // $stmt->bind_param("i", $id);
        // if($stmt->execute()) {
        //     $stmt->close();
        //     $status = '1';
        //     if($account_type == 'athlete') {

        //         // DELETE ATHLETE ACCOUNT DETAILS
        //         $sql = "DELETE FROM athlete_account_details WHERE athlete_uid = ?";
        //         $stmt = $this->con->prepare($sql);
        //         $stmt->bind_param("i", $id);
        //         if($stmt->execute()) {
        //             $stmt->close();
        //             $status = '1';
        //         }

        //         // DELETE ATHLETE SPORTS
        //         $sql = "DELETE FROM athlete_sports WHERE athlete_uid = ?";
        //         $stmt = $this->con->prepare($sql);
        //         $stmt->bind_param("i", $id);
        //         if($stmt->execute()) {
        //             $stmt->close();
        //             $status = '1';
        //         }
        //     } else {

        //         // DELETE COACH ACCOUNT DETAILS
        //         $sql = "DELETE FROM coach_account_details WHERE coach_uid = ?";
        //         $stmt = $this->con->prepare($sql);
        //         $stmt->bind_param("i", $id);
        //         if($stmt->execute()) {
        //             $stmt->close();
        //             $status = '1';
        //         }

        //         // DELETE COACH SPORTS
        //         $sql = "DELETE FROM coach_sports WHERE coach_uid = ?";
        //         $stmt = $this->con->prepare($sql);
        //         $stmt->bind_param("i", $id);
        //         if($stmt->execute()) {
        //             $stmt->close();
        //             $status = '1';
        //         }

        //     }
        // } else {
        //     $status = '0';
        // }
        $status = '1';
        echo $status;
    }
    
    public function update_profile_photo() {

        $id = get_uid();

        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            // Handle the uploaded image
            $tempFilePath = $_FILES['profile_photo']['tmp_name'];
        
            // Define the directory where you want to save the image
            $imageDirectory = '../assets/avatars/'; // Update this path to your desired directory
        
            // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
            $new_filename = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
        
            // Construct the full path to save the image
            $imagePath = $imageDirectory . $new_filename;
        
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tempFilePath, $imagePath)) {
                // Image uploaded successfully
            } else {
                // Handle the case where the image could not be moved
                $new_filename = '';
            }
        } else {
            // Handle the case where no image was provided
            $new_filename = '';
        }

        $updated_at = datetime_now();

        $stmt = $this->con->prepare("UPDATE users SET photo=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $new_filename, $updated_at, $id);
    
        if($stmt->execute()) {    
            $stmt->close();
            // Update Session
            $this->update_user_session();
            $status = '1';
        } else {
            $status = '0';
        }
        echo $status;
    }
    /*
    =================================================================
        DISPLAY
    =================================================================  
    */
    public function dashboard_profile() {
        $uid = get_uid();
        $user = $this->get_user($uid)[$uid];

        if(!empty($user['photo'])) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$user['photo']}' />";
        } else {     
            $fname = get_firstname();
            $fChar = $fname[0];
            $photo = "<div class='user-no-picture'>$fChar</div>";
        }

        echo "<div class='card mb-4'>
            <div class='profile-infos'>

                <div class='img-wrapper'>
                    $photo
                </div>
                <div class='name'>
                    {$user['firstname']}
                </div>

                <div class='adress'>{$user['postal_address']}</div>
            </div>
        </div>";
    }
    public function profile_image() {
        $pht = get_user_photo();

        if(!empty($pht)) {
            $photo = "<img style='width: 100%; height: 100%;' src='./assets/avatars/{$pht}' />";
        } else {     
            $fname = get_firstname();
            $fChar = $fname[0];
            $photo = "<div class='user-no-picture' style='font-size: 15px;'>$fChar</div>";
        }

        echo $photo;
    }
    /*
    =================================================================
        FORMS
    =================================================================  
    */
    public function general_info_form() {
        $userId = get_uid();
        $user = $this->get_user($userId);
    
        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center mb-4'>General Information</h6>";
    
        // Populate input fields with user data
        echo "<div class='custom-input-wrapper'>
            <input value='{$user['firstname']}' type='text' class='custom-input' data-rule='success' data-label='firstname' name='firstname' id='firstname' placeholder='First name'>
            <div id='fname-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <input value='{$user['lastname']}' type='text' class='custom-input' data-rule='success' data-label='lastname' name='lastname' id='lastname' placeholder='Last name'>
            <div id='lname-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <input value='{$user['email']}' type='text' class='custom-input' data-rule='success' data-label='email' placeholder='Email' name='email' id='email'>
            <div id='email-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <input value='{$user['phone']}' type='text' class='custom-input' data-rule='success' data-label='phone' placeholder='Phone' name='phone' id='phone'>
            <div id='phone-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <input value='{$user['details']['dob']}' type='date' class='custom-input' data-rule='success' data-label='dob' name='dob' id='dob'>
            <div id='dob-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <input value='{$user['details']['age']}' type='text' class='custom-input' data-rule='success' data-label='age' placeholder='Age' name='age' id='age'>
            <div id='age-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <input value='{$user['details']['locate_address']}' type='text' class='custom-input' data-rule='success' data-label='location' placeholder='Location' name='location' id='location'>
            <div id='location-error' class='error'></div>
        </div>
        <div class='custom-input-wrapper'>
            <textarea class='custom-input' data-label='bio' name='bio' placeholder='Bio' rows='5'>{$user['details']['bio']}</textarea>
            <div id='bio-error' class='error'></div>
        </div>";
    
        echo "<div class='row justify-content-center'>
            <input onclick='update_user_details(event)' style='margin: 10px auto 0 auto;' type='submit' class='form-btn btn btn-submit' value='Save'>
        </div>
        <div class='message-response' id='message-response-1'></div>
        </div>
        </div>";
    }
    public function delete_form() {
        $userId = get_uid();
        $user = $this->get_user($userId);
    
        echo "<div class='card'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Delete Account</h6>
                <p class='card-text'>ATTENTION! All of your data (contacts, ads, emails, ...) will be definitively and irreversibly deleted.</p>
                <div class='row justify-content-center'>
                    <input onclick='get_popup_content(\"{$userId}\")' style='margin: 10px auto 0 auto;' class='btn btn-gray' onclick='del();' name='delete_account' id='delete_account' value='Delete Account'>
                </div>
                <div class='message-response' id='message-response-1'></div>
            </div>
        </div>";
    
    }
    public function reset_link_form() {
        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Change Password</h6>
                <div class='row justify-content-center'>
                    <input onclick='send_reset_link(event)' style='margin: 10px auto 0 auto;' type='submit' class='form-btn btn btn-submit' value='Send Reset Link'>
                </div>
                <div class='message-response' id='message-response-5'></div>
            </div>
        </div>";
    }
    
    public function profile_photo_form() {

        $userId = get_uid();

        $user = $this->get_user($userId);

        // Gender
        if($user['photo'] != '') {
            $ph = "<img src='./assets/avatars/{$user['photo']}' alt=''>";
            // $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072743.png' alt=''>";
        }

        echo "
        <div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Profile Photo</h6>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 20px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-3'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper'>
                        <button class='btn btn-submit' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-3' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-3'></div>
            </div>
        </div>";
    }

    public function certificate_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['certificate_file'] != '') {
            $ph = "<img src='./assets/certificates/{$user['certificate_file']}' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072517.png' alt=''>";
        }

        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Certificate</h6>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 20px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-1'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-1' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-2'></div>
            </div>
        </div>";
    }
    
    public function identification_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['identification_file'] != '') {
            $ph = "<img src='./assets/identifications/{$user['identification_file']}' alt=''>";
            // $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        }

        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Identification</h6>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 20px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-2'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-2' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-3'></div>
            </div>
        </div>";
    }
    
    public function profile_photo_form_2() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];

        // Gender
        if($user['photo'] != '') {
            $ph = "<img src='./assets/avatars/{$user['photo']}' alt=''>";
            // $ph = "<img src='./assets/Screenshot 2023-11-09 072558.png' alt=''>";
        } else {
            $ph = "<img src='./assets/Screenshot 2023-11-09 072743.png' alt=''>";
        }

        echo "
        <div class='mb-4'>
            <div class='card-body'>
                <h3 class='card-title text-center'>Profile Photo</h3>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-top: 20px; margin-bottom: 30px;'>
                        <div class='profile-placeholder'>
                            <div class='err err-3'>Error</div>
                            $ph
                        </div>   
                        <div class='selected-img'>
                            <img class='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error'></div>
                    <div class='register-btn-wrapper' style='margin-top: 30px;'>
                        <button class='btn btn-validate' onclick='return fireButton(event, this);'>Choose File</button>      
                        <input class='input image-input image-input-3' id='image' type='file' name='image' style='display: none;'>
                    </div>
                </div>
                <div class='message-response' id='message-response-4'></div>
            </div>
        </div>";
    }
    public function postal_address_form() {

        $userId = get_uid();

        $user = $this->get_user($userId)[$userId];


        echo "<div class='card mb-4'>
            <div class='card-body'>
                <h6 class='card-title text-center'>Postal Address</h6>
                <div>
                    <input value='{$user['postal_address']}' type='text' class='custom-input' data-rule='success' id='address' data-label='address' placeholder='133 Houndsditch, London EC3A 7...'>
                </div>

                <div class='row justify-content-center'>
                    <input onclick='update_postal_address(event)' style='margin: 10px auto 0 auto;' type='submit' class='form-btn btn btn-validate' value='Save'>
                </div>
                <div class='message-response' id='message-response-5'></div>
            </div>
        </div>";
    }
}


?>