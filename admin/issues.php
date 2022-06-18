<?php include_once("includes/admin_header.php"); ?>

<?php

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $id     = $_GET['id'];

  switch ($action) {
    case 'resolve':
      resolve_issue($id);
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
          
            <h3 class="page-header">Rescue Centers</h1>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mt-2">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Reporter</th>
                  <th>Center</th>
                  <th>State</th>
                  <th>Category</th>
                  <th>Report Date</th>
                  <th>Resolve Date</th>
                  <th>Resolve</th>
                </tr>
              </thead>
              <tbody>
                
                  <?php 

                    $sql = "SELECT issues.issue_id, issues.issue_title, users.user_first_name, centers.center_name, states.state_name, categories.category_name, issues.issue_report_date, issues.issue_resolve_date FROM issues INNER JOIN users ON issues.issue_reporter = users.user_id INNER JOIN centers ON issues.issue_center = centers.center_id INNER JOIN states ON issues.issue_state = states.state_id INNER JOIN categories ON issues.issue_category = categories.category_id";
                    $query = mysqli_query($conn, $sql);
                    confirmQuery($query);

                    while ($row = mysqli_fetch_assoc($query)) {
                      $issue_id = $row['issue_id'];
                      $issue_title = $row['issue_title'];
                      $issue_reporter = $row['user_first_name'];
                      $issue_center = $row['center_name'];
                      $issue_state = $row['state_name'];
                      $issue_category = $row['category_name'];
                      $issue_report_date = $row['issue_report_date'];
                      $issue_resolve_date = $row['issue_resolve_date'];
                  ?>
                <tr>
                  <td><?php echo $issue_id; ?></td>
                  <td><?php echo $issue_title; ?></td>
                  <td><?php echo $issue_reporter; ?></td>
                  <td><?php echo $issue_center; ?></td>
                  <td><?php echo $issue_state; ?></td>
                  <td><?php echo $issue_category; ?></td>
                  <td><?php echo $issue_report_date; ?></td>
                  <td><?php echo $issue_resolve_date; ?></td>
                  <td class="text-center"><a href="issues.php?action=resolve&id=<?php echo $issue_id; ?>" class="btn btn-success btn-sm">Resolve</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

<?php include_once("includes/admin_footer.php"); ?>
      