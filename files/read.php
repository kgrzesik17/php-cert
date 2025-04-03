<?php

$file_name = "data.txt";

$content = file_get_contents($file_name);

echo nl2br($content);