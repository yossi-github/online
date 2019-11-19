<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once("../includes/layouts/header.php"); ?>




<?php

get_selected_page();
//After get_selected_page runs we have accsess to the
// current_page global variable which holds assoc array of the spesifc page

include_once("../includes/layouts/navigation.php");

?>


    <!-- Main Section  -->

    <section id="main" class="mt-5">
      <div class="container">
        <div class="row">
          <div class="col">
              <div class="card text-center">
                  <div class="card-header bg-info">
                        <h2><?php echo isset($current_page) ?  $current_page["page_name"] : "Please choose a page"; ?></h2>
                    </div>
                    <div class="card-body">
                      <p>
                        <?php echo $current_page["content"]; ?>
                      </p>
                      </div>
                </div>
            </div>
          </div>
        </div>
      </section>

      <?php include_once("../includes/layouts/footer.php"); ?>
