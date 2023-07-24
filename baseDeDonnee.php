<?php

class BaseDeDonnee{
	private $servername = 'localhost';
	private $username;
	private $password;
	private $dbName;

	public function connect(){
		$dsn = "mysql:host=" . $this->servername .";dbname=" . $this->dbName;
		$conn = new PDO($dsn,$this->username,$this->password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}

	public function deconnect(){
		$conn=$this->connect();
		$conn = null;
	}

}