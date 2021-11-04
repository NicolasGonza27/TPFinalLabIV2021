<?php

    namespace API;

    use Models\JobPosition as JobPosition;

    class ApiJobPositionDAO
    {
        private $jobPositionsList;
        private $apiDirection;
        private $context;

        public function __construct()
        {
            $this->jobPositionsList = array();
            $this->apiDirection = 'https://utn-students-api.herokuapp.com/api/JobPosition';
        
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
            return $this->jobPositionsList;
        }

        public function GetAllByDescription($description) {

            $this->RetrieveData();
            $jobPositionsByDescription = array();

            foreach ($this->jobPositionsList as $jobPosition) {   
                if (substr_compare(strtolower($jobPosition->getFirstName()), strtolower($description), 0, strlen($description)) === 0) {   
                    array_push($jobPositionsByDescription, $jobPosition);
                }
            }
        
            return $jobPositionsByDescription;
        }

        public function GetOne($jobPositionId) {

            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);
            $jobPosition = null;

            if (!empty($arrayToDecode)) {

                foreach ($arrayToDecode as $jobPositionInArray) {
                    if ($jobPositionInArray["jobPositionId"] != $jobPositionId) {
                        continue;
                    }

                    $jobPositionId = $jobPositionInArray["jobPositionId"]; 
                    $careerId = $jobPositionInArray["careerId"];
                    $description = $jobPositionInArray["description"];
                    
                    return $jobPosition = new JobPosition($jobPositionId, $careerId, $description);
                }

                return $jobPosition;
            }
        }

        public function GetOneByCareer($careerId) {

            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);
            $jobPosition = false;

            if (!empty($arrayToDecode)) {

                foreach ($arrayToDecode as $jobPositionInArray) {
                    if ($jobPositionInArray["careerId"] != $careerId) {
                        continue;
                    }

                    $jobPositionId = $jobPositionInArray["jobPositionId"]; 
                    $careerId = $jobPositionInArray["careerId"];
                    $description = $jobPositionInArray["description"];
                    
                    return $jobPosition = new JobPosition($jobPositionId, $careerId, $description);
                }
                
                return $jobPosition;
            }
        }

        public function RetrieveData() {

            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);

            $this->jobPositionsList = array();

            foreach ($arrayToDecode as $jobPositionInArray) {

                $jobPositionId = $jobPositionInArray["jobPositionId"]; 
                $careerId = $jobPositionInArray["careerId"];
                $description = $jobPositionInArray["description"];

                $jobPosition = new JobPosition($jobPositionId, $careerId, $description);

                array_push($this->jobPositionsList, $jobPosition);
            }
        
        }

    }
?>