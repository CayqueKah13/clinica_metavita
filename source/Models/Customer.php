<?php

namespace Source\Models;

use \Source\Core\Helper;

class Customer {

  public $id = 0;
  public $name = "";
  public $email = "";
  public $cpf = "";
  public $img = "";
  public $phone = "";

  public function __construct($id) {
    $this->id = $id;
  }

  public function getFirstName() {
    return Helper::safeString(explode(' ', $this->name)[0]);
  }

}
