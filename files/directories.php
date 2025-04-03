<?php

$dir = "uploads";

// creating directory

// if(!file_exists($dir)) {
//   mkdir($dir, 0777, true);
//   echo "Directory \"$dir\" created!";
// } else {
//   echo "Directory already exists.";
// }

if(is_dir($dir)) {
  $files = scandir($dir);

  foreach($files as $file) {
    if($file !== "." && $file !== "..") {
      echo "File: $file\n" . "<br>";
    }
  }
}