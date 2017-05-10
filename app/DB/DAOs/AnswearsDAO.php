<?php
/**
 * @author Kasia (based on Luca lab)
 * definition of the DAO (database access object)
 */

class AnswearsDAO {
	private $dbManager;
	function AnswearsDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}

	//4.GET: /classes/ID1/students/ID2 (retrieve the list of answers associated to a certain student ID2,
	//for a certain class ID1, returning the title of the question (en english), and the answered value)
	function getAnswearsForStudent($ID1,$ID2) {
		
		$sql = 	"select a.answered_value, qi.title"
				. " from answers as a"
				. " left join questions as q"
				. " on a.id_question = q.id"
				. " left join questions_in_languages as qi"
				. " on qi.idquestion = q.id"
				. " left join classes as cl"
				. " on a.classID = cl.classID"
				. " left join user as u"
				. " on u.classID = cl.classID"
				. " left join languages as l"
				. " on l.id = qi.idlanguage"
				. " WHERE l.id = 1"
				. " and cl.classid = :ID1"
				. " and u.id_user = :ID2";
		
		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID2',$ID2,$this->dbManager->INT_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}


	//5. GET: /classes/ID1/students/ID2/avg
	// (retrieve the average of the answers of a certain students ID2, associated to a certain class ID1)

	function getAvarageAnswearForStudent($ID1,$ID2) {
		$sql = "select avg(a.answered_value)"
		. " from answers as a"
		. " left join questions as q"
		. " on a.id_question = q.id"
		. " left join questions_in_languages as qi"
		. " on qi.idquestion = q.id"
		. " left join classes as cl"
		. " on a.classID = cl.classID"
		. " left join user as u"
		. " on u.classID = cl.classID"
		. " WHERE cl.classid = :ID1"
		. " and u.id_user = :ID2";
		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID2',$ID2,$this->dbManager->INT_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}
	//6. GET: /classes/ID1/students/ID2/std
	//(retrieve the standard deviation of the answers of a certain student ID2, associated to a certain class ID1)

	function getStdDevForStudent($ID1,$ID2){
		$sql = "select std(a.answered_value)"
		. " from answers as a"
	    . " left join questions as q"
		. " on a.id_question = q.id"
		. " left join questions_in_languages as qi"
		. " on qi.idquestion = q.id"
		. " left join classes as cl"
		. " on a.classID = cl.classID"
		. " left join user as u"
		. " on u.classID = cl.classID"
		. " WHERE cl.classid = :ID1"
		. " and u.id_user = :ID2";
		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID2',$ID2,$this->dbManager->INT_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}

	//7. GET: /classes/ID1/answers/ID2/avg
	//(retrieve the average of the answers of question with ID2, associated to a certain class ID1)

	function getAvarageAnswearForQuestion($ID1,$ID2) {
		$sql = "select avg(a.answered_value)"
		. " from answers as a"
		. " left join questions as q"
		. " on a.id_question = q.id"
		. " left join questions_in_languages as qi"
		. " on qi.idquestion = q.id"
		. " left join classes as cl"
		. " on a.classID = cl.classID"
		. " WHERE cl.classid = :ID1"
		. " and a.id_question = :ID2";

		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID2',$ID2,$this->dbManager->INT_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}


// 8. GET: /classes/ID1/answers/ID2/std
// (retrieve the standard deviation of the answers of question with ID2, associated to a certain class ID1)

	function getStdDevForQuestion($ID1,$ID2) {
		$sql = "select std(a.answered_value)"
		. " from answers as a"
		. " left join questions as q"
		. " on a.id_question = q.id"
		. " left join questions_in_languages as qi"
		. " on qi.idquestion = q.id"
		. " left join classes as cl"
		. " on a.classID = cl.classID"
		. " WHERE cl.classid = :ID1"
		. " and a.id_question = :ID2";

		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID2',$ID2,$this->dbManager->INT_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}

//9. GET: /classes/ID1/answers/avg 
//(retrieve the average of the answers, associated to a certain class ID1, grouped by questionID)
function getAvarageAnswears($ID1) {
		$sql = "select avg(a.answered_value)"
		. " from answers as a"
		. " left join questions as q"
		. " on a.id_question = q.id"
		. " left join questions_in_languages as qi"
		. " on qi.idquestion = q.id"
		. " left join classes as cl"
		. " on a.classID = cl.classID"
		. " WHERE cl.classid = :ID1"
		. " group by a.id_question";

		$stmt = $this -> dbManager -> prepareQuery($sql);
		$bindedstmt = $this -> dbManager -> bindValue($stmt,':ID1',$ID1,$this->dbManager->STRING_TYPE);
		$result = $this->dbManager->executeQuery ( $stmt );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}

}
?>
