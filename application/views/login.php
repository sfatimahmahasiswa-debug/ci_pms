<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | CI PMS</title>

	  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/icon.png">
    <!-- Bootstrap core CSS -->
	  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	  <link rel="stylesheet"  href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      html, body{
        height:100%;
        width:100%;
        margin:0;
      }
      body{
        display:flex;
        flex-direction:column;
        background: #f4f4f4;
      }
      #main{
        flex-grow: 1;
        flex-shrink: 1;
        margin-bottom: 4em;
        display:flex;
        align-items:center;
        justify-content:center;
        padding: 20px;
      }
      .login-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        overflow: hidden;
      }
      .login-card-header {
        background: #80c3e3;
        color: #fff;
        text-align: center;
        padding: 22px 20px;
      }
      .login-card-header h2 {
        margin: 10px 0 0 0;
        font-size: 24px;
      }
      .login-card-body {
        padding: 24px;
      }
      .login-card-body .form-control {
        height: 42px;
      }
      .toggle-password {
        border-left: 0;
      }
      .form-actions {
        margin-top: 18px;
      }
      .form-actions .btn {
        width: 100%;
        margin-bottom: 10px;
      }
      .login-link {
        text-align: center;
      }
      .login-link a {
        font-weight: 600;
      }
      #header {
        display: none;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li  style="align-self: center;"><a href="./">PMS in PHP using CodeIgniter Framework</a></li>
          </ul>
          
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
    <!--/.nav End -->

    <header id="header">
      <div class="container">
        <div class="col-md-10">
          <h2 class="text-center">
          Medika Inventory Manajemen- Admin Login
          </h2>
        </div>
       </div>
      </div>
    </header>

 
    <!-- /.container -->
   <section id="main">
      <div class="login-card">
        <div class="login-card-header">
          <i class="fas fa-user-shield fa-2x" aria-hidden="true"></i>
          <h2>Admin Login</h2>
        </div>
        <div class="login-card-body">
          <form method="post" action="<?php echo base_url();?>main/login_validation">
            <div class="form-group">
              <label for="username">Username</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" value="<?php echo htmlspecialchars(set_value('username'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true" autocomplete="username"/>
              </div>
              <span class="text-danger"><?php echo form_error('username');?></span>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                <input class="form-control" name="password" id="password" type="password" placeholder="Enter your password" required aria-required="true" autocomplete="current-password"/>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default toggle-password" data-target="#password" aria-label="Show password" aria-pressed="false">
                    <i class="fas fa-eye"></i>
                  </button>
                </span>
              </div>
              <span class="text-danger"><?php echo form_error('password');?></span>
            </div>
            <?php if($this->session->flashdata("error")): ?>
              <div class="alert alert-danger"><?php echo htmlspecialchars($this->session->flashdata("error"), ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <div class="form-actions">
              <button type="submit" name="insert" value="Login" class="btn btn-primary">Login</button>
              <div class="login-link">
                <a href="<?php echo base_url(); ?>Staff" class="btn btn-info">Staff Login</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    
    <!-- /.Footer -->
	<footer id="footer" class="navbar navbar-fixed-bottom">
  <p>&copy; SCM & RCM Harmy Medika,  <?php echo date('Y')?>  </p>
	</footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
      if (window.jQuery) {
        $('.toggle-password').on('click', function () {
          var target = $($(this).data('target'));
          var icon = $(this).find('i');
          if (target.attr('type') === 'password') {
            target.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
            $(this).attr('aria-label', 'Hide password');
            $(this).attr('aria-pressed', 'true');
          } else {
            target.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
            $(this).attr('aria-label', 'Show password');
            $(this).attr('aria-pressed', 'false');
          }
        });
      }
    </script>
  </body>
</html>
