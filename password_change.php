<?php
$title='Change password';
require_once 'template/header.php';
require 'config/app.php';
require 'config/db_connection.php';

if(isset($_SESSION['logged_in'])){
  header('location:/index.php');
}
if(!isset($_GET['token']) || !$_GET['token']){
  die('The reset link is invaild');
}

$now = date('Y-m-d H:i:s');

$stmt = $mysqli->prepare("select * from password_reset where token= ? and expires_at > '$now'");
$stmt->bind_param('s', $token);
$token = $_GET['token'];
$stmt->execute();
$result = $stmt->get_result();

if(!$result->num_rows){
  die('Toke is not valid');
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $password_confirmation = mysqli_real_escape_string($mysqli, $_POST['password_confirmation']);
  if(empty($password)){array_push($errors, "*Password is required");}
  if(empty($password_confirmation)){array_push($errors, "*Password confirmation is required");}
  if($password != $password_confirmation){
    array_push($errors, "*Passwords are not matched");
  }


   if(!count($errors)){
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     $userId = $result->fetch_assoc()['user_id'];
     $mysqli->query("update users set password = '$hashed_password' where id = '$userId'");
     $mysqli->query("delete from password_reset where userId= '$userId'");
     $_SESSION['success_message'] = "Your password have been changed!";
     header('location: login.php');
     die();
  }
}
?>
<div class="" id="change_password">
  <h4><?php echo $title ?>: </h4>
  <div class="alert alert-light" role="alert">
    fill in the form below to change your password.
    <hr>
  </div>
  <?php include 'template/errors.php'; ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="password">New password: </label>
        <input type="password" name="password" class="form-control" placeholder="enter your new password" id='password'>
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm new password: </label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="confirm your new password" id='password_confirmation'>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="button">Change password</button>
      </div>
    </form>
</div>
<?php include 'template/footer.php' ?>
