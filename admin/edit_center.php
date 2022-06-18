<?php include_once("includes/admin_header.php"); ?>

<?php

if (isset($_GET['id'])) {
	$center_id = $_GET['id'];

    $sql = "SELECT centers.center_id, centers.center_image, centers.center_name, categories.category_id, categories.category_name, counties.county_id, counties.county_name, centers.center_phone, centers.center_email, centers.center_service_desc FROM centers INNER JOIN categories ON centers.center_category = categories.category_id INNER JOIN counties ON centers.center_county = counties.county_id WHERE centers.center_id = $center_id";
    $query = mysqli_query($conn, $sql);
    confirmQuery($query);

    while ($row = mysqli_fetch_assoc($query)) {
      $center_id       =   $row['center_id'];
      $center_image    =   $row['center_image'];
      $center_name     =   $row['center_name'];
      $category_id     =   $row['category_id'];
      $center_category =   $row['category_name'];
      $county_id       =   $row['county_id'];
      $center_county   =   $row['county_name'];
      $center_phone    =   $row['center_phone'];
      $center_email    =   $row['center_email'];
      $service_desc    =   $row['center_service_desc'];

  	}

  	if (isset($_POST['submit'])) {

		$post_center_name       =   $_POST['center_name'];
		$post_center_county     =   $_POST['center_county'];
		$post_center_category   =   $_POST['center_category'];
		$post_center_email      =   $_POST['center_email'];
		$post_center_image      =   $_FILES['center_image']['name'];
		$post_center_image_temp =   $_FILES['center_image']['tmp_name'];
		$post_center_phone      =   $_POST['center_phone'];
		$post_center_desc       =   $_POST['center_desc'];

		if(move_uploaded_file($post_center_image_temp, "../images/$post_center_image")) {

			$post_center_image = "images/{$post_center_image}";

			$query = "UPDATE centers SET center_name = '{$post_center_name}', center_category = $post_center_category,  center_image = '{$post_center_image}', center_county = $post_center_county, center_phone = '{$post_center_phone}', center_email = '{$post_center_email}', center_service_desc = '{$post_center_desc}' WHERE center_id = $center_id";

			$send_query = mysqli_query($conn, $query);
	    	confirmQuery($send_query);

	    	if ($send_query) {
	    		$_SESSION['success_message'] = "Center Updated Succesfully!";
	    		$_SESSION['error_message']   = "";
	    		// redirect("edit_center.php?id=$center_id");
	    	} else {
	    		$_SESSION['error_message']    =   "Failed to update rescue center";
				$_SESSION['success_message']  =   "";
				// redirect("edit_center.php?id=$center_id");
	    	}

	    	

		} else {

			$_SESSION['error_message']    =   "Failed to update rescue center";
			$_SESSION['success_message']  =   "";
			// redirect("edit_center.php?id=$center_id");

		}
	} else {

		$_SESSION['error_message']    =   "";
	    $_SESSION['success_message']  =   "";
	}
             
}


?>

<body id="page-top">

  <?php include_once("includes/admin_top_navigation.php"); ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once("includes/admin_sidebar_nav.php"); ?>

    <div id="content-wrapper">

      <div class="container">

      	<div class="col-md-12">

	      	  <!-- Notifications here -->

	          <?php
	           if (!empty($_SESSION['error_message'])) {
	            	echo "<div class='alert alert-danger mt-2' role='alert'>{$_SESSION['error_message']}</div>";
	            	$_SESSION['error_message'] = "";
	           } elseif (!empty($_SESSION['success_message'])) {
	             	echo "<div class='alert alert-success mt-2' role='alert'>{$_SESSION['success_message']}</div>";
	             	$_SESSION['success_message'] = "";
	           }
	          ?>

	      </div>

      	<form action="" method="post" enctype="multipart/form-data">

      	<div class="row">

      		<div class="col-md-12 mx-3">
      		
      			<h3 class="page-header">Edit Center: <?php echo $center_name; ?></h1>

      		</div>

      	</div>

      	<div class="mx-3">

	      	<div class="row">

	      		<div class="col-md-6">
	      		
	      			<div class="form-group">
				        <label for="center_name">Center Name</label>
				        <input type="text" class="form-control" name="center_name" value="<?php echo $center_name; ?>">
				    </div>

				    <div class="form-group">
				        <label for="center_category">Center Category</label>

						<select name="center_category" id="" class="form-control">
				           <option value="<?php echo $category_id; ?>"><?php echo $center_category; ?></option>
				            <?php 
				                $query = "SELECT * FROM categories WHERE category_id != $category_id";
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

				    <div class="form-group">
				        <label for="center_email">Center Contact Email</label>
				        <input type="text" class="form-control" name="center_email" value="<?php echo $center_email; ?>">
				    </div>

				    <div class="form-group">
				        <label for="center_image">Center Portfolio Image</label><br>
				        <img width="300" class="img-thumbnail mb-2" src="../<?php echo $center_image ?>" alt="">
				        <input type="file" class="form-control" name="center_image" required>
				    </div>

				    <div class="form-group">
				        <label for="center_county">Center County Location</label>

						<select name="center_county" id="" class="form-control">
				           <option  value="<?php echo $county_id; ?>"><?php echo $center_county; ?></option>
				            <?php 
				                $query = "SELECT * FROM counties WHERE county_id != $county_id";
				                $county_query = mysqli_query($conn, $query);
				                confirmQuery($county_query);
				                
				                while ($row = mysqli_fetch_assoc($county_query)) {
				                    $other_county_id = $row['county_id'];
				                    $other_county = $row['county_name'];
				                    echo "<option value='$other_county_id'>$other_county</option>";
				        
				                }
				            
				            ?>
				        </select>

				    </div>

	      		</div>	

	      		<div class="col-md-6">
	      		
	      			<div class="form-group">
				        <label for="center_phone">Center Contact Phone</label>
				        <input type="text" class="form-control" name="center_phone" value="<?php echo $center_phone; ?>">
				    </div>

				    <div class="form-group">
				        <label for="center_desc">Center Service Description</label>
				        <textarea id="editor" type="text" class="form-control" cols="30" rows="10" name="center_desc"><?php echo $service_desc ?></textarea>
				    </div>

	      		</div>	

	      	</div>

      	</div>	

      	<div class="text-center">
      		
      		<input type="submit" name="submit" class="btn btn-dark col-md-6 mb-3" value="Update">

      	</div>

      	</form>

      </div>
      <!-- /.container-fluid -->

<?php include_once("includes/admin_footer.php"); ?>
