<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/admin_header.php"); ?>
<?php is_loggedin(); ?>


<?php
get_selected_page(false);
if(!$current_category){
  $_SESSION["msg"] = "Not valid category ";
    $_SESSION["msg"] = "Not valid category ";
      redirect("manage_content.php");
}

$result_page=get_pages_of($current_category["id"]);
if( mysqli_num_rows($result_page)>0){
  $_SESSION["msg"] = "Category can't be delted with pages ";
 redirect("manage_content.php?category={$current_category["id"]}");
}

$query = "DELETE FROM categories WHERE id = {$_GET["category"]}
LIMIT 1";
$result_del_cat = mysqli_query($conn,$query);

if($result_del_cat && mysqli_affected_rows($conn) === 1){
    $_SESSION["msg"] = "The Category {$current_category["cat_name"]} was Deleted successfuly";
    redirect("manage_content.php");
}else{
  $_SESSION["msg"] = "The Category {$current_category["cat_name"]} Delete operation was Failed";
  redirect("manage_content.php");
}

?>
<?php include("../includes/layouts/admin_footer.php");?>
