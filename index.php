<?php require_once('includes/front_page_header.php'); ?>

<?php require_once('includes/front_page_top_nav.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Instant Violence Reporting!</h1>
      <p class="lead">Take action and report any violence right now, and wait for action to be taken! File a report right now by contacting the centers below or by clicking the category of your issue in the navigation bar then at your appropriate center, file your report! Be patient while we process your request!</p>
      <!-- <a href="report.php" class="btn btn-primary btn-lg">Report</a> -->
    </header>

    <!-- Page Features -->
    <div class="row text-center">

      <?php

      $sql = "SELECT centers.center_id, centers.center_image, centers.center_name, categories.category_name, counties.county_name, centers.center_phone, centers.center_email, centers.center_service_desc FROM centers INNER JOIN categories ON centers.center_category = categories.category_id INNER JOIN counties ON centers.center_county = counties.county_id LIMIT 4";

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
          $center_service_desc = $row['center_service_desc'];
      ?>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img  width="500" height="165" class="card-img-top" src="<?php echo $center_image; ?>" alt="">
          <div class="card-body">
            <h4 class="card-title"><?php echo $center_name; ?></h4>
            <p class="card-text"><?php echo $center_service_desc; ?></p>
          </div>
          <div class="card-footer">
            <a href="report.php?id=<?php echo $center_id; ?>" class="btn btn-primary">Contact</a>
          </div>
        </div>
      </div>

    <?php } ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php require_once('includes/front_page_footer.php'); ?>
  