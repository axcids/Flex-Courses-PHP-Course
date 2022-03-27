<?php
class Service {
  public $available = false;
  private $taxRate = 0;

  //constructor
  public function __construct(){
    $this->available = true;
  }
  public function __destruct(){

  }
  public function all(){
    return [
      ['name' => 'Consultation', 'price' => '500', 'days' => ['Sun' , 'Mon']],
      ['name' => 'Training', 'price' => '200', 'days' => ['Tue' , 'Wed']],
      ['name' => 'Design', 'price' => '100', 'days' => ['Thu' , 'Fri']],
      ['name' => 'Coding', 'price' => '1000', 'days' => ['Sat' , 'Fri']],
    ];
  }
  public function setTaxRate($newTaxRate){
    $this->taxRate = $newTaxRate;
  }
  public function totalPrice($price){
    $tax;
    if($this->taxRate > 0){
      $tax = ($price / 100) * $this->taxRate;
      return $price + $tax;
    }else{
      return $price;
    }
  }
}
