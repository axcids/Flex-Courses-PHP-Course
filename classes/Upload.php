<?php

class Upload{

  protected $uploadDir;
  protected $defaultUploadDir = 'uploads';
  public $file;
  public $fileName;
  public $filePath;
  protected $rootDir;
  protected $errors = [];

  //Class constructer :-
    //Parameters :
      //1- The folder in which we will save the uploaded files in.
      //2- The path in which the server is holding the whole website, and it is optional because it has a false value.
  public function __construct($uploadDir, $rootDir = false){
    if($rootDir){
      $this->rootDir = $rootDir;
    }else{
      $this->rootDir = $_SERVER['DOCUMENT_ROOT'].'/'; //*******Check again*********
    }
    $this->filePath = $uploadDir;
    $this->uploadDir = $this->rootDir.'/'.$uploadDir;
  }
  protected function validate(){
    if(!$this->isSizeAllowed()){
      array_push($this->errors, 'File Size is not allowed');
    }elseif(!$this->isMimeAllowed()){
      array_push($this->errors, 'File type is not allowed');
    }
    return $this->errors;
  }
  protected function createUploadDir(){
    if(!is_dir($this->uploadDir)){
      umask(0);
      if(!mkdir($this->uploadDir)){
        array_push($this->errors, 'could not create upload directory');
        return false;
      }
    }
    return true;
  }
  public function upload(){

    $this->fileName = time().$this->file['name'];
    $this->filePath .= '/'.$this->fileName;

    if($this->validate()){
        return $this->errors;
    }elseif(!$this->createUploadDir()){
        return $this->errors;
    }elseif(!move_uploaded_file($this->file['tmp_name'], $this->uploadDir.'/'.$this->fileName)){
        array_push($this->errors, 'Error uploading your file');
    }
    return $this->errors;
}
  protected function isMimeAllowed(){
    $allowed = [
      'jpg' => 'image/jpeg',
      'png' => 'image/png',
      'gif' => 'image/gif',
    ];
    $fileMimeType = mime_content_type($this->file['tmp_name']);
    if(!in_array($fileMimeType, $allowed)){
      return false;
    }
    return true;
  }
  protected function isSizeAllowed(){
    $maxFileSize = 1000 * 1024 * 1024;
    $fileSize = $this->file['size'];
    if($fileSize > $maxFileSize){
       return false;
    }
    return true;
  }


}
