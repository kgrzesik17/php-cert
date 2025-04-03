<?php

$file_name = "data.txt";

if(file_exists($file_name)) {
  echo "File size: " . filesize($file_name) . 'bytes<br>';
  echo "Last modified: " . date("F d Y H:i:s.", filemtime($file_name)) . "<br>";

  if(is_readable($file_name)) {
    echo "It is readable.<br>";
  }

  if(is_writable($file_name)) {
    echo "It is writable.<br>";
  }
} else {
  echo "File $file_name does not exist.";
}