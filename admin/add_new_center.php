<?php include_once("includes/admin_header.php"); ?>

<?php

$success = "";
$error   = "";

if (isset($_POST['submit'])) {

	$center_name       =   $_POST['center_name'];
	$center_county     =   $_POST['center_county'];
	$center_category   =   $_POST['center_category'];
	$center_email      =   $_POST['center_email'];
	$center_image      =   $_FILES['center_image']['name'];
	$center_image_temp =   $_FILES['center_image']['tmp_name'];
	$center_phone      =   $_POST['center_phone'];
	$center_desc       =   $_POST['center_desc'];

	if (move_uploaded_file($center_image_temp, "../images/$center_image")) {

		$center_image = "images/{$center_image}";

		$query = "INSERT INTO centers(center_name, center_category,  center_image, center_county, center_phone, center_email, center_service_desc) ";

		$query .= " VALUES ('{$center_name}', $center_category, '{$center_image}', $center_county, '{$center_phone}', '{$center_email}', '{$center_desc}') ";

		$send_query = mysqli_query($conn, $query);
		confirmQuery($send_query);

		$success = "New Rescue Center Added Succesfully!";
	} else {

		$error = "Failed to add rescue center";
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
					if (!empty($error)) {
						echo "<div class='alert alert-danger mt-2' role='alert'>$error</div>";
					} elseif (!empty($success)) {
						echo "<div class='alert alert-success mt-2' role='alert'>$success</div>";
					}
					?>

				</div>

				<form action="" method="post" enctype="multipart/form-data">

					<div class="row">

						<div class="col-md-12 mx-3">

							<h3 class="page-header">Add New Center</h1>

						</div>

					</div>

					<div class="mx-3">

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">
									<label for="center_name">Center Name</label>
									<input type="text" class="form-control" name="center_name">
								</div>

								<div class="form-group">
									<label for="center_category">Center Category</label>

									<select name="center_category" id="" class="form-control">
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

								<div class="form-group">
									<label for="center_email">Center Contact Email</label>
									<input type="text" class="form-control" name="center_email">
								</div>

								<div class="form-group">
									<label for="center_image">Center Portfolio Image</label>
									<input type="file" class="form-control" name="center_image">
								</div>

								<div class="form-group">
									<label for="center_county">Center County Location</label>

									<select name="center_county" id="" class="form-control">
										<option value='1'>Select Category</option>
										<?php
										$query = "SELECT * FROM counties";
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
									<input type="text" class="form-control" name="center_phone">
								</div>

								<div class="form-group">
									<label for="center_desc">Center Service Description</label>
									<textarea id="editor" type="text" class="form-control" cols="30" rows="10" name="center_desc"></textarea>
								</div>

							</div>

						</div>

					</div>

					<div class="text-center">

						<input type="submit" name="submit" class="btn btn-dark col-md-6 mb-3" value="Submit">

					</div>

				</form>

			</div>
			<!-- /.container-fluid -->

			<?php include_once("includes/admin_footer.php"); ?>