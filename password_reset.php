<?php
$title='Password Reset';
require_once 'template/header.php';
require 'config/app.php';
require 'config/db_connection.php';

if(isset($_SESSION['logged_in'])){
  header('location:/index.php');
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);

   if(empty($email)){array_push($errors, "*Email is required");}

   if(!count($errors)){
     $userExists = $mysqli->query("select id, name, email, password from users where email = '$email' limit 1");
     if($userExists->num_rows){
       $userId = $userExists->fetch_assoc()['id'];
       $tokenExists = $mysqli->query("delete from password_reset where user_id='$userId'");
       $token = bin2hex(random_bytes(16));
       $expires_at = date('Y-m-d H:i:s', strtotime('+1 day'));
       $mysqli->query("insert into password_reset(user_id, token, expires_at)
       values('$userId', '$token', '$expires_at');
       ");
       $_SESSION['success_message'] = 'Please check your email for password\'s reset link';
       header('location: index.php');
       die();
     }else{
       array_push($errors, "*The email you have entered is not correct, or it is not registered yet!");
     }
  }
}
?>
<div class="" id="password_reset">
  <h4><?php echo $title ?>: </h4>
  <div class="alert alert-light" role="alert">
    fill in the form below to reset the password.
    <hr>
  </div>
  <?php include 'template/errors.php'; ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Your email: </label>
        <input type="email" name="email" value="" class="form-control" placeholder="enter your email" id='email'>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="button">Reset</button>
      </div>
    </form>
</div>
<?php include 'template/footer.php' ?>
