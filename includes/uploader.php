<?php
//DB connection
require_once __DIR__."/../config/db_connection.php";
//error variable setting:
$nameError = $emailError = $documentError = $service_id_Error = $messageError = '';
//value variables setting:
$name = $email = $document = $service_id = $message = '';
$fileName = null;
//upload directory name variable:
$uploadDir = 'uploads';
function filterString($field){
  $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
  if(empty($field)){
    return false;
  }else{
    return $field;
  }
}
function filterEmail($field){
  $field = filter_var(trim($field),FILTER_SANITIZE_EMAIL);
  if(filter_var($field,FILTER_VALIDATE_EMAIL)){
    return $field;
  }else{
    return false;
  }
}
function canUpload($file){
  $allowed = [
    'jpg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif'
  ];

  $fileType = mime_content_type($file['tmp_name']);
  $fileSize = $file['size'];
  $maxFileSize = 1000 * 1024 * 1024 * 1024;

  if($fileSize > $maxFileSize){
    return 'Reduce the size of your document';
  }elseif(!in_array($fileType, $allowed)){
    return 'Change the type of your document';
  }else{
    return true;
  }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //validating name:
  $name = filterString($_POST['name']);
  if(!$name){
    $_SESSIN['contact_form']['name'] = '';
    $nameError = 'Your name is required';
  }else{
    $_SESSION['contact_form']['name'] = $name;
  }
  //Validating email:
  $email = filterEmail($_POST['email']);
  if(!$email){
    $_SESSION['contact_form']['email'] = '';
    $emailError = 'Your Email is required';
  }else{
    $_SESSION['contact_form']['email'] = $email;
  }
  //validating document:
  if(isset($_FILES['document']) && $_FILES['document']['error'] == 0 ){
      //creating a checking tool for the uploading folder before the upload
      $canUpload = canUpload($_FILES['document']);
      if($canUpload === true){
        if(!is_dir($uploadDir)){
            umask(0);
            mkdir($uploadDir, 0775);
        }
        //formatting the uploaded file's name:
        $fileName = time().$_FILES['document']['name'];
        //uploading the file to the upload's file:
        if(file_exists($uploadDir.'/'.$fileName)){
          $documentError = 'File already exist';
        }else{
          move_uploaded_file($_FILES['document']['tmp_name'],  $uploadDir.'/'.$fileName);
        }
      }else{
        $documentError = $canUpload;
      }
  }else{
    $documentError = 'You must upload a file';
  }
  //validating services:
  $insertService_id = $_POST['service_id'];
  if($insertService_id){
    $_SESSION['contact_form']['service_id'] = $insertService_id;
  }else{
    $_SESSION['contact_form']['service_id'] = '';
    $service_id_Error = 'You have to choose a service!';
  }
  //validating message:
  $message = filterString($_POST['message']);
  if(!$message){
    $_SESSION['contact_form']['message']='';
    $messageError = 'Your messgae is required';
  }else{
    $_SESSION['contact_form']['message']=$message;
  }


  if(!$nameError && !$emailError && !$messageError){
    
    $fileName ? $filePath =  $uploadDir.'/'.$fileName : $filePath = '';

//    $insertForms =
//      "insert into forms (contact_name, contact_email, contact_document, message, service_id)".
//      "values('$name', '$email', '$filePath', '$message', '$insertService_id')";
//    $mysqli->query($insertForms);

    $statement = $mysqli->prepare("insert into forms
      (contact_name, contact_email, contact_document, message, service_id )
      values(?, ?, ?, ?, ?)");
    //string s, integer i, double d, binary b
    $statement->bind_param('ssssi', $dbContanctName, $dbEmail, $dbDocument, $dbMessage, $dbServiceId);
    $dbContanctName = $name;
    $dbEmail = $email;
    $dbDocument = $filePath;
    $dbMessage = $message;
    $dbServiceId = $_POST['service_id'];

    $statement->execute();

    header('location: index.php');
    die();
  }
}
