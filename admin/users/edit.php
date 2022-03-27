<?php
$title = 'Edit user';
$icon = 'nc-circle-09';
include __DIR__.'/../template/header.php';

if(!isset($_GET['id']) || !$_GET['id'] ){
  die('Missing id parameter');
}

$st = $mysqli->prepare("select * from users where id = ? limit 1");
$st->bind_param('i', $userId);
$userId = $_GET['id'];
$st->execute();
$user = $st->get_result()->fetch_assoc();
$email = $user['email'];
$name = $user['name'];
$role = $user['role'];
$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['email'])){array_push($errors, "*Email is required");}
  if(empty($_POST['name'])){array_push($errors, "*Name is required");}
  if(empty($_POST['role'])){array_push($errors, "*Role is required");}

  if(!count($errors)){
    $st = $mysqli->prepare("update users set name = ?, email = ?, role = ?, password = ? where id = ?");
    $st->bind_param('ssssi', $dbName, $dbEmail, $dbRole, $dbPassword, $dbId);
    $dbName = $_POST['name'];
    $dbEmail = $_POST['email'];
    $dbRole = $_POST['role'];
    $_POST['password'] ? $dbPassword = password_hash($_POST['password'], PASSWORD_DEFAULT) : $dbPassword = $user['password'];
    $dbId = $_GET['id'];
    $st->execute();

    if($st->error){
      array_push($errors, $st->error);
    }else{
      echo "<script>location.href='index.php'</script>";
    }
  }
}
?>

<?php include __DIR__.'/../template/errors.php' ?>
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
    <label for="role">Role:</label>
    <select class="form-control" name="role" id="role">
      <option></option>
      <option value="user"
        <?php if($role == 'user') echo 'selected' ?>
      >User</option>
      <option value="admin"
      <?php if($role == 'admin') echo 'selected' ?>
      >Admin</option>
    </select>
  </div>
  <div class="form-group">
    <button class="btn btn-success" type="submit" name="button">Update</button>
  </div>
</form>

<?php
include __DIR__.'/../template/footer.php';
