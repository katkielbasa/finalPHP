<?php
/**
 * @author Kasia (based on Luca lab)
 * definition of the DAO (database access object)
 */
class StudentsDAO {
	private $dbManager;
	function StudentsDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}

	//Function for route 3: GET: /classes/ID/students(retrieve the list of students associated to
	// a certain class returning id, gender and mother tongue)
	function getStudents($ID1) {
		$sql = "SELECT u.id_user, u.gender, u.mothertongue 
		FROM user as u 
		left join classes as c
		on c.classID = u.classID 
		where c.classID = :ID1 ORDER BY u.classID";
		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}
	
}
?>
