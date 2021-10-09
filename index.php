<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";
	require "Config/Constants.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

	require_once(VIEWS_PATH."header.php");

	Router::Route(new Request());

	require_once(VIEWS_PATH."footer.php");

	

	// $options = array(
	// 	'http' => array(
	// 		'method' => "GET",
	// 		'header' => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"
	// 	)
	// );

	// $context = stream_context_create($options);
	// $response = file_get_contents('https://utn-students-api.herokuapp.com/api/Student', false, $context);
	// $arrayToDecode = json_decode($response, true);

	// var_dump($arrayToDecode[0]["firstName"]);


	// use API\ApiStudentController as ApiStudentController;
	// use Models\Student as Student;
	// use Models\Admin as Admin;

	// $apiController = new ApiStudentController();
	// $arrayStudents = $apiController->GetAll();
	// $student = $apiController->GetOne(5);

	// $admin = new Admin("1", "123456", "Name", "Last", "43312532", "email@gmail.com", true);

	// foreach ($arrayStudents as $student) {
		// var_dump($admin);
		// var_dump($admin);
	// }

	// use Models\Company as Company;
	// use DAO\CompanyDAO as CompanyDAO;

	// $companyDAO = new CompanyDAO();
	// $arrayCompany = $companyDAO->GetAll();

	// var_dump($arrayCompany);
	// var_dump("\n---------------------\n");

	// $company = new Company("2", "Firefox", "Norwey", "Garool", "Firlach", false);
	// $companyDAO->Add($company);

	// $arrayCompany = $companyDAO->GetAll();

	// var_dump($arrayCompany);
?>