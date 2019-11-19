<?php
$errorAry = array();

function check_empty_fields($fields_to_check){
  global $errorAry;
  foreach ($fields_to_check as $field_name) {
    $value = trim($_POST[$field_name]);
    if(is_empty($value)){
      $errorAry[$field_name] = "Cant be blank";
    }
  }
}



function check_min_fileds($fields_to_check){
  global $errorAry;
  foreach ($fields_to_check as $field_name => $min) {
    $value = trim($_POST[$field_name]);
    if(is_min($value,$min)){
      $errorAry[$field_name] = "too short Must be at least " .$min . " charcters";
    }
  }
}

function check_email($email){
  if(is_mailValid($email) === false){
      $errorAry["email"] = "Email Is not correct";
  }
}


function is_empty($input) {
  if(isset($input) && $input !== ""){
    return false;
  }else{
    return true;
  }
}


function is_min($input,$min = 5) {
  return strlen($input) < $min;
}

function is_mailValid($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}


 ?>
