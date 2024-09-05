<?php

/*
=================================================================
    SESSIONS & COOKIES
    CRUD (create, read, update, delete)
    DISPLAY
    FORMS
    ADMIN
=================================================================  
*/
class AdminAccount extends Db {

    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    /*
    =================================================================
        SESSIONS & COOKIES
    =================================================================  
    */
    public function startSession() {
        if(!isset($_SESSION)) { 
            ob_start();
            session_start(); 
        }
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    /*
    =================================================================
        CRUD (create, read, update, delete)
    =================================================================  
    */
    public function get_user($id) {
        $stmt2 = $this->con->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt2->bind_param('i', $id);
        $stmt2->execute();        
        $result2 = $stmt2->get_result();
        $data2 = $result2->fetch_all(MYSQLI_ASSOC);
        if(isset($data2)) {
            if(count($data2) > 0) {
                foreach($data2 as $row2): 
                    $user_array = array(
                        'id' => $row2['id'],
                        'firstname' => $row2['firstname'],
                        'lastname' => $row2['lastname'],
                        'email' => $row2['email'],
                        'photo' => $row2['photo'],
                        'user_status' => $row2['user_status'],
                        'account_status' => $row2['account_status'],
                        'created_at' => $row2['created_at']
                    );
                endforeach;        
            }
        }
        $stmt2->close();
        
        return $user_array;
    }
    public function createAdmin() {
        $username = $_POST['username'];
        $bio = $_POST['bio'];
        if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
            $photo = '';
        } else {
            $photo = add_img('photo');
        }
        $fname = $_POST['fname'];
        // $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $options = [
            'cost' => 11
        ];
        $pwdHash = password_hash($password, PASSWORD_BCRYPT, $options);
        $user_status = 'admin';
        $account_status = 'active';
        $access_level = $_POST['access_level'];
        $created_at = datetime_now();
        $updated_at = $created_at;

        // $stmt = $this->con->prepare("INSERT INTO users (firstname, lastname, username, bio, email, pwd, photo, user_status, account_status, access_level, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // $stmt->bind_param('ssssssssssss', $fname, $lname, $username, $bio, $email, $pwdHash, $photo, $user_status, $account_status, $access_level, $created_at, $updated_at);    
        $stmt = $this->con->prepare("INSERT INTO users (fullname, username, bio, email, pwd, photo, user_status, account_status, access_level, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssssss', $fname, $username, $bio, $email, $pwdHash, $photo, $user_status, $account_status, $access_level, $created_at, $updated_at);

        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function updateAdmin() {
        $id = $_POST['user_id'];
        $profile = $this->get_admin_profile($id);

        $username = $_POST['username'];
        $bio = $_POST['bio'];
        if(!isset($_FILES['photo']['name']) || empty($_FILES['photo']['name'])) {
            $photo = $profile['photo'];
        } else {
            $photo = add_img('photo');
        }
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $options = [
            'cost' => 11
        ];
        $pwdHash = password_hash($password, PASSWORD_BCRYPT, $options);
        $user_status = 'admin';
        $account_status = $_POST['account_status'];
        $access_level = $_POST['access_level'];
        $created_at = datetime_now();
        $updated_at = $created_at;

        // if(!empty($password)) {
        //     $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, username=?, bio=?, email=?, pwd=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
        //     $stmt->bind_param('ssssssssssi', $fname, $lname, $username, $bio, $email, $pwdHash, $photo, $account_status, $access_level, $updated_at, $id);    
        // } else {
        //     $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, username=?, bio=?, email=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
        //     $stmt->bind_param('sssssssssi', $fname, $lname, $username, $bio, $email, $photo, $account_status, $access_level, $updated_at, $id);    
        // }

        if(!empty($password)) {
            $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, bio=?, email=?, pwd=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
            $stmt->bind_param('sssssssssi', $fname, $lastname, $bio, $email, $pwdHash, $photo, $account_status, $access_level, $updated_at, $id);    
        } else {
            $stmt = $this->con->prepare("UPDATE users SET firstname=?, lastname=?, bio=?, email=?, photo=?, account_status=?, access_level=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssssssssi', $fname, $lastname, $bio, $email, $photo, $account_status, $access_level, $updated_at, $id);    
        }

        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function update_email() {
        $this->startSession();
        $id = get_uid();
        $user_array = $this->get_user($id);
        $email = $_POST['email'];
        $updated_at = datetime_now();
        
        $stmt = $this->con->prepare("UPDATE users SET email=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $email, $updated_at, $id);
        
        if($stmt->execute()) {
            if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $userdata2 = array(
                    'logged' => $userdata['logged'],
                    'uid' => $userdata['uid'],
                    'email' => $email,
                    'fullname' =>  $userdata['fullname'],
                    'photo' => $userdata['photo'],
                    'user_ip' => $userdata['user_ip'],
                    'user_status' => $userdata['user_status'],
                    'account_status' => $userdata['account_status'],
                );
                $_SESSION['user'] = json_encode($userdata2, true);
            }

            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();

        echo $status;
    }
    public function update_user_password() {
        $this->startSession();
        $id = get_uid();
        $user_array = $this->get_user($id);
        $updated_at = datetime_now();
        if(isset($_POST['pwd'])) {
            $options = [
                'cost' => 11
            ]; 
            $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT, $options);

            $stmt = $this->con->prepare("UPDATE users SET pwd=?, updated_at=? WHERE id=?");
            $stmt->bind_param('ssi', $pwd, $updated_at, $id);
        }
        if($stmt->execute()) {
            $status = '1';
        } else {
            $status = '0';
        }
        $stmt->close();
        echo $status;
    }
    public function get_admin_profile($id) {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $profile_array = array(
                "id" => $row['id'],
                "fullname" => $row['fullname'],
                "username" => $row['username'], 
                "bio" => $row['bio'], 
                "email" => $row['email'],
                "photo" => $row['photo'],
                "user_status" => $row['user_status'],
                "account_status" => $row['account_status'],
                "access_level" => $row['access_level'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );
        endforeach;
        $stmt->close();

        return $profile_array;
    }
    public function get_admin_profiles() {
        $profiles_array = array();
        $stmt = $this->con->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row):
            $profile_array = array(
                "id" => $row['id'],
                "fullname" => $row['fullname'],
                "username" => $row['username'], 
                "bio" => $row['bio'], 
                "email" => $row['email'],
                "photo" => $row['photo'],
                "user_status" => $row['user_status'],
                "account_status" => $row['account_status'],
                "access_level" => $row['access_level'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );
            array_push($profiles_array, $profile_array);
        endforeach;
        $stmt->close();

        return $profiles_array;
    }
    public function admin_profiles() {
        $profiles = $this->get_admin_profiles();

        $profilesStr = "";

        foreach($profiles as $profile):
            
            if($profile['access_level'] == 'All') {
                $accessClass = "badge badge-pill badge-success";
            } else if($profile['access_level'] == 'Merch') {
                $accessClass = "badge badge-pill badge-warning";
            } else if($profile['access_level'] == 'Events') { 
                $accessClass = "badge badge-pill badge-secondary";
            }

            $profilesStr .= "<tr>
                <td class='py-3'>{$profile['id']}</td>
                <td class='py-3'>
                    <div>{$profile['fullname']}</div>
                </td>
                <td class='py-3'>{$profile['username']}</td>
                <td class='py-3'>{$profile['email']}</td>
                <td class='py-3'>{$profile['account_status']}</td>
                <td class='py-3'>
                    <span class='$accessClass'>{$profile['access_level']}</span>
                </td>
                <td class='py-1'>
                    <div class='position-relative'>
                        <a id='dropDown10Invoker' class='link-dark d-flex' href='#' aria-controls='dropDown10' aria-haspopup='true' aria-expanded='false' data-unfold-target='#dropDown10' data-unfold-event='click' data-unfold-type='css-animation' data-unfold-duration='300' data-unfold-animation-in='fadeIn' data-unfold-animation-out='fadeOut'>
                            <i class='fas fa-ellipsis-h'></i>
                        </a>

                        <ul id='dropDown10' class='unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-1 unfold-css-animation unfold-hidden fadeOut' aria-labelledby='dropDown10Invoker' style='min-width: 150px; animation-duration: 300ms; right: -20px;'>
                            <li class='unfold-item'>
                                <a class='unfold-link media align-items-center text-nowrap' href='admin-edit?id={$profile['id']}'>
                                    <i class='gd-pencil unfold-item-icon mr-3'></i>
                                    <span class='media-body'>Edit</span>
                                </a>
                            </li>
                            <li class='unfold-item'>
                                <a onclick='return pop(this)' class='unfold-link media align-items-center text-nowrap' href='../controllers/user-handler?deladmin={$profile['id']}'>
                                    <i class='gd-close unfold-item-icon mr-3'></i>
                                    <span class='delete-link media-body'>Delete</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>";        
        endforeach;
        echo $profilesStr;
    }
    /*
    =================================================================
        FORMS
    =================================================================  
    */
    public function createAdminForm() {
        echo "<form runat='server'>
            
            <input type='hidden' id='create_admin' name='create_admin' value='true'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='mb-3'>
                        <label class='form-label' for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Username' value=''>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='bio'>Bio</label>
                        <textarea rows='2' class='form-control' id='bio' name='bio' placeholder='Tell something about yourself'></textarea>
                    </div>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='fname'>Fullname</label>
                            <input type='text' class='form-control' id='fname' name='fname' placeholder='Fullname' value=''>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='email'>Email</label>
                            <input type='email' class='form-control' id='email' name='email' placeholder='Email' value=''>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='password'>Password</label>
                            <input type='password' class='form-control' id='password' name='password' placeholder='Password' value=''>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='access_level'>Access</label>
                            <select class='form-control' id='access_level' name='access_level'>
                                <option value='All'>All</option>
                                <option value='Merch'>Merch</option>
                                <option value='Events'>Events</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='text-center'>
                        <div class='pfp-wrapper'>
                            <img id='pfp-img-preview' src='../images/avi.png' alt='' class='rounded-circle img-responsive mt-2' />
                        </div>
                        <div class='mt-2'>
                            <input class='input' id='image' type='file' name='image' style='display: none;'>
                            <span id='upload_btn' onclick='return fireButton(event);' class='btn btn-primary'><i class='fas fa-upload'></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                </div>

            </div>
            <div class='mb-3'>
                <span onclick='create_admin(event)' type='submit' class='btn btn-primary'>Create Profile</span>
            </div>
            <div id='message-response-1'></div>
        </form>";
    }
    public function editAdminForm($id) {
        $profile = $this->get_admin_profile($id);
        if(!empty($profile['photo'])) {
            $profile_img = "<div class='pfp-wrapper'>
                <img id='pfp-img-preview' src='../images/{$profile['photo']}' alt='{$profile['username']}' class='rounded-circle img-responsive mt-2' />
            </div>";
        } else {
            $profile_img = "<div class='pfp-wrapper'>
                <img id='pfp-img-preview' src='../images/avi.png' alt='{$profile['username']}' class='rounded-circle img-responsive mt-2' />
            </div>";

        }
        // Account Status
        if($profile['account_status'] == 'active') {
            $accountStr = "<select class='form-control' id='account_status' name='account_status'>
                <option value='active' selected>Active</option>
                <option value='inactive'>Inactive</option>
            </select>";
        } else if($profile['account_status'] == 'inactive') {
            $accountStr = "<select class='form-control' id='account_status' name='account_status'>
                <option value='active'>Active</option>
                <option value='inactive' selected>Inactive</option>
            </select>";
        } 
        // Access
        if($profile['access_level'] == 'All') {
            $accessStr = "<select class='form-control' id='access_level' name='access_level'>
                <option value='All' selected>All</option>
                <option value='Merch'>Merch</option>
                <option value='Events'>Events</option>
            </select>";
        } else if($profile['access_level'] == 'Merch') {
            $accessStr = "<select class='form-control' id='access_level' name='access_level'>
                <option value='All'>All</option>
                <option value='Merch' selected>Merch</option>
                <option value='Events'>Events</option>
            </select>";
        } else if($profile['access_level'] == 'Events') {
            $accessStr = "<select class='form-control' id='access_level' name='access_level'>
                <option value='All'>All</option>
                <option value='Merch'>Merch</option>
                <option value='Events' selected>Events</option>
            </select>";
        }

        echo "<form runat='server'>   
            <input type='hidden' id='user_id' name='user_id' value='$id'>
            <input type='hidden' id='update_admin' name='update_admin' value='true'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='fname'>Fullname</label>
                            <input type='text' class='form-control' id='fname' name='fname' placeholder='Fullname' value='{$profile['fullname']}'>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='username'>Username</label>
                        <input type='text' class='form-control' id='username' name='username' placeholder='Username' value='{$profile['username']}'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='bio'>Bio</label>
                        <textarea rows='2' class='form-control' id='bio' name='bio' placeholder='Tell something about yourself'>{$profile['bio']}</textarea>
                    </div>
                    <div class='row'>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='email'>Email</label>
                            <input type='email' class='form-control' id='email' name='email' placeholder='Email' value='{$profile['email']}'>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='password'>Password</label>
                            <input type='password' class='form-control' id='password' name='password' placeholder='Password' value=''>
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='account_status'>Account Status</label>
                            $accountStr
                        </div>
                        <div class='mb-3 col-md-12'>
                            <label class='form-label' for='access_level'>Access</label>
                            $accessStr
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='text-center'>
                        $profile_img
                        <div class='mt-2'>
                            <input class='input' id='image' type='file' name='image' style='display: none;'>
                            <span id='upload_btn' onclick='return fireButton(event);' class='btn btn-primary'><i class='fas fa-upload'></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                    </div>
                </div>

            </div>
            <div class='mb-3'>
                <span onclick='update_admin(event)' type='submit' class='btn btn-primary'>Update Profile</span>
            </div>
            <div id='message-response-1'></div>
        </form>";
    }
    /*
    =================================================================
        ADMIN FORMS
    =================================================================  
    */
    public function updateEmailForm() {
        $user_email = get_user_email();
        echo "
        <div>
            <form id='update-pwd-form' style='margin-bottom: 50px;'>
                <h4 class='form-title'>Email</h4>                      
                <input type='hidden' name='update_email' id='update_email' value='true'>
                <div class ='mb-3' id='email-wrapper'>
                    <label for='email-field' class='form-label'>Email: </label>
                    <input type='email' name='email' id='email-field' class='form-control' value='$user_email'>
                    <div id='email-error' class='error'></div>
                </div> 
                <div>
                    <span onclick='update_email();' style='margin-top: 10px;' type='submit' class='btn btn-primary'>Submit</span>  
                </div>
                <div class='message-response' id='message-response'></div>
            </form>
        </div>";
    }
    public function updatePwdForm() {
        echo "
        <div>
            <form id='update-pwd-form'>
                <h4 class='form-title'>Password</h4>                      
                <input type='hidden' name='update_password' id='update_password' value='true'>
                <div class ='mb-3' id='password-wrapper'>
                    <label for='password-field' class='form-label'>Password: </label>
                    <input type='password' name='password' id='password-field' class='form-control'>
                    <div id='password-error' class='error'></div>
                </div> 
                <div class ='mb-3' id='password-wrapper-2'>
                    <label for='password-field-2' class='form-label'>Repeat Password: </label>
                    <input type='password' name='password' id='password-field-2' class='form-control'>
                    <div id='password-error-2' class='error'></div>
                </div> 
                <div>
                    <span onclick='update_user_password();' style='margin-top: 10px;' type='submit' class='btn btn-primary'>Submit</span>  
                </div>
                <div class='message-response' id='message-response-2'></div>
            </form>
        </div>";
    }
}