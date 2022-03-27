<?php
$title = 'Create product';
$icon = 'nc-cart-simple';
include __DIR__.'/../template/header.php';
require_once __DIR__.'/../../classes/Upload.php';

$errors = [];
$name = $price = $image = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name = mysqli_real_escape_string($mysqli, $_POST['name']);
  $price = mysqli_real_escape_string($mysqli, $_POST['price']);

   if(empty($name)){array_push($errors, "*Name is required");}
   if(empty($price)){array_push($errors, "*Price is required");}
   if(empty($_FILES['image']['name'])){array_push($errors, "*Image is required");}

   $upload = new Upload('uploads/p');
   $upload->file = $_FILES['image'];
   $errors = $upload->upload();


   if(!count($errors)){

     $submitQuery = "insert into products (name, price, image) values ('$name', '$price', '$upload->filePath')";
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
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Product name: </label>
    <input type="text" name="name" value="" class="form-control" placeholder="enter the name of the new product" id='name'>
  </div>
  <div class="form-group">
    <label for="price">Product price: </label>
    <input type="number" name="price" value="" class="form-control" placeholder="enter the price of the new product" id='price'>
  </div>
  <div class="form-group">
    <label for="image">Product image</label>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <button class="btn btn-success">Create</button>
  </div>
</form>

<?php
include __DIR__.'/../template/footer.php';
