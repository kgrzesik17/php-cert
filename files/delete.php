<?php

$file_name = "new_data.txt";

if(file_exists($file_name)) {
  unlink($file_name);
  echo "File $file_name has been deleted.";
} else {
  echo "File $file_name doest not exist.";
}