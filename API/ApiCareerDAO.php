<?php

    namespace API;

    use Models\Career as Career;

    class ApiCareerDAO
    {
        private $careersList;
        private $apiDirection;
        private $context;

        public function __construct()
        {
            $this->careersList = array();
            $this->apiDirection = 'https://utn-students-api.herokuapp.com/api/Career';
        
            $this->context = stream_context_create(
                array(
                    'http' => array(
                        'method' => "GET",
                        'header' => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"
                    )
                )
            );
        }

        public function GetAll($active = true)
        {
            $this->RetrieveData($active);
            return $this->careersList;
        }

        public function GetAllByDescription($description) {

            $this->RetrieveData();
            $careersByDescription = array();

            foreach ($this->careersList as $career) {   
                if (substr_compare(strtolower($career->getFirstName()), strtolower($description), 0, strlen($description)) === 0) {   
                    array_push($careersByDescription, $career);
                }
            }
        
            return $careersByDescription;
        }

        public function GetOne($careerId) {

            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);
            $career = null;

            if (!empty($arrayToDecode)) {

                foreach ($arrayToDecode as $careerInArray) {
                    if ($careerInArray["careerId"] != $careerId) {
                        continue;
                    }

                    $careerId = $careerInArray["careerId"];
                    $description = $careerInArray["description"];
                    $active = $careerInArray["active"];

                    $career = new Career($careerId, $description, $active);
                }

                return $career;
            }
        }

        public function RetrieveData($active = true) {

            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);

            $this->careersList = array();

            foreach ($arrayToDecode as $careerInArray) {
                if ($careerInArray["active"] != $active) {
                    continue;
                }

                $careerId = $careerInArray["careerId"];
                $description = $careerInArray["description"];
                $active = $careerInArray["active"];

                $career = new Career($careerId, $description, $active);

                array_push($this->careersList, $career);
            }
        
        }

    }
?>