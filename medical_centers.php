<?php require_once('includes/front_page_header.php'); ?>

<?php require_once('includes/front_page_top_nav.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading -->
      <h1 class="my-4">Medical Centers</h1>

      <?php 

        $sql = "SELECT centers.center_id, centers.center_image, centers.center_name, categories.category_name, counties.county_name, centers.center_phone, centers.center_email, centers.center_service_desc FROM centers INNER JOIN categories ON centers.center_category = categories.category_id INNER JOIN counties ON centers.center_county = counties.county_id WHERE centers.center_category = 1";
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

      <!-- Medical Centers -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="<?php echo $center_image; ?>" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3><?php echo $center_name; ?></h3>
          <p><?php echo $center_service_desc; ?></p>
          <a class="btn btn-primary" href="report.php?id=<?php echo $center_id; ?>">Contact</a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <?php } ?>

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

  </div>
  <!-- /.container -->

<?php require_once('includes/front_page_footer.php'); ?>
  