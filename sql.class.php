<?php
DEFINE ('DB_USER', 'db_user');
DEFINE ('DB_PASSWORD', 'db_password');
DEFINE ('DB_HOST', 'db_host');
DEFINE ('DB_NAME', 'db_name');

class MySQL {

  protected $sql;

  public function __construct(){

    $mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($mysqli->connect_error) {
    	echo $mysqli->connect_error;
    	unset($mysqli);
    } else {
    	$mysqli->set_charset('utf8');
      $this->sql = $mysqli;
    }
	}

  public function store($data) {
      $table = get_class($this)::INSTANCE_NAME;

      $values = array();

      foreach($data as $key => $value) {
        $values[] = "'" . $this->sql->real_escape_string(trim($value)) . "'";
      }

      $columns = implode(",", array_keys($data));

      $q = "INSERT INTO $table (" . $columns . ") VALUES (" . implode(",", $values) . ")";

      $this->sql->query($q);

      if ($this->sql->affected_rows == 1) {
	$this->sql->close();
	unset($this->sql);
      } else {
	throw new Exception("Could not save to database: " . $this->sql->error);
      }

      return true;
  }
}
