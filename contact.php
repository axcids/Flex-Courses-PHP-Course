<?php
$title= 'Contact';
include_once('includes/uploader.php');
require_once 'template/header.php';


$service = $mysqli->query("select * from services order by name")->fetch_all(MYSQLI_ASSOC);
?>


<!-- Start of the form -->
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
  <!-- Name -->
  <div class="form-group">
    <label for="name">Your Name</label>
    <input type="text" name="name" value="<?php if(isset($_SESSION['contact_form']['name']))echo $_SESSION['contact_form']['name'] ?>" class="form-control" placeholder="Enter Your Name">
    <span class="text-danger"><?php echo $nameError ?></span>
  </div>
  <!-- Email -->
  <div class="form-group">
    <label for="email">Your Email</label>
    <input type="email" name="email" value="<?php if(isset($_SESSION['contact_form']['email']))echo $_SESSION['contact_form']['email'] ?>" class="form-control" placeholder="Enter Your Email">
    <span class="text-danger"><?php echo $emailError ?></span>
  </div>
  <!-- Upload -->
  <div class="form-group">
    <label for="document">Upload a File</label>
    <input type="file" name="document" value="<?php echo $document ?>">
    <span class="text-danger"><?php echo $documentError ?></span>
  </div>
  <!-- Services -->
  <div class="form-group">
    <label for="services">Choose a Service</label>
    <select name="service_id" id="services" class="form-control">
      <?php foreach($service as $services){ ?>
        <option value="<?php echo $services['id']?>">
          <?php echo $services['name'] ?>
          (<?php echo $services['price']?>)<span> SAR</span>
        </option>
      <?php } ?>
    </select>
    <span class="text-danger"><?php echo $service_id_Error ?></span>
  </div>
  <!-- Message -->
  <div class="form-group">
    <label for="message">Enter a message</label>
    <textarea name="message" class="form-control" placeholder="Enter Your Message"><?php if(isset($_SESSION['contact_form']['message']))echo $_SESSION['contact_form']['message'] ?></textarea>
      <span class="text-danger"><?php echo $messageError ?></span>
  </div>
  <!-- Submit -->
  <button class="btn btn-primary">Send</button>

<!-- End of the Form -->
</form>
<?php require_once 'template/footer.php'?>
