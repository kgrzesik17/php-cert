<?php

$old_name = "data.txt";
$new_name = "new_data.txt";

if(file_exists($old_name)) {
  rename($old_name, $new_name);
  echo "$old_name renamed to $new_name!";
} else {
  echo "File $old_file doesn't exist";
}