<?php
define("DS",DIRECTORY_SEPARATOR); // / or \ windows or linux(unix)

define("LOG",__DIR__ . DS. "log" .DS. "log.txt");


function create_log() {
  // Just for Exercirs to work abit with  I/O
  // Take the first name from the session
  $timeStamp = strftime("%Y-%m-%d %H:%M:%S",time());

  $content = "{$_SESSION["admin_firstName"]} || {$timeStamp} \n";
  file_put_contents(LOG,$content,FILE_APPEND);
}

function read_log() {
  if(file_get_contents(LOG)){
    return nl2br(file_get_contents(LOG));
  }

}


?>
