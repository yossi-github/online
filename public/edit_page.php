<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php include("../includes/layouts/admin_navigation.php"); ?>
<?php include("../includes/layouts/admin_header.php"); ?>
<?php is_loggedin(); ?>


<?php
 get_selected_page(false); // from functions return $current_page global variable that return the value of get_page_by_id

 if(!$current_page){
   $_SESSION["msg"] = "Not valid page ";
   redirect("manage_content.php");
 }

 if(isset($_POST["submit"])){
   //Edit Page
   //Process From

   $cat_id = (int) $_POST["catId"];
   $page_name = $_POST["pageName"];
   $contentPage = $_POST["editorContent"];
   $position = $_POST["pagePosition"];
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
     redirect("edit_page.php?page={$current_page["id"]}");
   }

   // Perform Query
     $query = "UPDATE pages SET ";
     $query .= "cat_id = '{$cat_id}' , ";
     $query .=  "page_name = '{$page_name}' , ";
     $query .= "content = '{$contentPage}' , ";
     $query .= "position =  '{$position}' , ";
     $query .=  "visible = '{$visible}'  ";
     $query.="WHERE id={$current_page["id"]} ";
     $query.="LIMIT 1";


     $result_edit_page = mysqli_query($conn,$query);

     if($result_edit_page && mysqli_affected_rows($conn) >= 0){
       // Query successedd
       //Message about that new category created
       $_SESSION["msg"] = "Page {$current_page["page_name"]} was Updated successfuly ";
         redirect("manage_content.php");
     }else{
       // Query faield
       $_SESSION["msg"] = "Error: Update Page Failed.";
         redirect("manage_content.php");
     }
 }


?>


<div class="container">
  <div class="row">
    <div class="col">
      <?php echo show_error(); ?>
      <div class="card">
        <div class="card-header text-center">
          <h3>  edit page: <?php echo $current_page["page_name"] ;?> </h3>
        </div>
        <div class="card-body">
        <form id="create-page" action="edit_page.php?page=<?php echo $current_page["id"]; ?>" method="post" class="action">
          <div class="form-group">
            <label for="pageName">Page Title</label>
            <input name="pageName"  value="<?php echo $current_page["page_name"] ;?>" class="form-control" type="text" id="pageName">
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select name="catId" class="form-control" id="category">
                <?php $categories_set = get_all_categories();  ?>
              <?php
                  while ($category = mysqli_fetch_assoc($categories_set)) {
                    echo "<option value=\"{$category["id"]}\"";
                    if($current_page["cat_id"] == $category["id"]) {
                    echo " selected";
                  }
                    echo ">{$category["cat_name"]}</option>";
                  }
                  mysqli_free_result($categories_set);
                  ?>
            </select>
            <small class="form-text text-muted">Choose Category for the page</small>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pageVisible" id="visiblePage1" value="1" <?php echo $current_page["visible"] == 1 ?  "checked" : null ?> >
            <label class="form-check-label" for="visiblePage1">
              Public(visible)
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pageVisible" id="visiblePage2" value="0" <?php echo $current_page["visible"] == 0 ?  "checked" : null ?>>
            <label class="form-check-label" for="visiblePage2">
              Not Visible
            </label>
          </div>
          <div class="form-group">
            <label for="editor">Content</label>
            <textarea  name="editorContent" id="editor">
                  <?php echo nl2br($current_page["content"]); ?>
            </textarea>
            <small class="form-text text-muted">Write Some Good Content!</small>
          </div>
            </div>
          <div class="card-footer">
            <a class="btn btn-secondary" href="manage_content.php">Cancel</a>
            <a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="del_page.php?page=<?php echo $current_page["id"]; ?>">Delete</a>
            <button class="btn btn-primary" type="submit" name="submit">Update Page</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<?php include_once("../includes/layouts/admin_footer.php"); ?>
