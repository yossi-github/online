<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/log_functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php get_selected_page(); ?>
<?php include("../includes/layouts/navigation.php"); ?>


<?php
echo message();
echo show_error();

$username = "";

if(isset($_POST["submit"])) {
  $username = $_POST["userName"];
  $user_pass = $_POST["password"];

  //valdtion
  $require_empty_fields = array("password","userName");
  check_empty_fields($require_empty_fields);
  $require_min_fields = array("userName" => 2,"password" => 5);
  check_min_fileds($require_min_fields);

  if(empty($errorAry)) {
    // Attempt to login
    $found_admin = login($username,$user_pass);
    if($found_admin){
      //successedd
      $_SESSION["admin_id"] = $found_admin["id"];
      $_SESSION["admin_firstName"] = $found_admin["first_name"];
      $_SESSION["msg"] = "Welecome {$_SESSION["admin_firstName"]}";
      create_log();
      redirect("admin.php");

    }else{
      //Incorrect combination username / password
      $_SESSION["msg"] = "Username / Password incorrect";
      redirect("login.php");
    }

  }else{
  $_SESSION["error"] = $errorAry;
  redirect("login.php");
  }

}


  ?>

  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
              <h1>Login</h1>
          </div>

          <div class="card-body">
            <form action="login.php" method="post">
              <div class="form-group">
                <label for="userName">User Name</label>
                <input name="userName"  class="form-control" value="<?php echo htmlentities($username); ?>" type="text" id="userName">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input name="password"  class="form-control" type="password" id="password">
              </div>
              <div class="card-footer">
                <button class="btn btn-warning" name="submit" type="submit">Login</button>
              </div>
            </form>

          </div>

        </div> <!-- Close Card -->
      </div>
    </div>
  </div>









<?php  include("../includes/layouts/footer.php"); ?>
