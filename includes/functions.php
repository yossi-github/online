<?php
// Rediret function get a url and redirect
function redirect($new_url) {
    header("Location: " . $new_url);
    exit;
}

function query_result_check($result_set){
  global $conn;
  if(!$result_set){
    die("Db query failed :".mysqli_error($conn));
  }
}


function get_all_admins(){
  global $conn;
  $query = "SELECT * ";
  $query .= "FROM admins ";
  $query .= "ORDER BY first_name ASC ";

  $results_admins = mysqli_query($conn,$query);

  query_result_check($results_admins);

  return $results_admins;
}

function get_admin_by_id($admin_id){
  global $conn;
  $safe_admin_id = mysqli_real_escape_string($conn,$admin_id);

  $query = "SELECT * ";
  $query .= "FROM admins ";
  $query .= "WHERE id={$safe_admin_id} ";
  $query .= "LIMIT 1";

  $results_admins = mysqli_query($conn,$query);
  query_result_check($results_admins);

  if($admin =  mysqli_fetch_assoc($results_admins)){
    return $admin;
  }else{
    return null;
  }

}

function get_admin_by_userName($username){
  global $conn;
  $safe_admin_userName = mysqli_real_escape_string($conn,$username);

  $query = "SELECT * ";
  $query .= "FROM admins ";
  $query .= "WHERE username='{$safe_admin_userName}' ";
  $query .= "LIMIT 1";
  $results_admins = mysqli_query($conn,$query);
  query_result_check($results_admins);

  if($admin =  mysqli_fetch_assoc($results_admins)){
    return $admin;
  }else{
    return null;
  }
}

function get_all_categories($public=true){
  global $conn;
  $query = "SELECT * ";
  $query .= "FROM categories ";
  if ($public){
    $query .= "WHERE visible = 1 ";
  }
  $query .= "ORDER BY position ASC ";
  $results_cats = mysqli_query($conn,$query);
  query_result_check($results_cats);

  return $results_cats;
}


function get_category_by_id($cat_id){
  global $conn;
  $safe_category_id = mysqli_real_escape_string($conn,$cat_id);

  $query = "SELECT * ";
  $query .= "FROM categories ";
  $query .= "WHERE id = {$safe_category_id} ";
  $query .= "LIMIT 1";
  $results_cats = mysqli_query($conn,$query);
  query_result_check($results_cats);
  if($category =  mysqli_fetch_assoc($results_cats)){
    return $category;
  }else{
    return null;
  }
}

function get_pages_of($cat_id,$public=true) {
  global $conn;
  $query = "SELECT * ";
  $query .= "FROM pages ";
  $query .= "WHERE cat_id = {$cat_id} ";
  if ($public){
    $query .= "AND visible = 1 ";
  }
  $query .="ORDER BY position ASC";
  $pages_result = mysqli_query($conn,$query);
  query_result_check($pages_result);
  return $pages_result;
}


function get_page_by_id($page_id,$public=true){
  global $conn;
// page_id comes from get request

  $safe_page_id = mysqli_real_escape_string($conn,$page_id);

  $query = "SELECT * ";
  $query .= "FROM pages ";
  $query .= "WHERE id = {$safe_page_id} ";
  if($public){
    $query .= "AND visible = 1 ";
  }
  $query .= "LIMIT 1";
  $page_result = mysqli_query($conn,$query);
  query_result_check($page_result);
  if($page =  mysqli_fetch_assoc($page_result)){
    return $page;
  }else{
    return null;
  }

}

function get_selected_page($public=true){
  global $current_page;
  global $current_category;

  if(isset($_GET["category"])){
    $current_category = get_category_by_id($_GET["category"]);
    $current_page = null;
  }elseif(isset($_GET["page"])){
    $current_page = get_page_by_id($_GET["page"],$public);
    $current_category = null;
  }else{
    $current_category = null;
    $current_page = null;
  }
}

//Attempt to login
function login($username,$user_pass) {
//Attempt to login
//Find the Admin in the database by username column
//Compare password from the DB With user Login
$admin = get_admin_by_userName($username);
  if($admin){
    //Found admin now cheking password
    if(password_verify($user_pass,$admin["hashed_pass"])){
      return $admin;
    }else{
      return false;
    }
  }else{
    //Admin not found on the DB
    return false;
  }
}

function loggedin(){
  return isset($_SESSION["admin_id"]);
}

function is_loggedin(){
  if(!loggedin()){
    $_SESSION["msg"] = "Please Login";
    redirect("login.php");
  }
}

 ?>
