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
  <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../../css/bootstrap/bootstrap-tokenfield.min.css">
  <link rel="stylesheet" href="../../css/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="../../css/fa/fontawesome-all.css">
  <title>Admin control panel</title>
</head>
<body>
  <div class="container-fluid fullvh">
    <div class="fullvh fixed left-navbar" id="left-navbar">
      <div class="inner-button d-flex align-items-center bg-light">
        <a id="bar-toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul id="dropdown">
        <li>
          <a href="profile.php" class='nav-item'>
            <span class="lb-icon"><i class="fa fa-tachometer-alt"></i></span><span>DashBoard</span>
          </a>
        </li>
        <li>
          <a href="#collapse1" data-toggle="collapse" data-parent="#dropdown" class='nav-item'><span class="lb-icon"><i class="fa fa-file-alt"></i></span><span>Articles</span><span class="lb-dropdown"><i class="fa fa-chevron-down"></i></span></a>
          <ul class="collapse customCollapse" id="collapse1">
            <li><a href="profile.php?articles"><span class="lb-icon"><i class="fa fa-plus"></i></span><span>Add</span></a></li>
          </ul>
        </li>
        <li>
          <a href="#collapse2" data-toggle="collapse" data-parent="#dropdown" class='nav-item'><span class="lb-icon"><i class="fa fa-columns"></i></span><span>Tables</span><span class="lb-dropdown"><i class="fa fa-chevron-down"></i></span></a>
          <ul class="collapse customCollapse" id="collapse2">
            <li><a href="profile.php?tables&u"><span class="lb-icon"><i class="far fa-user"></i></span><span>Users</span></a></li>
            <li><a href="profile.php?tables&a"><span class="lb-icon"><i class="far fa-file-alt"></i></span><span>Articles</span></a></li>
            <li><a href="profile.php?tables&c"><span class="lb-icon"><i class="far fa-comments"></i></span><span>Comments</span></a></li>
            <li><a href="profile.php?tables&t"><span class="lb-icon"><i class="far fa-list-alt"></i></span><span>Topics</span></a></li>
            <li><a href="profile.php?tables&ta"><span class="lb-icon"><i class="fa fa-tags"></i></span><span>Tags</span></a></li>
          </ul>
        </li>
        <li>
          <a href="profile.php?config" class='nav-item'>
            <span class="lb-icon"><i class="fa fa-wrench"></i></span><span>Config</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="row main" id="content">
      <div class="col color1">
        <div class="row content-footer">
          <div class="col-md-12 content">
            <div class="row">
              <div class="bg-light d-flex justify-content-end container-fluid top-bar">
                <a class="btn text-dark" href="logout.php">Log out</a>
              </div>
            </div>
            <div class="row">
              <div class="container-fluid">
                <?php
                  include "controller/admincp-profile.controller.php";
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <footer class="page-footer font-small bg-light pt-4 col-md-12">
            <div class="container-fluid text-center text-md-left">
              <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                  <h5 class="text-uppercase">Footer Content</h5>
                  <p>Here you can use rows and columns here to organize your footer content.</p>
                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-6 mb-md-0 mb-3">
                  <h5 class="text-uppercase">Links</h5>
                  <ul class="list-unstyled">
                    <li>
                      <a class="text-dark" href="#!">Link 1</a>
                    </li>
                    <li>
                      <a class="text-dark" href="#!">Link 2</a>
                    </li>
                    <li>
                      <a class="text-dark" href="#!">Link 3</a>
                    </li>
                    <li>
                      <a class="text-dark" href="#!">Link 4</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="footer-copyright text-center py-3">2018 © Copyright</div>
          </footer>
        </div>
      </div>
    </div>
  </div>

  <!--Bootstrap and jquery js-->
  <script src="../../js/jquery/jquery-3.3.1.min.js"></script>
  <script src="../../js/jquery/jquery-ui.min.js"></script>
  <script src="../../js/jquery/jquery.canvasjs.min.js"></script>
  <script src="../../js/bootstrap/bootstrap.min.js"></script>
  <script src="../../js/bootstrap/bootstrap-tokenfield.js"></script>
  <script src="../../js/bootstrap/bootstrap-tokenfield.min.js"></script>
  <script type="text/javascript" src="../../js/cp-profile.js"></script>
  <script type="text/javascript" src="../../js/cp-editor.js"></script>
  <script type="text/javascript" src="../../js/cp-dashboard.js"></script>
  <script type="text/javascript" src="../../js/js-utils.js"></script>
</body>
</html>
