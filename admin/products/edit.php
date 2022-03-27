<?php
$title = 'Edit product';
$icon = 'nc-cart-simple';
include __DIR__.'/../template/header.php';
require_once __DIR__.'/../../classes/Upload.php';

if(!isset($_GET['id']) || !$_GET['id'] ){
  die('Missing id parameter');
}

$st = $mysqli->prepare("select * from products where id = ? limit 1");
$st->bind_param('i', $productId);
$productId = $_GET['id'];
$st->execute();
$product = $st->get_result()->fetch_assoc();
$name = $product['name'];
$price = $product['price'];
$image = $product['image'];
$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['name'])){array_push($errors, "*Name is required");}
  if(empty($_POST['price'])){array_push($errors, "*Price is required");}

  if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $upload = new Upload('uploads/p');
    $upload->file = $_FILES['image'];
    $errors = $upload->upload();

    if(!count($errors)){
      $image = $upload->filePath;
    }
  }

  if(!count($errors)){
    $st = $mysqli->prepare("update products set name = ?, price = ?, image = ? where id = ?");
    $st->bind_param('sdsi', $dbName, $dbPrice, $dbImage, $dbId);
    $dbName = $_POST['name'];
    $dbPrice = $_POST['price'];
    $dbImage = $image;
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
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Product name: </label>
    <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="" id='name'>
  </div>
  <div class="form-group">
    <label for="price">Service price</label>
    <input type="number" name="price" value="<?php echo $price ?>" class="form-control" placeholder="" id='price'>
  </div>
  <div class="form-group">
    <label for="image">Product image</label>
    <div class="" style="padding:10px;">
      <img src="<?php echo $config['app_url'].'/'.$image ?>" class="img-thumbnail" alt="" width="150">
    </div>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <button class="btn btn-success" type="submit" name="button">Update</button>
  </div>
</form>

<?php
include __DIR__.'/../template/footer.php';
