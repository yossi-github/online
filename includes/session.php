<?php
session_start();

function message(){
  if(isset($_SESSION["msg"])){
    $msg = "<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">";
    $msg .= "<strong>Message:</strong> ";
    $msg .= htmlentities($_SESSION["msg"]);
    $msg .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
    $msg .=  "<span aria-hidden=\"true\">&times;</span>";
    $msg .= "</button>";
    $msg .= "</div>";

    // Clear Message from session after use
    $_SESSION["msg"] = null;

  }else{
    $msg = null;
  }
  return $msg;
}


function show_error() {
  $output = "";
  if(isset($_SESSION["error"])) {
    $output .= "<div class=\"erros\">";
    $output .= "<ul>";
    //$_SESSION["error"]  its the globsl error array from validtaion_functions.php
    foreach ($_SESSION["error"] as $key => $value) {
      $output .= "<li class=\"alert alert-danger alert-dismissible fade show\"  role=\"alert\">" . $key . " " . $value . "<br />";
      $output .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">";
      $output .=  "<span aria-hidden=\"true\">&times;</span>";
      $output .= "</button>";
      $output .= "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
    //Clear error session after use
    $_SESSION["error"] = null;
  }
  return $output;
}

 ?>
