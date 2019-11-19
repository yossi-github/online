<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php include("../includes/layouts/admin_navigation.php"); ?>
<?php include("../includes/layouts/admin_header.php"); ?>
<?php  is_loggedin(); ?>



<?php
get_selected_page(false);
if(!$current_category){
  $_SESSION["msg"] = "Not valid category ";
    redirect("manage_content.php");
}
?>

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
  $require_min_fields = array("catName" => 3,"catPosition" => 1,"catVisible" => 1);
  check_min_fileds($require_min_fields);


  if(!empty($errorAry)) {
    $_SESSION["error"] = $errorAry;
    redirect("edit_page.php?category={$current_category["id"]}");
  }
  // Perform Query
    $query = "UPDATE categories SET ";
    $query .= "cat_name = '{$cat_name}' , position = '{$cat_position}' , visible = '{$cat_visible}' ";
    $query.="WHERE id={$current_category["id"]} ";
    $query.="LIMIT 1";


    $result_edit_category = mysqli_query($conn,$query);

    if($result_edit_category && mysqli_affected_rows($conn) >= 0){
      // Query successedd
      //Message about that new category created
      $_SESSION["msg"] = "Category {$current_category["cat_name"]} was Updated successfuly ";
        redirect("manage_content.php");
    }else{
      // Query faield
      $_SESSION["msg"] = "Error: Update Category Failed.";
        redirect("manage_content.php");
    }


}else{ //Show form ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <?php echo show_error(); ?>
        <div class="card">
          <div class="card-header">
            <h2>Edit Category - <?php echo $current_category["cat_name"]; ?></h2>
          </div>
        <div class="card-body">
          <form action="edit_category.php?category=<?php echo $current_category["id"]?>" method="post" class="action">
            <div class="form-group">
              <label for="nameCat">Category Name</label>
              <input name="catName" value="<?php echo $current_category["cat_name"]; ?>" class="form-control"  type="text" id="nameCat">
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="catVisible" id="visibleCat1" value="1" <?php if($current_category["visible"] == 1){echo " checked";} ?> >
              <label class="form-check-label" for="visibleCat1">
                Public(visible)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="catVisible" id="visibleCat2" value="0" <?php if($current_category["visible"] == 0){echo " checked";} ?> >
              <label class="form-check-label" for="visibleCat2">
                Not Visible
              </label>
            </div>

            <div class="form-group">
              <label for="orderCat">Postion</label>
              <select name="catPosition" class="form-control" id="orderCat">
                <?php
                $categories_set = get_all_categories();
                $categories_count = mysqli_num_rows($categories_set);
                for ($count=1; $count <= $categories_count; $count++) {
                    echo "<option value=\"{$count}\"";
                    if($current_category["position"] == $count) {
                    echo " selected";
                  }
                    echo ">{$count}</option>";
                }
                  mysqli_free_result($categories_set);
                ?>
              </select>
              <small class="form-text text-muted">Order the categories as you like!</small>
            </div>
            <div class="card-footer">
              <a class="btn btn-secondary" href="manage_content.php">Cancel</a>
              <input name="submit" class="btn btn-success " type="submit" value="Edit Category">
              <a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="del_category.php?category=<?php echo $current_category["id"]; ?>">Delete </a>
            </div>
          </form>
        </div>

        </div>
      </div>
    </div>
  </div>



<?php } ?>




 <?php include("../includes/layouts/admin_footer.php");?>
