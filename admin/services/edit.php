<?php
$title = 'Edit service';
$icon = 'nc-ruler-pencil';
include __DIR__.'/../template/header.php';

if(!isset($_GET['id']) || !$_GET['id'] ){
  die('Missing id parameter');
}

$st = $mysqli->prepare("select * from services where id = ? limit 1");
$st->bind_param('i', $serviceId);
$serviceId = $_GET['id'];
$st->execute();
$service = $st->get_result()->fetch_assoc();
$name = $service['name'];
$price = $service['price'];
$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['name'])){array_push($errors, "*Name is required");}
  if(empty($_POST['price'])){array_push($errors, "*Price is required");}

  if(!count($errors)){
    $st = $mysqli->prepare("update services set name = ?, price = ? where id = ?");
    $st->bind_param('sii', $dbName, $dbPrice, $dbId);
    $dbName = $_POST['name'];
    $dbPrice = $_POST['price'];
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
    <label for="name">Service name: </label>
    <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="" id='name'>
  </div>
  <div class="form-group">
    <label for="price">Service price</label>
    <input type="number" name="price" value="<?php echo $price ?>" class="form-control" placeholder="" id='price'>
  </div>
  <div class="form-group">
    <button class="btn btn-success" type="submit" name="button">Update</button>
  </div>
</form>

<?php
include __DIR__.'/../template/footer.php';
