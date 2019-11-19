<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/admin_navigation.php"); ?>
<?php include("../includes/layouts/admin_header.php"); ?>
<?php is_loggedin(); ?>


<?php echo message();  ?>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>First name</th>
      <th>Username</th>
      <th>Email</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $result_admins = get_all_admins();
    while($admin = mysqli_fetch_assoc($result_admins)){
    $tableRow = "<tr>";
    $tableRow .= "<td>" . $admin["id"] . "</td>";
    $tableRow .= "<td>" . $admin["first_name"] . "</td>";
    $tableRow .= "<td>" . $admin["username"] . "</td>";
    $tableRow .= "<td>" . $admin["email"] . "</td>";
    $tableRow .= "<td>" . "<a href=\"edit_admin.php?id={$admin["id"]}\"> Edit </a>" . "</td>";
    $tableRow .= "<td>" . "<a onclick=\"return confirm('Are you sure?');\" href=\"del_admin.php?id={$admin["id"]}\"> &times; </a>" . "</td>";
    $tableRow .= "</tr>";
    echo $tableRow;
    }
    ?>
  </tbody>
</table>

<?php include("../includes/layouts/admin_footer.php");?>
