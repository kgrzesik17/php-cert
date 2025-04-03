<?php
$file_name = "data.txt";

// open the file

$file = fopen($file_name, 'w');

if($file) {
  fwrite($file, "EVERYTHING WAS REPLACED\n");
  fclose($file);
  echo "File written succesfully";
} else {
  echo "Unable to open file for some reason...";
}