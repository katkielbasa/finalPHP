<?php
/**
 * @author Kasia (based on Luca lab)*/

class Controller{
	private $model;
	private $action;

	public function __construct($model,$action, $body, $parameters){
		$this -> model = $model;
		$this -> action = $action;
		//
		switch($action){
				//route1
			case "ACTION_RETRIEVE_CLASSES_TIME":
				$this -> retrieveClasses($parameters);
				break;
				//route2
			case "ACTION_RETRIEVE_CLASS_BY_ID":
				$this -> retrieveClass($parameters);
				break;
				//route3
			case "ACTION_RETRIVE_STUDENTS_IN_CLASS":
				$this -> retriveStudents($parameters);
				break;
				//route4
			case "ACTION_RETRIVE_ANSWEARS_FOR_STUDENT_IN_CLASS":
				$this ->retriveAnswearsForStudent($parameters);
				break;
				//route5
			case "ACTION_RETRIVE_AVG_ANSWEAR_FOR_STUDENT_IN_CLASS":
				$this ->retriveAvgAnsForStudent($parameters);
				break;
				//route6
			case "ACTION_RETRIVE_ANS_STD_FOR_STUDENT_IN_CLASS":
				$this -> retriveAnsStdForStudent($parameters);
				break;
				//route7
			case "ACTION_RETRIVE_AVG_ANSWEAR_FOR_QUESTION_IN_CLASS":
				$this ->retriveAvgAnsForQuestion($parameters);
				break;
				//route8
			case "ACTION_RETRIVE_ANS_STD_FOR_QUESTION_IN_CLASS":
				$this ->retriveAnsStdForQuestion($parameters);
				break;
				//route9
			case "ACTION_RETRIVE_AVG_ANSWEARS_FOR_CLASS":
				$this->retriveAvgAnsForClass($parameters);
				break;

		}
	}
	//route1
	function retrieveClasses(){
		$list = $this -> model -> getClassesWithTime();
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
	//route2
	function retrieveClass($parameters){
		$list = $this -> model -> getClassById($parameters ["ID"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
	//route3
	function retriveStudents($parameters){
		$list = $this -> model -> getStudents($parameters ["ID"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
	//route4
	function retriveAnswearsForStudent($parameters){
		$list = $this -> model -> getAnswearsForStudent($parameters["ID1"],$parameters["ID2"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
	//route5
	function retriveAvgAnsForStudent($parameters){
		$list = $this -> model ->  getAvaragesForStudent($parameters["ID1"],$parameters["ID2"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);

	}
	//route6
	function  retriveAnsStdForStudent($parameters){
		$list = $this -> model ->  getStdDevForStudent($parameters["ID1"],$parameters["ID2"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
	//route7
	function retriveAvgAnsForQuestion($parameters){
		$list = $this -> model ->  getAvarageAnswearForQuestion($parameters["ID1"],$parameters["ID2"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);

	}
	//route8
	function  retriveAnsStdForQuestion($parameters){
		$list = $this -> model ->  getStdDevForQuestion($parameters["ID1"],$parameters["ID2"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
	//route9
function  retriveAvgAnsForClass($parameters){
		$list = $this -> model -> getAvarageAnswears($parameters["ID1"]);
		if ($list != null){
			$this -> model -> statusCode = "HTTPSTATUS_OK";
		}
		else{
			$this -> model -> statusCode = "HTTPSTATUS_NOCONTENT";
		}
		$this -> model -> prepareOutput($list);
	}
}
?>