<?php

session_start();

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'A'){
  die('Fuck off');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once __DIR__.'/../../config/app.php';
  require_once __DIR__.'/../../config/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $config['admin_assets'] ?>img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo $config['admin_assets'] ?>img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Panel: <?php echo $title ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="<?php echo $config['admin_assets'] ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $config['admin_assets'] ?>css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo $config['admin_assets'] ?>css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>
  <div class="wrapper">
      <div class="sidebar" data-color="black">
          <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

      Tip 2: you can also add an image using data-image tag
  -->
      <?php include 'sidebar.php' ?>
      </div>
      <div class="main-panel">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg " color-on-scroll="500">
              <div class="container-fluid">
                  <a class="navbar-brand" href="#"> <?php echo $title ?> </a>
                  <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-bar burger-lines"></span>
                      <span class="navbar-toggler-bar burger-lines"></span>
                      <span class="navbar-toggler-bar burger-lines"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navigation">
                      <ul class="nav navbar-nav mr-auto">
                          <li class="nav-item" style="padding:1em;">
                                  <i class="nc-icon <?php echo $icon ?>"></i>
                                  <span class="d-lg-none">Dashboard</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <span class="no-icon">Account</span>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <span class="no-icon">Log out</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
          <!-- End Navbar -->
          <div class="content">
            <div class="container-fluid">
