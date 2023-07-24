<?php

class BaseDeDonnee{
	private $servername = 'localhost';
	private $username;
	private $password;
    private $dbName;
    
    public function __construct($dbName,$username,$password){
		$this->dbName = $dbName;
		$this->username = $username;
		$this->password = $password;
	}

    public function connexion(){
		try{
			$conn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	return $conn;
		}
		catch(PDOException $e){
			echo "Erreur de connexion: " . $e->getMessage();
		}
	}

	public function deconnexion()
	{
		$conn=$this->connexion();
		$conn = null;
		echo "Base de donné fermé";
	}
}