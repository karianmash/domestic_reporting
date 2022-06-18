<?php require_once('includes/front_page_header.php'); ?>

<?php

$error = "";
$success = "";

if (isset($_POST['register'])) {
   $user_first_name = $_POST['user_first_name'];
   $user_last_name = $_POST['user_last_name'];
   $user_phone = $_POST['user_phone'];
   $user_email = $_POST['user_email'];
   $user_password = $_POST['user_password'];
   $user_password_confirm = $_POST['user_password_confirm'];

   if ($user_password !== $user_password_confirm) {
     $error = "The passwords don't match!";
   } else {
     $sql = "INSERT INTO users (user_role, user_first_name, user_last_name, user_phone, user_email, user_password) VALUES (2, '{$user_first_name}', '{$user_last_name}', '{$user_phone}', '{$user_email}', '{$user_password}')";

     $query = mysqli_query($conn, $sql);
     if ($query) {
       $success = "User registered successfully";
     } else {
       $error = "Failed to add user";
     }
   }

}

?>

<?php require_once('includes/front_page_top_nav.php'); ?>

  <!-- Page Content -->
<div class="container">
	<div class="col-md-6 mx-auto">
    <div class="col-md-12">
          <!-- Notifications here -->
          <?php
           if (!empty($error)) {
            echo "<div class='alert alert-danger mt-2' role='alert'>$error</div>";
           } elseif (!empty($success)) {
             echo "<div class='alert alert-success mt-2' role='alert'>$success</div>";
           }
          ?>
    </div>
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="user_first_name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" class="form-control" placeholder="Last name" required="required" name="user_last_name">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="number" id="userPhone" class="form-control" placeholder="Phone number" required="required" name="user_phone" >
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" name="user_email">
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="user_password">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" name="user_password_confirm">
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="register" class="btn btn-primary btn-block" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
        </div>
      	</div>
      </div>
	</div>
  </div>
  <!-- /.container -->

  