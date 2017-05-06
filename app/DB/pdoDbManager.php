<?php
/*Web Application Architectures - Lab 6
Dearbhail Kirwan - D13128910*/
/**
 * @author luca
 * a basic implementation of a database manager usng the PDO php object
 */

class pdoDbManager{
	private $db_link;
	private $hostname = DB_HOST;
	private $username = DB_USERNAME;
	private $password = DB_PASSWORD;
	private $dbname = DB_NAME;
	private $charset = DB_CHARSET;
	private $debugMode = DB_DEBUGMODE;
	private $dbVendor = DB_VENDOR; 

	public $INT_TYPE = PDO::PARAM_INT;
	public $STRING_TYPE = PDO::PARAM_STR;

	function __construct(){
	}

	function openConnection(){
		try {
			$connectionStr = $this->dbVendor . ":host=" . $this->hostname . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
			$this->db_link = new PDO($connectionStr, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}
		catch (PDOException $e) {
			if($this->debugMode){
				echo FAILED_CONNECTION . $e->getMessage();
			}
			exit;
		}
	}

	function prepareQuery($query){
		$stmt = $this->db_link->prepare($query);
		return $stmt;
	}

	function bindValue($stmt, $pos, $value, $type){
		$stmt->bindValue($pos, $value, $type);
		return $stmt;
	}

	function executeQuery($stmt){
		$stmt->execute();
		return $stmt;
	}

	function fetchResults($stmt){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return ($rows);
	}

	function getNextRow($stmt){
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return ($result);
	}

	function closeConnection(){
		$this->db_link = null;
	}
}
?>
