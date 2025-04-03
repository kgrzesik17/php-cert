<?php

function convert_size($size, $precision = 2) {
    switch($size) {
        case $size / 1024 < 1:
            return $size . "B";
        case $size / 1024 ** 2 < 1:
            return round($size / 1024, $precision) . "KB";
        default:
            return round($size / 1024 ** 2, $precision) . "MB";
    }
}
 
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $upload_dir = "uploads/";

    if(!is_dir($upload_dir)) {
        mkdir("uploads", 0777, true);
    }

    foreach($_FILES['files']['name'] as $key => $file_name) {

        $file_tmp = $_FILES['files']['tmp_name'][$key];
        $file_size = $_FILES['files']['size'][$key];
        $file_error = $_FILES['files']['error'][$key];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $upload_dir . basename($file_name);

        $max_file_size = 2 * 1024 * 1024;
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'mp3', 'zip', 'pdf', 'wav'];

        switch($file_size) {
            case $file_size / 1024 < 1:
                echo "test";
        }

        if($file_error === UPLOAD_ERR_OK) {

            if($file_size >= $max_file_size) {
                echo "Error: File is too big (" . convert_size($file_size) . ").<br>";
                echo "Max " . convert_size($max_file_size) . " allowed.";
            }

            else if(!in_array($file_type, $allowed_types)) {
                echo "Error: File type $file_type is not allowed.<br>";
            }

            else {
                if(move_uploaded_file($file_tmp, $target_file)) {
                    echo "File $file_name uploaded succesfully.<br>";
                } else {
                    echo "Erorr: There was a time issue uploading $file_name.<br>";
                }
                
            }

        } else {
            echo "Error: File $file_name failed to upload due to an error $file_error<br>";
        }
    }
} else {
    echo "No files were uploaded.";
}