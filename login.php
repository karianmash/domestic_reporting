<?php require_once('includes/front_page_header.php'); ?>

<?php

$error = "";
$success = "";

if (isset($_POST['login'])) {
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  $sql = "SELECT * FROM users WHERE user_email = '{$user_email}' AND user_password = '{$user_password}'";

  $query = mysqli_query($conn, $sql);

  if (mysqli_num_rows($query) > 0) {

    $success = "Success!";

    while ($row = mysqli_fetch_assoc($query)) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['user_first_name'] = $row['user_first_name'];
      $_SESSION['user_last_name'] = $row['user_last_name'];
      $_SESSION['user_email'] = $row['user_email'];
      $_SESSION['role_id'] = $row['user_role'];
    }

    redirect("admin/");
  } else {

    $error = "Wrong password/email";
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
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" name="user_email">
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="user_password">
            </div>
          </div>
          <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- /.container -->