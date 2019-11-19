<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php is_loggedin(); ?>


<?php
//Check if page id is valid and exist using get_seleted_page
get_selected_page(); // from functions return $current_page global variable that return the value of get_page_by_id

if(!$current_page){
  $_SESSION["msg"] = "Not valid page ";
  redirect("manage_content.php");
}

$query = "DELETE FROM pages WHERE id = {$current_page["id"]}
LIMIT 1";
$result_del_page = mysqli_query($conn,$query);

if($result_del_page && mysqli_affected_rows($conn) === 1){
    $_SESSION["msg"] = "The Page {$current_page["page_name"]} was Deleted successfuly";
    redirect("manage_content.php");
}else{
  $_SESSION["msg"] = "The Page {$current_page["page_name"]} Delete operation was Failed";
  redirect("manage_content.php");
}


?>
