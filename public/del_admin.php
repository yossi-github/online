<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php is_loggedin(); ?>


<?php
// Check if admin id was sent via get and then check if the admin exist
if(isset($_GET["id"])&&get_admin_by_id($_GET["id"])){
  $admin = get_admin_by_id($_GET["id"]);
}else{
  $_SESSION["msg"] = "Not valid admin id";
  redirect("manage_admins.php");
}

$query = "DELETE FROM admins WHERE id = {$admin["id"]}
LIMIT 1";
$result_del_admin = mysqli_query($conn,$query);

if($result_del_admin && mysqli_affected_rows($conn) === 1){
    $_SESSION["msg"] = "The admin {$admin["username"]} was Deleted successfuly";
    redirect("manage_admins.php");
}else{
  $_SESSION["msg"] = "The admin {$admin["username"]} Delete operation was Failed";
  redirect("manage_admins.php");
}

?>
<?php include("../includes/layouts/admin_footer.php");?>
