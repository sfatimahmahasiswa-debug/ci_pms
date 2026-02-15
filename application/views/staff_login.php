<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Login | PMS</title>

	  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/icon.png">
    <!-- Bootstrap core CSS -->
	  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	  <link rel="stylesheet"  href="<?php echo base_url(); ?>/assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      html, body{
        height:100%;
        width:100%;
        margin: 0;
        padding: 0;
      }
      body{
        display:flex;
        flex-direction:column;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        animation: slideUp 0.5s ease-out;
        max-width: 450px;
        width: 100%;
      }
      
      @keyframes slideUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .login-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px;
        text-align: center;
        color: white;
      }
      
      .login-header i {
        font-size: 48px;
        margin-bottom: 10px;
      }
      
      .login-header h3 {
        margin: 10px 0 5px 0;
        font-weight: 600;
        font-size: 24px;
      }
      
      .login-header p {
        margin: 0;
        opacity: 0.9;
        font-size: 14px;
      }
      
      .login-body {
        padding: 40px 35px;
      }
      
      .form-group {
        margin-bottom: 25px;
        position: relative;
      }
      
      .form-group label {
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
      }
      
      .input-group-custom {
        position: relative;
      }
      
      .input-group-custom i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        z-index: 10;
      }
      
      .input-group-custom input {
        padding-left: 45px;
        height: 45px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 14px;
      }
      
      .input-group-custom input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
      }
      
      .btn-login {
        width: 100%;
        height: 45px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
      }
      
      .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
      }
      
      .btn-admin-link {
        width: 100%;
        height: 45px;
        background: white;
        border: 2px solid #667eea;
        border-radius: 8px;
        color: #667eea;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
        display: inline-block;
        line-height: 41px;
        text-decoration: none;
      }
      
      .btn-admin-link:hover {
        background: #667eea;
        color: white;
        text-decoration: none;
      }
      
      .error-message {
        color: #e74c3c;
        font-size: 13px;
        margin-top: 5px;
        display: block;
      }
      
      .alert-error {
        background-color: #fee;
        border: 1px solid #fcc;
        color: #c33;
        padding: 12px;
        border-radius: 8px;
        margin-top: 15px;
        font-size: 14px;
      }
      
      .navbar {
        display: none;
      }
      
      #header {
        display: none;
      }
      
      #footer {
        background: rgba(0, 0, 0, 0.1);
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 0;
        font-size: 14px;
      }
      
      @media (max-width: 768px) {
        .login-body {
          padding: 30px 25px;
        }
        
        .login-header {
          padding: 25px;
        }
        
        .login-header h3 {
          font-size: 20px;
        }
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li style="align-self: center;"><a href="./">PMS in PHP using CodeIgniter Framework</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="col-md-10">
          <h2 class="text-center">
            Medika Inventory Manajemen- Staff Login
          </h2>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="login-card">
        <div class="login-header">
          <i class="fas fa-user-nurse"></i>
          <h3>Staff Login</h3>
          <p>Medika Inventory Management System</p>
        </div>
        
        <div class="login-body">
          <form method="post" action="<?php echo base_url();?>Staff/login_validation">
            <div class="form-group">
              <label for="username">Username</label>
              <div class="input-group-custom">
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" value="<?php echo set_value('username'); ?>"/>
              </div>
              <?php if(form_error('username')): ?>
                <span class="error-message"><?php echo form_error('username');?></span>
              <?php endif; ?>
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group-custom">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password"/>
              </div>
              <?php if(form_error('password')): ?>
                <span class="error-message"><?php echo form_error('password');?></span>
              <?php endif; ?>
            </div>
            
            <?php if($this->session->flashdata("error")): ?>
              <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata("error"); ?>
              </div>
            <?php endif; ?>
            
            <button type="submit" name="insert" value="Login" class="btn-login">
              <i class="fas fa-sign-in-alt"></i> Login
            </button>
            
            <a href="<?php echo base_url(); ?>Main" class="btn-admin-link">
              <i class="fas fa-user-shield"></i> Admin Login
            </a>
          </form>
        </div>
      </div>
    </section>
    
    <footer id="footer">
      <p>&copy; SCM & RCM Harmy Medika, <?php echo date('Y'); ?></p>
    </footer>
    
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
