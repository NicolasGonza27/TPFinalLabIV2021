<?php

    namespace API;

    use Models\Student as Student;

    class ApiStudentController
    {
        private $studentsList;
        private $apiDirection;
        private $context;

        public function __construct()
        {
            $this->studentsList = array();
            $this->apiDirection = 'https://utn-students-api.herokuapp.com/api/Student';
        
            $this->context = stream_context_create(
                array(
                    'http' => array(
                        'method' => "GET",
                        'header' => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"
                    )
                )
            );
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->studentsList;
        }

        public function GetAllByFirstName($firsName)
        {
            $this->RetrieveData();
            $studentsByFirstName = array();

            foreach ($this->studentsList as $student) {   
                if (substr_compare(strtolower($student->getTitle()), strtolower($firsName), 0, strlen($firsName)) === 0) {   
                    array_push($studentsByFirstName, $student);
                }
            }
        
            return $studentsByFirstName;
        }

        /**
         * Retorna los Student con $birthDate mayor o igual a la $date indicada
         */
        public function GetAllByBirthDate($date)
        {   
            $this->RetrieveData();
            $studentsByBirthDate= array();

            foreach ($this->studentsList as $student) {   
                if ($student->getRelease_date() >= $date) {   
                    array_push($studentsByBirthDate, $student);
                }
            }
        
            return $studentsByBirthDate;
        }

        public function GetOne($studentId)
        {
            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);
            $student = null;

            if (!empty($arrayToDecode)) {

                foreach ($arrayToDecode as $studentInArray) {
                    if ($studentInArray["studentId"] != $studentId) {
                        continue;
                    }

                    $studentId = $studentInArray["studentId"]; 
                    $careerId = $studentInArray["careerId"];
                    $firstName = $studentInArray["firstName"];
                    $lastName = $studentInArray["lastName"];
                    $dni = $studentInArray["dni"];
                    $fileNumber = $studentInArray["fileNumber"];
                    $gender = $studentInArray["gender"];
                    $birthDate = date($studentInArray["birthDate"]);
                    $email = $studentInArray["email"];
                    $phoneNumber = $studentInArray["phoneNumber"];
                    $active = $studentInArray["active"];
                    
                    return $student = new Student($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active);
                }
            }
        }

        public function RetrieveData()
        {
            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);

            $this->studentsList = array();

            foreach ($arrayToDecode as $studentInArray) {

                $studentId = $studentInArray["studentId"]; 
                $careerId = $studentInArray["careerId"];
                $firstName = $studentInArray["firstName"];
                $lastName = $studentInArray["lastName"];
                $dni = $studentInArray["dni"];
                $fileNumber = $studentInArray["fileNumber"];
                $gender = $studentInArray["gender"];
                $birthDate = date($studentInArray["birthDate"]);
                $email = $studentInArray["email"];
                $phoneNumber = $studentInArray["phoneNumber"];
                $active = $studentInArray["active"];

                $student = new Student($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active);

                array_push($this->studentsList, $student);
            }
        
        }

    }
?>