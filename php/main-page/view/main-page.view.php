<div id="root">
  <header class="container-fluid mainColor_mp">
      <div class="container">
          <div class="row">
              <div class="col-md-12 logo text-center">
                  <div class="title mainText_mp" id="title_mp">
                    Machu Picchu
                  </div>
                  <span class="mainText_mp"  id="desc_mp">The largest and most powerful civilization in America</span>
              </div>
          </div>
      </div>
  </header>
  <div class="container-fluid bg-light">
    <nav class="container navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav" id="mp_topics"></div>
        </div>
    </nav>
  </div>
  <div class="container main-content">
      <div class="row">
          <section class="col-md-8" id="articles">
            <?php
              if(isset($_GET["article"])&&!empty($_GET["article"])){
                include "view/main-page-singleArticle.view.php";
              }else if(empty($_GET["article"])){
                echo "
                  <article>
                    <div class='alert alert-warning'>
                      There is no such articlie
                    </div>
                  </article>
                ";
              }
            ?>
          </section>
          <aside class="col-md-4 mt-4 mainColor_mp">
              <div class="aside popular">
                  <div class="title">
                      <h3>Popular</h3>
                  </div>
                  <div class="article-container" id="article_container">
                    <img id="wait" src="../../resources/loading-icon.gif" alt="">
                  </div>
              </div>
              <div class="aside category">
                  <div class="title">
                      <h3>Categories</h3>
                  </div>
                  <div class="category-container">
                      <ul id="categories">
                        <img id="wait" src="../../resources/loading-icon.gif" alt="">
                      </ul>
                  </div>
              </div>
          </aside>
      </div>
  </div>
  <div class="container-fluid page-footer text-center text-md-left">
      <footer class="container font-small pt-4 mt-4">
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <h5 class="text-uppercase" id="titlef_mp">Imperio Inca</h5>
                <p id="descf_mp">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <hr class="clearfix w-100 d-md-none pb-3">
            <div class="col-md-6 mb-md-0 mb-3">
              <div>
                <h3>Feedback</h3>
                <form name="form_contact" class="footer_form">
                    <div class="row form-group">
                      <div class="col">
                        <input class="form-control" type="text" name="name" placeholder="Name" required>
                      </div>
                      <div class="col">
                        <input class="form-control" type="text" name="subject" placeholder="Subject" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <textarea name="message" class="form-control" maxlength="255" placeholder="Message" required></textarea>
                      <input type="hidden" name="table_name" value="mail_box">
                    </div>
                </form>
                <button class="btn mainColor_mp mainText_mp" id="send_mail">Submit</button>
              </div>
            </div>
        </div>
        <div class="footer-copyright text-center py-3 mt-4 mainTextColor">© 2018 Copyright: Imperio Inca
        </div>
      </footer>
  </div>
</div>
