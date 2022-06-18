<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once('../includes/db.php'); ?>
<?php require_once('../includes/functions.php'); ?>

<?php

if (isset($_SESSION['role_id'])) {

  $role_id = $_SESSION['role_id'];
  
  if ($role_id != 1) {
    redirect("../");
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>
