<?php
    // Google API Credenntials
    include './google-config.php';

    // Required scopes for basic profile info
    define('GOOGLE_SCOPES', 'email profile openid');
?>

<?php
    // auth/google.php - Initiates the Google OAuth flow
    session_start();
    require_once '../vendor/autoload.php';
    require_once '../config.php';

    // Enable error logging
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/error_log.txt');

    try {
        // Create a new Google client
        $client = new Google_Client();
        $client->setClientId(GOOGLE_CLIENT_ID);
        $client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $client->setRedirectUri(GOOGLE_REDIRECT_URI);
        $client->addScope(explode(' ', GOOGLE_SCOPES));

        // Generate a state parameter to prevent CSRF
        $state = bin2hex(random_bytes(16));
        $_SESSION['oauth_state'] = $state;
        $client->setState($state);

        // Generate the authorization URL and redirect
        $authUrl = $client->createAuthUrl();
        header('Location: ' . $authUrl);
        exit;
    } catch (Exception $e) {
        // Log the error to a file
        file_put_contents(__DIR__ . '/error_log.txt', date('Y-m-d H:i:s') . " - ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
        die("An error occurred. Please check error_log.txt for details.");
    }
?>



