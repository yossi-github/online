<?php
$file = "login.txt";
// Using file put and get content
// Write Data


$timeStamp = strftime("%Y-%m-%d %H:%M:%S",time());
// echo $timeStamp;

$content = "Username | {$timeStamp} \n";
file_put_contents($file,$content,FILE_APPEND);

// Read Data
$contentFile =  file_get_contents($file);
echo nl2br($contentFile);

// Delete File
// unlink($file);

?>
