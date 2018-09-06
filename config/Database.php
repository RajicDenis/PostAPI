<?php

class Database {

	// Properties
	private $dbHost = 'localhost';
	private $dbUser = 'root';
	private $dbPass = '';
	private $dbName = 'posts';

	private $dbh;

	public function connect() {

		$dsn = 'mysql:host=' . $this->dbHost .';dbname=' . $this->dbName . '';

		try {

			$this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass);

			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $this->dbh;

		} catch(PDOException $e) {

			echo $e->getMessage();

		}

	}

}