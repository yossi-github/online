<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
get_selected_page(false);
//After get_selected_page runs we have accsess to the
// current_page global variable which holds assoc array of the spesifc page
?>

<?php include("../includes/layouts/admin_navigation.php"); ?>
<?php include("../includes/layouts/admin_header.php"); ?>
<?php include("../includes/layouts/admin_manage_navigation.php"); ?>
<?php is_loggedin(); ?>



<?php echo message(); ?>
<?php echo show_error(); ?>


<!-- Main Section  -->

<section id="main" class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col">
          <div class="card text-center">
              <div class="card-header bg-info">
                    <h2><?php if($current_page){
                      echo $current_page["page_name"];
                    }elseif($current_category){
                      echo $current_category["cat_name"];
                    } ?></h2>
                </div>
                <div class="card-body">
                  <?php if($current_page){?>
               <p>
                 position:<?php echo  $current_page["position"] ?>
                 <br/>
                visible:  <?php echo  $current_page["visible"]==1? "public": "privet"; ?>
              </p>
                <div class="card-body border border-danger">
                   Content:
                   <?php echo ($current_page["content"]); ?>
                 </div>
                <div class="card-footer">
                   <a class="btn btn-primary" href="edit_page.php?page=<?php echo $current_page["id"] ?>">
                     Edit Page
                   </a>
                 </div>
                   </div>
                  <?php }elseif($current_category){?>
                   <div class="card-body">
             <p>
                position:  <?php echo  $current_category["position"] ?>
                <br/>
                visible: <?php echo  $current_category["visible"]==1? "public": "privet"; ?>
              </p>
                <div class="card-footer">
                    <a class="btn btn-primary" href="edit_category.php?category=<?php echo $current_category["id"] ?>">
                      Edit category
                    </a>
                  </div>
              <?php }else{ ?>
            <div class="card-header bg-info">
              <h2><?php echo "Please choose Category / Page " ;?></h2>
            </div>
        <?php  } ?>


                </div>

            </div>
        </div>
      </div>
    </div>
  </section>

<?php include_once("../includes/layouts/admin_footer.php"); ?>
