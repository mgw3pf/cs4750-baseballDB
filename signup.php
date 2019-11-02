<?php include('config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/userSignup.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>UserAccounts - Sign up</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php include(INCLUDE_PATH . "/layouts/navbar.php") ?>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form class="form" action="signup.php" method="post" enctype="multipart/form-data">
          <h2 class="text-center">Sign up</h2>
          <hr>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">Password confirmation</label>
            <input type="password" name="passwordConf" class="form-control">
          </div>
          <div class="form-group" style="text-align: center;">
        
          </div>
          <div class="form-group">
            <button type="submit" name="signup_btn" class="btn btn-success btn-block">Sign up</button>
          </div>
          <p>Aready have an account? <a href="login.php">Sign in</a></p>
        </form>
      </div>
    </div>
  </div>
<?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
<script type="text/javascript" src="assets/js/display_profile_image.js"></script>
