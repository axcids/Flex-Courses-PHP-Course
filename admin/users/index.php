<?php
$title = 'Users';
$icon = 'nc-circle-09';
include __DIR__.'/../template/header.php';

$users = $mysqli->query('select * from users order by id')->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare("delete from users where id = ?");
  $st->bind_param('i', $userId);
  $userId = $_POST['user_id'];
  $st->execute();

  echo "<script>location.href = 'index.php'</script>";
}

?>
<a class="nav-item active" href="create.php">
  <i class="nc-icon nc-simple-add"></i>
<p style="display:inline;">Create a new user</p>
</a>
<p style="float:right;">Users: <?php echo count($users) ?></p>

<div> <!-- Fix this shit -->
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th width="0">#</th>
          <th>Email</th>
          <th>Name</th>
          <th>Role</th>
          <th width="250">Actions</th>
        </tr>
      </thead>
        <tbody >
          <?php foreach ($users as $user): ?>
            <tr>
               <td><?php echo $user['id'] ?></td>
               <td><?php echo $user['email'] ?></td>
               <td><?php echo $user['name'] ?></td>
               <td><?php echo $user['role'] ?></td>
               <td>
                 <div class="" style="padding:0.5em;">
                   <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                   <form class="" style="display:inline;" action="" method="post">
                     <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
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
