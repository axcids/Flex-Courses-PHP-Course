<?php
$title = 'Create users';
$icon = 'nc-circle-09';
include __DIR__.'/../template/header.php';

$errors = [];
$email = $name = $role = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $name = mysqli_real_escape_string($mysqli, $_POST['name']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $role = mysqli_real_escape_string($mysqli, $_POST['role']);

   if(empty($email)){array_push($errors, "*Email is required");}
   if(empty($name)){array_push($errors, "*Name is required");}
   if(empty($password)){array_push($errors, "*Password is required");}
   if(empty($role)){array_push($errors, "*Role is required");}

   if(!count($errors)){

     $password = password_hash($password, PASSWORD_DEFAULT);
     $submitQuery = "insert into users (email, name, password, role) values ('$email', '$name', '$password', '$role')";
     $mysqli->query($submitQuery);
     if($mysqli->error){
       array_push($errors, $mysqli->error);
     }else{
       echo "<script> location.href='index.php' </script>";
     }
    }
  }
?>
<?php include __DIR__.'/../template/errors.php' ?>
<form action="" method="post">
  <div class="form-group">
    <label for="email">Your email: </label>
    <input type="email" name="email" value="" class="form-control" placeholder="enter your email" id='email'>
  </div>
  <div class="form-group">
    <label for="name">Your name: </label>
    <input type="text" name="name" value="" class="form-control" placeholder="enter your name" id='name'>
  </div>
  <div class="form-group">
    <label for="password">Your password: </label>
    <input type="password" name="password" value="" class="form-control" placeholder="enter your password" id='password'>
  </div>
  <div class="form-group">
    <label for="role">Role:</label>
    <select class="form-control" name="role" id="role">
      <option></option>
      <option value="user">User</option>
      <option value="admin">Admin</option>
    </select>
  </div>
  <div class="form-group">
    <button class="btn btn-success" type="submit" name="button">Create</button>
  </div>
</form>

<?php
include __DIR__.'/../template/footer.php';
