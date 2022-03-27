<?php
$title = 'Settings';
$icon = 'nc-settings-gear-64';
include __DIR__.'/../template/header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare("update settings set admin_email = ?, app_name = ? where id = 1");
  $st->bind_param('ss', $dbAdminEmail, $dbAppName);
  $dbAdminEmail = $_POST['admin_email'];
  $dbAppName = $_POST['app_name'];
  $st->execute();

  echo "<script> location.href = 'index.php' </script>";
}

?>

<div class="container">
  <form class="" action="" method="post">
    <div class="form-group">
      <label for="app_name">Application name: </label>
      <input type="text" name="app_name" value="<?php echo $config['app_name'] ?>" id="app_name" class="form-control">
    </div>
    <div class="form-group">
       <label for="admin_email">Admin email:  </label>
       <input type="email " name="admin_email" value="<?php echo $config['admin_email'] ?>" id="admin_email" class="form-control">
    </div>
    <div class="form-group">
      <button type="submit" name="button" class="btn btn-success">Update settings</button>
    </div>
  </form>
</div>
<?php
include __DIR__.'/../template/footer.php';
