<?php
$file_name = "data.txt";

// open the file

$file = fopen($file_name, 'a');

if($file) {
  fwrite($file, "HELLO I am a new paragraph\n");
  fclose($file);
  echo "File written succesfully";
} else {
  echo "Unable to open file for some reason...";
}