<?php

//I can add a class and make credentials private as security?

$connection = [
  'host'=>'localhost',
  'user'=>'root',
  'password'=>'',
  'database'=>'app'
];

$mysqli = new mysqli(
  $connection['host'],
  $connection['user'],
  $connection['password'],
  $connection['database']
);
