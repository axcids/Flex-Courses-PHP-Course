<div class="row">
  <?php foreach($service->all() as $services){ ?>
    <div class = "col-md-4">
      <div class="card">
        <h4 class="card-header" style= "text-align:center;"><?php echo $services['name'] ?></h4>
        <div class="card-body">
          <p>Price: <?php echo $services['price'] ?> </p>
          <p>Work days:
            <?php foreach($services['days'] as $day){ ?>
              <span><?php echo '['.$day.']'?></span>
            <?php } ?>
          </p>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<hr>
<div class="row">
  <?php foreach($product->all() as $products){ ?>
    <div class = "col-md-4">
      <div class="card">
        <h4 class="card-header" style= "text-align:center;"><?php echo $products['name'] ?></h4>
        <div class="card-body">
          <p>Price: <?php echo $product->totalPrice($products['price']) ?> </p>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
