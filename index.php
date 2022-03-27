<?php
$title='Home';
require_once 'template/header.php';
require 'config/app.php';
require 'config/db_connection.php';
?>
<!-- _body_ -->
<?php $products = $mysqli->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC) ?>
<div class="row">
  <?php foreach($products as $item){ ?>
    <div class="col-mid-4">
      <div class="card mb-3">
        <div><img class="img-fluid" style="width:250px; height:250px;" src="<?php echo $config['app_url'].$item['image'] ?>"></div>
        <h4 class="card-title" style="padding-left:1em;"><?php echo $item['name'] ?></h4>
        <div class="card-body">
          <div class="text-success"><?php echo $item['price'] ?> SAR</div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<?php $mysqli->close(); ?>
<?php require_once 'template/footer.php'; ?>
