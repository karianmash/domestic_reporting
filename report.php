<?php require_once('includes/front_page_header.php'); ?>

<?php

if (!isset($_SESSION['user_id'])) {
  redirect("login.php");
}
1
$error = "";
$success = "";

if(isset($_GET['id'])) {

  $issue_center = $_GET['id'];
  $find_center_sql = "SELECT * FROM centers WHERE center_id = $issue_center";
  $find_center_query = mysqli_query($conn, $find_center_sql);
  $center_name = "";
  while ($row = mysqli_fetch_assoc($find_center_query)) {
    $center_name = $row['center_name'];
  }

  if (isset($_POST['report'])) {
     $issue_title = $_POST['issue_title'];
     $issue_category = $_POST['issue_category'];
     $issue_desc = $_POST['issue_desc'];
     $issue_reporter = $_SESSION['user_id'];

     $sql = "INSERT INTO issues (issue_title, issue_desc, issue_reporter, issue_center, issue_state, issue_category, issue_report_date, issue_resolve_date) VALUES ('{$issue_title}', '{$issue_desc}', '$issue_reporter', '$issue_center', 2, '$issue_category', now(), now())";

     $query = mysqli_query($conn, $sql);
     if ($query) {
       $success = "Report sent successfully";
     } else {
       $error = "Failed to send report";
     }

  }

} else {

  redirect("index.php");
}

?>

<?php require_once('includes/front_page_top_nav.php'); ?>

  <!-- Page Content -->
<div class="container">
  <div class="col-md-10 mx-auto">
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
      <div class="card-header">File your report at <b><?php echo $center_name; ?></b> Center</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <label for="validationCustom01">Title</label>
                  <input type="text" class="form-control" placeholder="Title" required="required" autofocus="autofocus" name="issue_title">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <label for="issue_category">Category</label>
                  <select name="issue_category" id="" class="form-control">
                   <option value='1'>Select Category</option>
                    <?php 
                        $query = "SELECT * FROM categories";
                        $cat_query = mysqli_query($conn, $query);
                        confirmQuery($cat_query);
                        
                        while ($row = mysqli_fetch_assoc($cat_query)) {
                            $other_cat_id = $row['category_id'];
                            $other_cat_name = $row['category_name'];
                            echo "<option value='$other_cat_id'>$other_cat_name</option>";
                
                        }
                    
                    ?>
                </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <label for="validationCustom01">Issue Description</label>
              <textarea id="editor" type="text" class="form-control" cols="30" rows="10" name="issue_desc"></textarea>
            </div>
          </div>
          <div class="text-center">
             <input type="submit" name="report" class="btn btn-primary btn-block col-md-6" value="Send Report">
          </div>
        </form>
        </div>
      </div>
  </div>
  </div>
  <!-- /.container -->

  
