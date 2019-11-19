<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php is_loggedin(); ?>


<?php
if(isset($_POST["submit"])){
  $cat_id = (int) $_POST["catId"];
  $page_name = $_POST["pageName"];
  $contentPage = $_POST["editorContent"];
  $position = 0;
  $visible = $_POST["pageVisible"];

  // Escape the strings  so it safe for our DB
  $contentPage = mysqli_real_escape_string($conn,$contentPage);
  $page_name = mysqli_real_escape_string($conn,$page_name);

  //valdtion
  $require_empty_fields = array("catId","pageName","editorContent","pageVisible");
  check_empty_fields($require_empty_fields);
  $require_min_fields = array("catId" => 1,"pageName" => 3,"editorContent" => 3,"pageVisible" => 1);
  check_min_fileds($require_min_fields);


if(!empty($errorAry)) {
  $_SESSION["error"] = $errorAry;
  redirect("admin.php");
}
  // Perform Query
    $query = "INSERT INTO pages (";
    $query .="cat_id,page_name,content,position,visible";
    $query .=") VALUES (";
    $query .="'{$cat_id}','{$page_name}','{$contentPage}','{$position}','{$visible}'";
    $query .=")";
    $result_new_page = mysqli_query($conn,$query);

    if($result_new_page && mysqli_affected_rows($conn) === 1){
      // Query successedd
      // echo "succedd";
        $_SESSION["msg"] = "New page {$page_name} was created successfuly ";
        redirect("admin.php");
    }else{
      // Query faield
      $_SESSION["msg"] = "Error: Create page Failed.";
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
