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
  <div class="container-fluid">
    <div class="fullvh fixed left-navbar" id="left-navbar">
      <div class="inner-button d-flex align-items-center">
        <a id="bar-toggle"><i class="fa fa-bars text-white"></i></a>
      </div>
      <ul>
        <li>
          <a href="profile.php">
            <span><i class="fa fa-tachometer-alt"></i></span><span>DashBoard</span>
          </a>
        </li>
        <li>
          <a href="">
            <span><i class="fa fa-file-alt"></i></span><span>Articles</span><span><i class="fa fa-chevron-down"></i></span>
          </a>
          <ul class="collapse">
            <li><a href="profile.php?articles">Add new Article</a></li>
            <li><a href="profile.php?articles">Remove Article</a></li>
          </ul>
        </li>
        <li>
          <a href="profile.php?tables">
            <span><i class="fa fa-columns"></i></span><span>Tables</span><span><i class="fa fa-chevron-down"></i></span>
          </a>
          <ul class="collapse">
            <li><a href="profile.php?tables&u">Users</a></li>
            <li><a href="profile.php?tables&a">Articles</a></li>
            <li><a href="profile.php?tables&c">Comments</a></li>
            <li><a href="profile.php?tables&t">Topics</a></li>
            <li><a href="profile.php?tables&l">Likes</a></li>
            <li><a href="profile.php?tables&ta">Tags</a></li>
          </ul>
        </li>
        <li>
          <a href="profile.php?config">
            <span><i class="fa fa-wrench"></i></span><span>Config</span><span><i class="fa fa-chevron-down"></i></span>
          </a>
          <ul class="collapse">
            <li><a href="profile.php?config">Manage Main Page</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="row main" id="content">
      <section class="col color1">
        <div class="row content-footer">
          <div class="col-md-12">
            <div class="row">
              <div class="bg-dark d-flex justify-content-end container-fluid">
                <a class="btn text-white" href="logout.php">Log out</a>
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
          <footer class="page-footer font-small bg-dark pt-4 mt-4 col-md-12">
            <div class="container-fluid text-center text-md-left">
              <div class="row">
                <div class="col-md-6 mt-md-0 mt-3 text-white">
                  <h5 class="text-uppercase">Footer Content</h5>
                  <p>Here you can use rows and columns here to organize your footer content.</p>
                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-6 mb-md-0 mb-3 text-white">
                  <h5 class="text-uppercase">Links</h5>
                  <ul class="list-unstyled">
                    <li>
                      <a href="#!">Link 1</a>
                    </li>
                    <li>
                      <a href="#!">Link 2</a>
                    </li>
                    <li>
                      <a href="#!">Link 3</a>
                    </li>
                    <li>
                      <a href="#!">Link 4</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="footer-copyright text-center py-3">2018 © Copyright</div>
          </footer>
        </div>
      </section>
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
