<?php
require_once('../Simpletest/autorun.php');
require_once('../app/DB/DAOs/AnswersDAO.php');
require_once('../app/DB/pdoDbManager.php');
require_once('../app/conf/config.inc.php');

class  AnswersDaoTest extends UnitTestCase
{

	public  function  setUp () {
		Mock::generate('pdoDbManager');
		$this->db = new MockpdoDbManager();
		$this->ad = new  AnswearsDAO($this->db);
	}

	public function testGetAnswearsForStudent() {
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
		
		$this->db->expectOnce('prepareQuery', Array(new EqualExpectation($sql)));
		$this->ad->getAnswearsForStudent('studentID', 1234);
	}
	
	public function testgetAvarageAnswears() {
		$this->db->expectOnce('prepareQuery');
		$this->ad->getAvarageAnswears(42);
	}
	
	public  function  tearDown (){
		$this->ad = NULL;
		$this->db = NULL;
	}
}
?>
