<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php include("../includes/layouts/admin_navigation.php"); ?>
<?php include("../includes/layouts/admin_header.php"); ?>
<?php  is_loggedin(); ?>



<?php
// Check if admin id was sent via get and then check if the admin exist
if(isset($_GET["id"])&&get_admin_by_id($_GET["id"])){
  $admin =  get_admin_by_id($_GET["id"]);
}else{
  $_SESSION["msg"] = "Not valid admin id";
  redirect("manage_admins.php");
}
?>

<?php
echo show_error();


if(isset($_POST["submit"])) {
  $username = $_POST["userName"];
  $hashed_pass = $_POST["password"];
  $first_name = $_POST["firstName"];
  $email = $_POST["email"];

  // Escape the strings  so it safe for our DB
  $username = mysqli_real_escape_string($conn,$username);
  $first_name = mysqli_real_escape_string($conn,$first_name);
  $email = mysqli_real_escape_string($conn,$email);

  //valdtion
  $require_empty_fields = array("userName","password","firstName","email");
  check_empty_fields($require_empty_fields);
  $require_min_fields = array("userName" => 2,"password" => 5,"firstName" => 2,"email" => 4);
  check_min_fileds($require_min_fields);
  check_email($email);



if(!empty($errorAry)) {
  $_SESSION["error"] = $errorAry;
  redirect("edit_admin.php?id={$admin["id"]}");
}


// Perform Query
  $query = "UPDATE admins SET ";
  $query .= "username = '{$username}' , hashed_pass = '{$hashed_pass}' , first_name = '{$first_name}' , email = '{$email}' ";
  $query.="WHERE id={$admin["id"]}";


  $result_admins = mysqli_query($conn,$query);

  if($result_admins && mysqli_affected_rows($conn) >= 0){
      $_SESSION["msg"] = "The admin {$username} was updated successfuly";
      redirect("manage_admins.php");
  }else{
    $_SESSION["msg"] = "The admin {$username} update operation was Failed";
    redirect("manage_admins.php");
  }

} // END OF ISSET SUBMIT....

  ?>



  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
              <h1>Edit Admin - <?php echo $admin["username"]; ?></h1>
          </div>

          <div class="card-body">
            <form action="edit_admin.php?id=<?php echo $admin["id"]; ?>" method="post">
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input name="firstName" value="<?php echo $admin["first_name"]; ?>" class="form-control" type="text" id="firstName">
              </div>
              <div class="form-group">
                <label for="userName">User Name</label>
                <input name="userName" value="<?php echo $admin["username"]; ?>" class="form-control" type="text" id="userName">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input name="password" value="<?php echo $admin["hashed_pass"]; ?>" class="form-control" type="password" id="password">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input name="email" value="<?php echo $admin["email"]; ?>" class="form-control" type="email" id="email">
              </div>
              <div class="card-footer">
                <a href="manage_admins.php" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-warning" name="submit" type="submit">Edit User</button>
              </div>
            </form>

          </div>

        </div> <!-- Close Card -->
      </div>
    </div>
  </div>








<?php include("../includes/layouts/admin_footer.php");?>
