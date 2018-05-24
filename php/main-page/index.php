<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Jonathan Vasquez Morales">
  <meta name="description" content="Pagina cultural del imperio incaico">
    <meta name="keywords" content="HTML,CSS,JavaScript,Inca,Imperio,Cultura">
    <link rel="shortcut icon" href="resources/logo.png">
    <link rel="stylesheet" href="../../css/fa/fontawesome-all.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <title>Imperio inca</title>
  </head>
  <body>
    <div id="root">
      <header>
        <div class="container">
          <div class="logo">
            <div class="title">
              <!-- <img src="../resources/logo.png" alt="logo"> -->
              <h1>Titulo</h1>
            </div>
            <span>La civilizacion más grande y poderosa de América.</span>
          </div>
        </div>
      </header>
      <nav class="menu">
        <div class="container">
          <ul>
            <li><a href="">Inicio</a></li>
            <li><a href="">Cultura</a></li>
            <li><a href="">Idioma</a></li>
            <li><a href="">Guias</a></li>
          </ul>
        </div>
      </nav>
      <div class="container">
      <section>
          <?php
            include "main-page-articles.controller.php";
          ?>
      </section>
      <aside>
          <div class="aside popular">
            <div class="title">
              <h1>Popular</h1>
            </div>
            <div class="article-container">
              <div class="article">
                <h3>titulo</h3>
                <div>
                  <img src="" alt="poparticle">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores dolores modi veritatis facere non? Nisi magnam ipsum dicta? Odio</p>
                </div>
              </div>
              <div class="article">
                <h3>titulo</h3>
                <div>
                  <img src="" alt="poparticle">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores dolores modi veritatis facere non? Nisi magnam ipsum dicta? Odio</p>
                </div>
              </div>
              <div class="article">
                <h3>titulo</h3>
                <div>
                  <img src="" alt="poparticle">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores dolores modi veritatis facere non? Nisi magnam ipsum dicta? Odio</p>
                </div>
              </div>
              <div class="article">
                <h3>titulo</h3>
                <div>
                  <img src="" alt="poparticle">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores dolores modi veritatis facere non? Nisi magnam ipsum dicta? Odio</p>
                </div>
              </div>
            </div>
          </div>
          <div class="aside category">
            <div class="title">
              <h1>Categories</h1>
            </div>
            <div class="category-container">
              <ul>
                <li><span>></span><a href="">Fauna</a></li>
                <li><span>></span><a href="">Economia</a></li>
                <li><span>></span><a href="">Arquitectura</a></li>
              </ul>
            </div>
        </div>
      </aside>
    </div>
    <footer>
      <div class="row">
        <span></span>
        <ul>
          <li><a href="">item1</a></li>
          <li><a href="">item2</a></li>
          <li><a href="">item3</a></li>
        </ul>
      </div>
    </footer>
    </div>

    <!--Bootstrap and jquery js-->
    <script src="../js/jquery/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
  </body>
</html>
