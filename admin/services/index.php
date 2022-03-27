<?php
$title = 'Services';
$icon = 'nc-ruler-pencil';
include __DIR__.'/../template/header.php';

$services = $mysqli->query('select * from services order by id')->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare("delete from services where id = ?");
  $st->bind_param('i',$serviceId);
 $serviceId = $_POST['service_id'];
  $st->execute();

  echo "<script>location.href = 'index.php'</script>";
}

?>
<a class="nav-item active" href="create.php">
  <i class="nc-icon nc-simple-add"></i>
<p style="display:inline;">Add new service</p>
</a>
<p style="float:right;">Services: <?php echo count($services) ?></p>

<div> <!-- Fix this shit -->
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th width="0">#</th>
          <th>name</th>
          <th>price</th>
          <th width="250">Actions</th>
        </tr>
      </thead>
        <tbody >
          <?php foreach ($services as $service): ?>
            <tr>
               <td><?php echo$service['id'] ?></td>
               <td><?php echo$service['name'] ?></td>
               <td><?php echo$service['price'] ?></td>
               <td>
                 <div class="" style="padding:0.5em;">
                   <a href="edit.php?id=<?php echo$service['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                   <form class="" style="display:inline;" action="" method="post">
                     <input type="hidden" name="service_id" value="<?php echo$service['id'] ?>">
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
