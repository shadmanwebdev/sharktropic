<?php
    session_start();
    
    // Google API Credenntials
    include './google-config.php';
?>

<?php
    // auth/google-callback.php - Handles the OAuth callback
    require_once '../vendor/autoload.php';
    require_once '../config.php';
    include('../functions.php');
    include('../Classes/Db.php');
    include('../Classes/User.php');

    // Enable error logging
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/error_log.txt');


    try {
        // Verify state parameter to prevent CSRF
        if (!isset($_GET['state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
            throw new Exception('Invalid state parameter. Possible CSRF attack.');
        }

        // Create a new Google client
        $client = new Google_Client();
        $client->setClientId(GOOGLE_CLIENT_ID);
        $client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $client->setRedirectUri(GOOGLE_REDIRECT_URI);

        // Exchange authorization code for access token
        if (!isset($_GET['code'])) {
            throw new Exception("Authentication failed: " . ($_GET['error'] ?? 'Unknown error'));
        }

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            throw new Exception("Google OAuth Error: " . $token['error_description']);
        }

        $client->setAccessToken($token);
    

        // Get user profile data
        $google_oauth = new Google_Service_Oauth2($client);
        $google_user_info = $google_oauth->userinfo->get();

        // Extract user data
        $email = $google_user_info->getEmail();
        $name = $google_user_info->getName();
        $profile_picture = $google_user_info->getPicture();
        $google_id = $google_user_info->getId();

        $u = new MyApp\Classes\User;
        $u->signup_with_google($email, $name, $profile_picture, $google_id);

        header('Location: https://testserver.great-site.net/sharktropic/');
        
    } catch (Exception $e) {
        // Log the error to a file
        file_put_contents(__DIR__ . '/error_log.txt', date('Y-m-d H:i:s') . " - ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
        die("An error occurred. Please check error_log.txt for details.");
    }
?>
