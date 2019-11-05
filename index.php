<?php
session_start();
require './master.php';
load_head('Login');
require './connection.php';

if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
}
?>

<link rel="stylesheet" href="index.css">

<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Silahkan Login</h5>
          <form class="form-signin" method="POST" action="module/global_login.php">
            <div class="form-label-group">
              <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
              <label for="inputEmail">Username</label>
            </div>

            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
              <label for="inputPassword">Password</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php load_footer(); ?>
