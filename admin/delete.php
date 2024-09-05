<?php

if(!isset($_SESSION)) {
    ob_start();
    session_start(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $imageUrl = $data['url'];
    $filename = basename($imageUrl);
    $uploadDir = 'uploads/';

    // Remove the file from the uploads directory
    if (file_exists($uploadDir . $filename)) {
        unlink($uploadDir . $filename);
    }

    // Update the session to remove the image name
    if (isset($_SESSION['uploads'])) {
        $uploads = json_decode($_SESSION['uploads'], true);
        $uploads = array_diff($uploads, [$filename]);
        $_SESSION['uploads'] = json_encode(array_values($uploads));
    }

    echo $_SESSION['uploads'];

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}


?>
