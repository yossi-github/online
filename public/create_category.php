<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php is_loggedin(); ?>

<?php
if(isset($_POST["submit"])){
  $cat_name = $_POST["catName"];
  $cat_position = (int) $_POST["catPosition"];
  $cat_visible  =  (int)  $_POST["catVisible"];

  // Escape the category name so it safe for our DB
  $cat_name = mysqli_real_escape_string($conn,$cat_name);

  //valdtion
  $require_empty_fields = array("catName","catPosition","catVisible");
  check_empty_fields($require_empty_fields);
  $require_min_fields = array("catName" => 2,"catPosition" => 1,"catVisible" => 1);
  check_min_fileds($require_min_fields);

  if(!empty($errorAry)) {
    $_SESSION["error"] = $errorAry;
    redirect("admin.php");
  }
  // Perform Query
    $query = "INSERT INTO categories (";
    $query .="cat_name,position,visible";
    $query .=") VALUES (";
    $query .="'{$cat_name}','{$cat_position}','{$cat_visible}'";
    $query .=")";

    $result_new_category = mysqli_query($conn,$query);

    if($result_new_category && mysqli_affected_rows($conn) === 1){
      // Query successedd
      //Message about that new category created
      $_SESSION["msg"] = "New Category {$cat_name} was created successfuly ";
        redirect("admin.php");
    }else{
      // Query faield
      $_SESSION["msg"] = "Error: Create Category Failed.";
        redirect("admin.php");
    }


}else{
  // Not a post request
  redirect("index.php");
}

  if(isset($conn)){
  mysqli_close($conn);
  }
 ?>
