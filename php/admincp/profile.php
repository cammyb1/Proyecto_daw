<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Jonathan Vasquez Morales">
  <meta name="description" content="Pagina cultural del imperio incaico">
  <meta name="keywords" content="HTML,CSS,JavaScript,Inca,Imperio,Cultura">
  <link rel="shortcut icon" href="../../resources/logo.png">
  <link rel="stylesheet" type="text/css" href="../../css/main_style.css">
  <link rel="stylesheet" type="text/css" href="../../css/admincp/admin-profile.css">
  <script type="text/javascript" src="../../js/cp-profile.js"></script>
  <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
  <title>Admin control panel</title>
</head>
<body>
  <div class="row">
    <div class="col-md-2 fullvh">
      <div class="container">
        <div class="row">
          <h1>Dashboard</h1>
        </div>
        <div>
          <ul>
            <li><a class="btn btn-primary" href="profile.php?dash">DashBoard</a></li>
            <li>
              <a class="btn btn-primary" href="profile.php?articles">Articles</a>
              <ul>
                <li><a href="profile.php?articles">Add new Article</a></li>
                <li><a href="profile.php?articles">Remove Article</a></li>
              </ul>
            </li>
            <li>
              <a class="btn btn-primary" href="profile.php?tables">Tables</a>
              <ul>
                <li><a href="profile.php?tables&u">Users</a></li>
                <li><a href="profile.php?tables&a">Articles</a></li>
                <li><a href="profile.php?tables&c">Comments</a></li>
                <li><a href="profile.php?tables&i">Images</a></li>
              </ul>
            </li>
            <li>
              <a class="btn btn-primary" href="profile.php?config">Config</a>
              <ul>
                <li><a href="profile.php?config">Manage Main Page</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <section class="col-md-10 color1">
      <?php
        include "controller/admincp-profile.controller.php";
      ?>
    </section>
  </div>
  <!--Bootstrap and jquery js-->
  <script src="../../js/jquery/jquery-3.3.1.min.js"></script>
  <script src="../../js/bootstrap/bootstrap.min.js"></script>
</body>
</html>
