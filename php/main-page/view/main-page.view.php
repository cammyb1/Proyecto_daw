<div id="root">
  <header class="mainColor_mp">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12 logo text-center">
                  <div class="title" id="title_mp">
                    Machu Picchu
                  </div>
                  <span  id="desc_mp">The largest and most powerful civilization in America</span>
              </div>
          </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                  aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
              <div class="navbar-nav" id="mp_topics"></div>
          </div>
      </nav>
  </header>
    <div class="container">
        <div class="row">
            <section class="col-md-8" id="articles">
              <?php
                if(isset($_GET["article"])){
                  include "view/main-page-singleArticle.view.php";
                }
              ?>
            </section>
            <aside class="col-md-4 mt-4">
                <div class="aside popular mainColor_mp">
                    <div class="title">
                        <h1>Popular</h1>
                    </div>
                    <div class="article-container" id="article_container"></div>
                </div>
                <div class="aside category">
                    <div class="title">
                        <h1>Categories</h1>
                    </div>
                    <div class="category-container">
                        <ul id="categories"></ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <footer class="page-footer font-small pt-4 mt-4">
        <div class="container-fluid text-center text-md-left">
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <h5 class="text-uppercase" id="titlef_mp">Imperio Inca</h5>
                    <p id="descf_mp">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-6 mb-md-0 mb-3">
                  <div>
                    <h3>Feedback</h3>
                    <form name="form_contact">
                        <div class="form-group">
                          <label for="">Name</label><input type="text" name="name">
                        </div>
                        <div class="form-group">
                          <label for="">Subject</label><input type="text" name="subject">
                        </div>
                        <div class="form-group">
                          <label for="">Email</label><input type="email" name="email">
                        </div>
                        <div class="form-group">
                          <label for="">Message</label>
                          <textarea name="message" rows="8" cols="80" maxlength="255"></textarea>
                          <input type="hidden" name="table_name" value="mail_box">
                        </div>
                    </form>
                    <button class="btn btn-primary" id="send_mail">Send</button>
                  </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center py-3">© 2018 Copyright: Imperio Inca
        </div>
    </footer>
</div>
