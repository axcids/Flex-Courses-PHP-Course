<?php
include_once 'db_connection.php';

$settings = $mysqli->query('select * from settings where id = 1')->fetch_assoc();

if(count($settings)){
  $app_name = $settings['app_name'];
  $admin_email = $settings['admin_email'];
}else{
  $app_name = 'Service app';
  $admin_email = $settings['admin_email'];
}

$config = [
  'app_name'=> $app_name,
  'admin_email' => $admin_email,
  'app_url' => 'http://127.0.0.1/',
  'lang' => 'en',
  'dir' => 'ltr',
  'admin_assets' => 'http://127.0.0.1/admin/template/assets/',
];
