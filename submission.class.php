<?php

class Submission extends MySQL {

  const INSTANCE_NAME = "newsletter";
  public $name;
  public $email;
  public $created_at;
  public $errors;

  public function __construct($data = array()) {

    parent::__construct();

    foreach ($data as $key => $value) {
      $this->$key = $value;
    }

	}

  public static function collection() {
    $s = new Submission();
    $q = "SELECT * FROM " . self::INSTANCE_NAME . " ORDER BY created_at desc";
    $r = $s->sql->query($q);

    return $r;
  }

  public function serialize() {
    return array("name" => $this->name,
                 "email" => $this->email);
  }

  public function save() {

    if(!$this->name || !$this->email) {
      throw new BadMethodCallException("Please supply all parameters.");
    }

    try {
  	   parent::store($this->serialize());
    } catch (Exception $e) {
      $this->errors = $e->getMessage();
      return false;
    }

    return true;
  }

}
