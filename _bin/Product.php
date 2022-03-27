<?php
class Product extends Service{

  public function all(){
    return [
      ['name' => 'phone', 'price' => '500'],
      ['name' => 'keyboard', 'price' => '100'],
      ['name' => 'mouse', 'price' => '50'],
    ];
  }
}
