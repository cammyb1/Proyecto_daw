<div class="login">
  <div class="row">
    <div class="col">
      <div id="alert_login"></div>
      <div class="container-fluid l-title">
          <h3>SIGN IN</h3>
      </div>
      <form method="POST" action="" name="login_form">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon l-icon"><i class="fa fa-user-alt"></i></span>
              <input type="text" class="form-control" name="user" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon l-icon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>
          <div class="form-group l-lp">
            <button type="submit" class="btn" name="login_submit" id="login_sub">Login</button>
            <a href="index.php?recover">Lost your password?</a>
          </div>
      </form>
    </div>
  </div>
</div>
