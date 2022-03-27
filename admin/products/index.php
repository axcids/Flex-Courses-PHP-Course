<?php
$title = 'Products';
$icon = 'nc-cart-simple';
include __DIR__.'/../template/header.php';

$products = $mysqli->query('select * from products order by id')->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare("delete from products where id = ?");
  $st->bind_param('i',$productId);
  $productId = $_POST['product_id'];
  $st->execute();

  if($_POST['image']){
    unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_POST['image']);
  }

  echo "<script>location.href = 'index.php'</script>";
}

?>
<a class="nav-item active" href="create.php">
  <i class="nc-icon nc-simple-add"></i>
<p style="display:inline;">Add new product</p>
</a>
<p style="float:right;">Products: <?php echo count($products) ?></p>

<div> <!-- Fix this shit -->
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th width="0">#</th>
          <th>name</th>
          <th>price</th>
          <th>image</th>
          <th width="250">Actions</th>
        </tr>
      </thead>
        <tbody >
          <?php foreach ($products as $product): ?>
            <tr>
               <td><?php echo$product['id'] ?></td>
               <td><?php echo$product['name'] ?></td>
               <td><?php echo$product['price'] ?></td>
               <td><img src="<?php echo $config['app_url'].$product['image'] ?>" width="50" alt=""></td>
               <td>
                 <div class="" style="padding:0.5em;">
                   <a href="edit.php?id=<?php echo$product['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                   <form class="" style="display:inline;" action="" method="post">
                     <input type="hidden" name="product_id" value="<?php echo$product['id'] ?>">
                     <input type="hidden" name="image" value="<?php echo$product['image'] ?>">
                     <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" type="submit" name="delete">Delete</button>
                   </form>
                 </div>
               </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

<?php
include __DIR__.'/../template/footer.php';
