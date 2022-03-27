<?php
$title='Registeration';
require_once 'template/header.php';
require 'config/app.php';
require 'config/db_connection.php';

if(isset($_SESSION['logged_in'])){
  header('location:index.php');
}

$errors = [];
$email = $name = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $name = mysqli_real_escape_string($mysqli, $_POST['name']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $password_confirmation = mysqli_real_escape_string($mysqli, $_POST['password_confirmation']);

   if(empty($email)){array_push($errors, "*Email is required");}
   if(empty($name)){array_push($errors, "*Name is required");}
   if(empty($password)){array_push($errors, "*Password is required");}
   if(empty($password_confirmation)){array_push($errors, "*Password confirmation is required");}
   if($password != $password_confirmation){
     array_push($errors, "*Passwords are not matched");
   }
   $userExists = $mysqli->query("select id, email from users where email = '$email' limit 1");
   if($userExists->num_rows){
       array_push($errors, "*Email already exists");
   }
   if(!count($errors)){

     $password = password_hash($password, PASSWORD_DEFAULT);
     $submitQuery = "insert into users (email, name, password) values ('$email', '$name', '$password')";
     $mysqli->query($submitQuery);
     //SESSION
     $_SESSION['logged_in'] = true;
     $_SEESION['user_id'] = $mysqli->insert_id;
     $_SESSION['user_name'] = $name; //Temporary
     $_SESSION['success_message'] = "Welcome to our website ".$name;

     header('location: index.php');
     $email = $name = '';
    }
  }
?>
<div class="" id="register">
  <h4><?php echo $title ?>: </h4>
  <div class="">
    Please fill in the form to complete your registration
  </div>
  <hr>
  <?php include 'template/errors.php'; ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Your email: </label>
        <input type="email" name="email" value="<?php echo $email ?>" class="form-control" placeholder="enter your email" id='email'>
      </div>
      <div class="form-group">
        <label for="name">Your name: </label>
        <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="enter your name" id='name'>
      </div>
      <div class="form-group">
        <label for="password">Your password: </label>
        <input type="password" name="password" value="" class="form-control" placeholder="enter your password" id='password'>
      </div>
      <div class="form-group">
        <label for="password_confirmation">confirm password: </label>
        <input type="password" name="password_confirmation" value="" class="form-control" placeholder="confirm your password" id='password_confirmation'>
      </div>
      <div class="form-group">
        <button class="btn btn-success" type="submit" name="button">Register</button>
      </div>
    </form>
</div>
<?php include 'template/footer.php' ?>
