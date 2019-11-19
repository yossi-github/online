<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/log_functions.php"); ?>
<?php require_once("../includes/validtion_functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php get_selected_page(false); ?>
<?php include("../includes/layouts/navigation.php"); ?>
<?php is_loggedIn(); ?>


<?php
echo message();
echo show_error();
?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="jumbotron">
        <?php echo read_log() ?>
      </div>
    </div>
  </div>
</div>

<?php include_once("../includes/layouts/admin_footer.php"); ?>
