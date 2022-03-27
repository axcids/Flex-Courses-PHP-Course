<?php

session_start();

require_once __DIR__.'/../config/app.php';
require 'config/app.php';
require 'config/db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="<?php echo $config['lang']?>" dir="<?php echo $config['dir'] ?>">
<head>
  <title><?php  echo $config['app_name'] . ' | ' . $title ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="template/style.css">
</head>
<body>
  <!-- header-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="./"><?php echo $config['app_name'] ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./messages.php">Messages</a>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if(!isset($_SESSION['logged_in'])): ?>
      <li class="nav-item">
        <a class="nav-link" href="/../login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/register.php">Registeration</a>
      </li>
    <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="/logout.php">Logout</a>
      </li>
    <?php endif; ?>
  </ul>
  </div>
</nav>
  <!-- connection -->
  <hr>
  <div class="connection" style="padding-left:20px; ">
  <?php if($mysqli->connect_error){ ?>
  <?php die('
    <div class="sql_not_connected">
      <p> ⬤ Not connnected to server</p>
    </div>
  ');}else{ ?>
    <div class="sql_connected">
      <p> ⬤ Connected to server</p>
    </div>
  <?php } ?>
  </div>
  <hr>
    <div class="container pt-4">
    <?php include 'template/welcome.php';
