<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php is_loggedin(); ?>

<?php
if(isset($_POST["submit"])){
  $username = $_POST["userName"];
  $hashed_pass = password_hash($_POST["password"],PASSWORD_BCRYPT);
  $first_name = $_POST["firstName"];
  $email = $_POST["email"];

  // Escape the strings  so it safe for our DB
  $username = mysqli_real_escape_string($conn,$username);
  $first_name = mysqli_real_escape_string($conn,$first_name);
  $email = mysqli_real_escape_string($conn,$email);

  //valdtion
  $require_empty_fields = array("userName","password","firstName","email");
  check_empty_fields($require_empty_fields);
  $require_min_fields = array("userName" => 2,"password" => 4,"firstName" => 2,"email" => 4);
  check_min_fileds($require_min_fields);
  check_email($email);

  if(!empty($errorAry)) {
    $_SESSION["error"] = $errorAry;
    redirect("admin.php");
  }

  // Perform Query
    $query = "INSERT INTO admins (";
    $query .="username,hashed_pass,first_name,email";
    $query .=") VALUES (";
    $query .="'{$username}','{$hashed_pass}','{$first_name}','{$email}'";
    $query .=")";


    $result_new_admin = mysqli_query($conn,$query);

    if($result_new_admin && mysqli_affected_rows($conn) === 1){
      // Query successedd
      //Message about that new admin created
      $_SESSION["msg"] = "New admin {$first_name} was created successfuly ";
        redirect("admin.php");
    }else{
      // Query faield
      //Message about that the new category faield
      $_SESSION["msg"] = "Error: Create admin Failed.";
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
