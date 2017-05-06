<?php
/**
 * @author Kasia (based on Luca lab)
 * definition of the DAO (database access object)
 */
class ClassesDAO {
	private $dbManager;
	function ClassesDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}

	//Function for route 1: retrieve the list of classes, returning, for each record, 
	//title and lenght in minutes where deactivation_date is the timestamp 
	//associated to the end of the class, and activation_date is the timestamp associated to the beginning of the class
	function getClassesWithTime() {
		$sql = "SELECT title, (deactivation_date - activation_date)/60 as lenght FROM classes ORDER BY classID";
		$stmt = $this -> dbManager -> prepareQuery($sql);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}
	//Function for route 2: GET: /classes/ID (retrieve the information related to a certain class, returning all the fields)
	function getClassById($ID){
		$sql = "SELECT classID, title, activation_date, deactivation_date FROM classes WHERE classID = ?";
		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,1,$ID,$this->dbManager->STRING_TYPE);
		$result = $this-> dbManager->executeQuery ($bindedstmt);
		$arrayOfResults = $this-> dbManager->fetchResults ($result);
		return $arrayOfResults;
	}
}
?>
