<!-- Navigation  -->

<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-3">
  <a class="navbar-brand" href="admin.php">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="collapse navbar-collapse" id="navMenu">
    <ul class="navbar-nav">
      <?php
     //static navigation  not from db
      $navItems = [
        "Home"=>"index.php",
        "Manage Content"=>"Manage_Content.php",
        "Manage Admins"=>"Manage_Admins.php"
      ];
      foreach($navItems as $navItem => $navlink) {
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link\" href=\"{$navlink}\">";
        echo $navItem;
        echo "</a></li>";
      }
       ?>

    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item px2 dropdown">
        <a href-"#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-user">Welcome yossi</i>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">
            <i class=" fa fa-user-circle">profile</i>
          </a>
          <a class="dropdown-item" href="#">
            <i class=" fa fa-cogs">settings</i>
          </a>
        </div>
      </li>
      <li class="nav-item px2">
        <a href="logout.php" class="nav-link">
          <i class="fa fa-times"> Logout</i>
        </a>
      </li>
    </ul>
  </div>
</nav>
