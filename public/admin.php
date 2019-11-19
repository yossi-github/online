<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include_once("../includes/layouts/admin_navigation.php"); ?>
<?php include_once("../includes/layouts/admin_header.php"); ?>
<?php is_loggedin(); ?>
    <!-- Main Section  -->
    <?php echo message(); ?>
    <?php echo show_error(); ?>
    <section id="adminActions" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPageModal">
              <i class="fa fa-plus"></i>
              Add pages
             </a>
          </div>
          <div class="col-md-4">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addCatModal">
              <i class="fa fa-plus"></i>
              Add category
             </a>
          </div>
          <div class="col-md-4">
            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addUserModal">
              <i class="fa fa-plus"></i>
              Add Admin
             </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Modals -->


    <!-- Add Pages modal -->
      <div class="modal fade" id="addPageModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title">Add new page</h5>
              <button class="close" data-dismiss="modal">
                 <span>&times;</span>
               </button>
            </div>
            <div class="modal-body">
                <form id="create-page" action="create_page.php" method="post" class="action">
                  <div class="form-group">
                    <label for="pageName">Page Title</label>
                    <input name="pageName" class="form-control" type="text" id="pageName">
                  </div>
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select name="catId" class="form-control" id="category">
                        <?php $categories_set = get_all_categories();  ?>
                      <?php
                          while ($category = mysqli_fetch_assoc($categories_set)) {
                              echo "<option value=\"{$category["id"]}\">" . $category["cat_name"] . "</option>";
                          }
                          mysqli_free_result($categories_set);
                          ?>
                    </select>
                    <small class="form-text text-muted">Choose Category for the page</small>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="pageVisible" id="visiblePage1" value="1" checked>
                    <label class="form-check-label" for="visiblePage1">
                      Public(visible)
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="pageVisible" id="visiblePage2" value="0">
                    <label class="form-check-label" for="visiblePage2">
                      Not Visible
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="editor">Content</label>
                    <textarea  name="editorContent" id="editor">

                    </textarea>
                    <small class="form-text text-muted">Write Some Good Content!</small>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submit">Create Page</button>
                  </div>
                </form>
              </div>
          </div>
        </div>

      </div>

      <!-- Category Create Modal  -->

      <div class="modal fade" id="addCatModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="create_category.php" method="post" class="action">
                <div class="form-group">
                  <label for="nameCat">Category Name</label>
                  <input name="catName" class="form-control" type="text" id="nameCat">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="catVisible" id="visibleCat1" value="1" checked>
                  <label class="form-check-label" for="visibleCat1">
                    Public(visible)
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="catVisible" id="visibleCat2" value="0">
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
                    for ($count=1; $count <= $categories_count +1 ; $count++) {
                        echo "<option value=\"{$count}\">" . $count . "</option>";
                    }
                      mysqli_free_result($categories_set);
                    ?>
                  </select>
                  <small class="form-text text-muted">Order the pages as you like!</small>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input name="submit" class="btn btn-success" type="submit" value="Create Category">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Admin Create Modal  -->

      <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="create_admin.php" method="post">
                <div class="form-group">
                  <label for="firstName">First Name</label>
                  <input name="firstName" class="form-control" type="text" id="firstName">
                </div>
                <div class="form-group">
                  <label for="userName">User Name</label>
                  <input name="userName" class="form-control" type="text" id="userName">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input name="password" class="form-control" type="password" id="password">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input name="email" class="form-control" type="email" id="email">
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-warning" name="submit" type="submit">Create Admin</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

            <?php include_once("../includes/layouts/admin_footer.php"); ?>

      <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>
