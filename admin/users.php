<?php include_once("includes/admin_header.php"); ?>

<?php

if (isset($_GET['role'])) {
  $role = $_GET['role'];
  $id = $_GET['id'];

  $sql   = "UPDATE users SET user_role = $role WHERE user_id = $id";
  $query = mysqli_query($conn, $sql);
  confirmQuery($query);

  redirect("users.php");
}

?>

<body id="page-top">

  <?php include_once("includes/admin_top_navigation.php"); ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once("includes/admin_sidebar_nav.php"); ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <h3 class="page-header">Users</h1>

          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Role</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Admin</th>
                  <th>Subscriber</th>
                </tr>
              </thead>
              <tbody>

                <?php

                $sql = "SELECT users.user_id, roles.role_name, users.user_first_name, users.user_last_name, users.user_phone, users.user_email FROM users INNER JOIN roles ON users.user_role = roles.role_id";
                $query = mysqli_query($conn, $sql);
                confirmQuery($query);

                while ($row = mysqli_fetch_assoc($query)) {
                  $user_id = $row['user_id'];
                  $user_role = $row['role_name'];
                  $user_first_name = $row['user_first_name'];
                  $user_last_name = $row['user_last_name'];
                  $user_phone = $row['user_phone'];
                  $user_email = $row['user_email'];
                ?>
                  <tr>
                    <td><?php echo $user_id; ?></td>
                    <td><?php echo $user_role; ?></td>
                    <td><?php echo $user_first_name; ?></td>
                    <td><?php echo $user_last_name; ?></td>
                    <td><?php echo $user_phone; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td class="text-center"><a href="users.php?role=1&id=<?php echo $user_id; ?>" class="btn btn-success btn-sm">admin</a></td>
                    <td class="text-center"><a href="users.php?role=2&id=<?php echo $user_id; ?>" class="btn btn-primary btn-sm">subscriber</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <?php include_once("includes/admin_footer.php"); ?>