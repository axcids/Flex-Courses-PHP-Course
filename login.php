<?php
$title='Login';
require_once 'template/header.php';
require 'config/app.php';
require 'config/db_connection.php';

if(isset($_SESSION['logged_in'])){
  header('location:/index.php');
}

$errors = [];
$email = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);

   if(empty($email)){array_push($errors, "*Email is required");}
   if(empty($password)){array_push($errors, "*Password is required");}

   if(!count($errors)){
     $userExists = $mysqli->query("select id, name, email, password, role from users where email = '$email' limit 1");
     if(!$userExists->num_rows){
       array_push($errors, "*The email $email is not correct.");
     }else{
       $foundUser = $userExists->fetch_assoc();
       $foundUserId = $foundUser['id'];
       $foundUserName = $foundUser['name'];
       $foundUserRole = $foundUserName['role'];
       if(password_verify($password, $foundUser['password'])){
         $_SESSION['logged_in'] = true;
         $_SEESION['user_id'] = $foundUserId;
         $_SESSION['user_name'] = $foundUserName;
         $_SESSION['user_role'] = $foundUserRole;
         $_SESSION['success_message'] = "Welcome back ".$foundUserName;
         header('location: index.php');
       }else{
         array_push($errors, '*Wrong credentials');
       }
     }
  }
}
?>
<div class="" id="login">
  <h4><?php echo $title ?>: </h4>
  <div class="alert alert-light" role="alert">
    Please Enter your email and password to login to your account. <br>If you don't have an account, you can register <a href="register.php">here</a>
    <hr>
  </div>
  <?php include 'template/errors.php'; ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Your email: </label>
        <input type="email" name="email" value="<?php echo $email ?>" class="form-control" placeholder="enter your email" id='email'>
      </div>
      <div class="form-group">
        <label for="password">Your password: </label>
        <input type="password" name="password" value="" class="form-control" placeholder="enter your password" id='password'>
      </div>
      <div class="form-group">
        <button class="btn btn-success" type="submit" name="button">Login</button>
        <a href="password_reset.php" style="float:right;">Forgot your password?</a>
      </div>
    </form>
</div>
<?php include 'template/footer.php' ?>
