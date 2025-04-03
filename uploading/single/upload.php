<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
  if($_FILES["file"]["error"] === 0) {
    $uploaddir = "uploads/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $uploaddir . $file_name;

    $file_size = $_FILES["file"]["size"];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed_types = ['jpg', 'jpeg', 'png', 'pdf', 'gif', 'wav', 'mp3'];

    // check file size
    if($file_size > 40 * 1024 * 1024) {  
      $file_err = "The file is too large ($file_size)";
    }  

    // check file type
    else if(!in_array($file_type, $allowed_types)) {
      $file_err = "$file_type files are not allowed<br>";
    }

    // if no errors, move the file to the target directory
    else {
      if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $fileErr = "Sorry, there was an error uploading the file";
      }
    }
    
  }
  
  // handle if file does not upload
  else {
    switch($_FILES["file"]["error"]) {
      case UPLOAD_ERR_INI_SIZE:
        $file_err = "The uploaded file exceeds the maximum size allowed by the server";
    }
  }

  if(empty($file_err)) {
    echo "The file has been uploaded";
  } else {
    echo $file_err . "<br>";
  }
} 
