<?php
/*Kasia*/
session_start ();

require_once '../Slim/Slim.php';
Slim\Slim::registerAutoloader ();
$app = new \Slim\Slim (); // slim run-time object
require_once 'conf/config.inc.php'; // include configuration file
require_once 'conf/en_message_config.php'; // include configuration file

// route middleware for simple API authentication
function authenticate(\Slim\Route $route) {
	$app = \Slim\Slim::getInstance();
	$username = $app->request->headers->get('X-Auth-Username');
	$password = $app->request->headers->get('X-Auth-Password');
	if ($username != USERNAME || $password != PASSWORD){
		$app->halt(401);
	}
}
include "/models/Model.php";
include "/controllers/Controller.php";
include "/views/View.php";
//route1
$app->map ( "/classes", "authenticate", function () use($app) {
	$httpMethod = $app->request->getMethod ();
	//$parameters["id"] = $ID;
	$model = new Model();
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIEVE_CLASSES_TIME", '', null);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	// echo $view -> jsonOutput();
	// return response to client (as a json string)
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));

	$app->response->status ($model->statusCode);
})->via("GET");

//route2
$app->map ( "/classes/(:ID)", "authenticate", function ($ID = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID" => $ID);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIEVE_CLASS_BY_ID", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	// echo $view -> jsonOutput();
	// return response to client (as a json string)
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));
	$app->response->status ($model->statusCode);
})->via("GET");
//route3
$app->map ( "/classes/(:ID)/students", "authenticate", function ($ID = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID" => $ID);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_STUDENTS_IN_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	// echo $view -> jsonOutput();
	// return response to client (as a json string)
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));
	$app->response->status ($model->statusCode);
})->via("GET");
//route4
$app->map ( "/classes/(:ID1)/students/(:ID2)", "authenticate", function ($ID1 = null, $ID2 = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID1" => $ID1, "ID2" => $ID2);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_ANSWEARS_FOR_STUDENT_IN_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	// echo $view -> jsonOutput();
	// return response to client (as a json string)
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));
	$app->response->status ($model->statusCode);
})->via("GET");
//route5
$app->map ( "/classes/(:ID1)/students/(:ID2)/avg", "authenticate", function ($ID1 = null, $ID2 = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID1" => $ID1, "ID2" => $ID2);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_AVG_ANSWEAR_FOR_STUDENT_IN_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	// echo $view -> jsonOutput();
	// return response to client (as a json string)
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));
	$app->response->status ($model->statusCode);
})->via("GET");
//route6
$app->map ( "/classes/(:ID1)/students/(:ID2)/std", "authenticate", function ($ID1 = null, $ID2 = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID1" => $ID1, "ID2" => $ID2);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_ANS_STD_FOR_STUDENT_IN_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));

	$app->response->status ($model->statusCode);
})->via("GET");
//route7
$app->map ( "/classes/(:ID1)/answers/(:ID2)/avg", "authenticate", function ($ID1 = null, $ID2 = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID1" => $ID1, "ID2" => $ID2);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_AVG_ANSWEAR_FOR_QUESTION_IN_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));

	$app->response->status ($model->statusCode);
})->via("GET");

//route8
$app->map ( "/classes/(:ID1)/answers/(:ID2)/std", "authenticate", function ($ID1 = null, $ID2 = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID1" => $ID1, "ID2" => $ID2);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_ANS_STD_FOR_QUESTION_IN_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));

	$app->response->status ($model->statusCode);
})->via("GET");
//route 9
$app->map ( "/classes/(:ID1)/answers/avg", "authenticate", function ($ID1 = null) use($app) {
	$httpMethod = $app->request->getMethod ();
	$model = new Model();
	$parameters = array("ID1" => $ID1);
	switch ($httpMethod) {
		case "GET" :
			$controller = new Controller($model, "ACTION_RETRIVE_AVG_ANSWEARS_FOR_CLASS", '', $parameters);
			break;
		default:
			$model->statusCode = "HTTPSTATUS_BADREQUEST";
	}
	$view = new View($controller, $model);
	// echo $view -> jsonOutput();
	// return response to client (as a json string)
	if ($model->output != null)
	$app->response->write ($view->output($app->request->headers->get("Accept")));
	$app->response->status ($model->statusCode);
})->via("GET");
/*
 $app->map ( "/classes/(:ID)", "authenticate", function ($ID = null) use($app) {
 $body = $app->request->getBody (); // get the body of the HTTP request (from client)
 $decBody = json_decode ( $body, true ); // this transform the string into an associative array
 $httpMethod = $app->request->getMethod ();
 $parameters["id"] = $ID;
 switch ($httpMethod) {
 case "GET" :
 $action = "ACTION_RETRIEVE_CLASS_BY_ID;
 break;
 default:
 $responseCode = "HTTPSTATUS_BADREQUEST";
 }
 }

 echo $view -> jsonOutput();

 $dbmanager = closeConnection();

 // return response to client (as a json string)
 if ($responseBody != null)
 $app->response->write ( json_encode ( $responseBody ) ); // this is the body of the response

 $app->response->status ( $responseCode );
 } )->via ( "GET", "POST", "PUT", "DELETE" );
 */
$app->run ();


?>