<?php

namespace Source\Models;

use \Source\Core\Helper;

class Instructor {

  public $id = 0;
  public $isEditor = 0;
  public $name = "";

  public function __construct($id) {
    $this->id = $id;
  }

  public function getFirstName() {
    return Helper::safeString(explode(' ', $this->name)[0]);
  }

}
