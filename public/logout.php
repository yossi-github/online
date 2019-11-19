<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if(isset($_SESSION["admin_id"])){
  $_SESSION["admin_id"] = null;
  $first_name =  $_SESSION["admin_firstName"];
  $_SESSION["first_name"] = null;

  $_SESSION["msg"] = "{$first_name} Logout Successfully hoping to see you soon again ";

  redirect("login.php");
}else{
  redirect("login.php");
}
 ?>
