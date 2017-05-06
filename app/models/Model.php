<?php
/**
 * @author Kasia (based on Luca lab)
 *Model
 */
require_once 'DB/pdoDbManager.php';
require_once 'DB/DAOs/StudentsDAO.php';
require_once 'DB/DAOs/ClassesDao.php';
require_once 'DB/DAOs/AnswearsDAO.php';
class Model{
	public $output;
	public $statusCode;
	public $dbmanager;
	public $aDao;
	public $sDao;
	public $cDao;

	public function __construct(){
		$this -> dbmanager = new pdoDBManager();
		$this -> aDao = new AnswearsDAO($this->dbmanager);
		$this -> sDao = new StudentsDAO($this->dbmanager);
		$this -> cDao = new ClassesDAO($this->dbmanager);
		$this -> dbmanager -> openConnection();
	}
	public function destruct(){
		$this -> dbmanager -> closeConnection();
	}

	//route 1
	public function getClassesWithTime(){
		return($this->cDao-> getClassesWithTime());
	}
	//route 2
	public function getClassById($ID){
		return ($this-> cDao -> getClassByID(($ID)));
	}
	//route 3
	public function getStudents($ID){
		return ($this->sDao -> getStudents($ID));
	}
	//route4
	public function getAnswearsForStudent($ID1,$ID2){
		return ($this->aDao -> getAnswearsForStudent($ID1,$ID2));
	}
	//route 5
	public function getAvaragesForStudent($ID1,$ID2) {
		return ($this->aDao->getAvarageAnswearForStudent($ID1,$ID2));
	}

	//route 6
	public function  getStdDevForStudent($ID1,$ID2){
		return ($this->aDao->getStdDevForStudent($ID1,$ID2));
	}

	//route 7
	public function  getAvarageAnswearForQuestion($ID1,$ID2){
		return ($this->aDao-> getAvarageAnswearForQuestion($ID1,$ID2));
	}

	//route 8
	public function getStdDevForQuestion($ID1,$ID2){
		return ($this->aDao-> getStdDevForQuestion($ID1,$ID2));
	}
	
	//route 9
	public function getAvarageAnswears($ID1){
		return ($this->aDao->getAvarageAnswears($ID1));
	}


	public function prepareOutput($message){
		$this -> output = $message;
	}
}
?>