<?php

namespace Source\Core;
use PDO;

class Database extends PDO {

	var $pdo;

	// MARK: - Init Method
	public function __construct() {
		$this->pdo = new PDO ("mysql:host=localhost;dbname=".Config::DATABASE_NAME, Config::DATABASE_USER, Config::DATABASE_PASSWORD,
		    array (PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	// MARK: - Query Methods
	// Execute a query on DataBase and return success or failed
	public function query($rawQuery) {
		$stmt = $this->pdo->prepare($rawQuery);
		$stmt->execute();
		$count = $stmt->rowCount();
		return $count > 0;
	}

	// Execute a query and fetch result as associative array
	public function select($rawQuery) {
		$stmt = $this->pdo->prepare($rawQuery);
		$stmt->execute();
		// $stmt = $this->query($rawQuery);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public function getLastInsertId() {
		return (int)($this->pdo->lastInsertId());
	}

}

?>
