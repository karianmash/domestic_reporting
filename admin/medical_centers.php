<?php include_once("includes/admin_header.php"); ?>

<?php

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $id     = $_GET['id'];

  switch ($action) {
    case 'delete':
      delete_center($id, "medical_centers.php");
      break;

    default:
      # code...
      break;
  }
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

            <!-- Notifications here -->
            <?php
            if (isset($_SESSION['error_message'])) {
              echo "<div class='alert alert-danger mt-2' role='alert'>{$_SESSION['error_message']}</div>";
              unset($_SESSION['error_message']);
            } elseif (isset($_SESSION['success_message'])) {
              echo "<div class='alert alert-success mt-2' role='alert'>{$_SESSION['success_message']}</div>";
              unset($_SESSION['success_message']);
            }
            ?>

          </div>

          <div class="col-md-12">

            <h3 class="page-header">Medical Centers</h1>

          </div>
        </div>
        <div class="row">

          <div class="col-md-4 my-3">
            <a href="add_new_center.php" class="btn btn-success">Add New Center</a>
          </div>

          <div class="col-md-12">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>County</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

                <?php

                $sql = "SELECT centers.center_id, centers.center_image, centers.center_name, categories.category_name, counties.county_name, centers.center_phone, centers.center_email FROM centers INNER JOIN categories ON centers.center_category = categories.category_id INNER JOIN counties ON centers.center_county = counties.county_id WHERE centers.center_category = 1";
                $query = mysqli_query($conn, $sql);
                confirmQuery($query);

                while ($row = mysqli_fetch_assoc($query)) {
                  $center_id = $row['center_id'];
                  $center_image = $row['center_image'];
                  $center_name = $row['center_name'];
                  $center_category = $row['category_name'];
                  $center_county = $row['county_name'];
                  $center_phone = $row['center_phone'];
                  $center_email = $row['center_email'];
                ?>
                  <tr>
                    <td><img width="100" class="img-responsive" src="../<?php echo $center_image ?>" alt=""></td>
                    <td><?php echo $center_name; ?></td>
                    <td><?php echo $center_category; ?></td>
                    <td><?php echo $center_county; ?></td>
                    <td><?php echo $center_phone; ?></td>
                    <td><?php echo $center_email; ?></td>
                    <td class="text-center"><a href="edit_center.php?id=<?php echo $center_id; ?>" class="btn btn-info btn-sm">Edit</a></td>
                    <td class="text-center"><a href="medical_centers.php?action=delete&id=<?php echo $center_id; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <?php include_once("includes/admin_footer.php"); ?>