<?php

if(!isset($_SESSION)) {
    ob_start();
    session_start(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = [];
    if (!empty($_FILES['file']['name'][0])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['file']['name'] as $key => $name) {
            $tmpName = $_FILES['file']['tmp_name'][$key];
            
            // Generate a unique name for the file
            $uniqueName = uniqid() . time() . '_' . basename($name);
            $uploadFile = $uploadDir . $uniqueName;
            
            // Session handling
            if (isset($_SESSION['uploads'])) {
                $uploads = json_decode($_SESSION['uploads'], true);
            } else {
                $uploads = array();
            }
            
            array_push($uploads, $uniqueName);
            $_SESSION['uploads'] = json_encode($uploads, true);
            
            if (move_uploaded_file($tmpName, $uploadFile)) {
                $response[] = ['url' => $uploadFile];
            } else {
                $response[] = ['error' => "Error uploading file: $name"];
            }
        }
    } else {
        $response[] = ['error' => 'No files uploaded.'];
    }

    echo json_encode($response);
}