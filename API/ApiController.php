<?php

    namespace API;

    use Models\Student as Student;

    class ApiController
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

        public function GetAllOutCartelera()
        {   
            $this->RetrieveDataOutCartelera();
            return $this->studentsList;
        }

        public function GetAllByTitle($title)
        {
            $this->RetrieveData();
            $moviesByTitle = array();

            foreach($this->studentsList as $movie)
            {   
                if(substr_compare(strtolower($movie->getTitle()), strtolower($title), 0, strlen($title)) === 0)
                {   
                    array_push($moviesByTitle, $movie);
                }
            }
        
            return $moviesByTitle;
        }

        public function GetAllByDate($date)
        {   
            $this->RetrieveData();
            $moviesByDate= array();

            foreach($this->studentsList as $movie)
            {   
                if($movie->getRelease_date() >= $date)
                {   
                    array_push($moviesByDate,$movie);
                }
            }
        
            return $moviesByDate;
        }

        public function GetAllMostPopularityOutCartelera($popularity = 300)
        {
            $this->RetrieveDataOutCartelera();
            $movieDAO = new MovieDAO();
            $moviesMostPopularity= array();

            foreach($this->studentsList as $movie)
            {   
                if( ($movie->getPopularity() >= $popularity) )
                {   

                        array_push($moviesMostPopularity,$movie);
                    
                  
                }
            }
        
            return $moviesMostPopularity;
        }

        public function GetAllByTitleOutCartelera($title)
        {
            $this->RetrieveDataOutCartelera();
            $moviesByTitle = array();

            if($title) 
            {
                foreach($this->studentsList as $movie)
                {
                    if(substr_compare(strtolower($movie->getTitle()), strtolower($title), 0, strlen($title)) === 0)
                    {   
                        array_push($moviesByTitle, $movie);
                    }
                }
            }
            
            return $moviesByTitle;
        }

        public function GetAllByDateOutCartelera($date)
        {   
            $this->RetrieveDataOutCartelera();
            $moviesByDate= array();

            foreach($this->studentsList as $movie)
            {   
                if($movie->getRelease_date() >= $date)
                {   
                    array_push($moviesByDate,$movie);
                }
            }
        
            return $moviesByDate;
        }

        public function GetOne($id)
        {
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id?api_key=241053b8db24b510787d177925c66cdb");
            $contentArray = ($jsonContent) ? json_decode($jsonContent, true) : array();

            if(!empty($contentArray)) 
            {
                    $popularity = $contentArray["popularity"]; 
                    $vote_count = $contentArray["vote_count"];
                    $poster_path = $contentArray["poster_path"];
                    $id = $contentArray["id"];
                    $adult = $contentArray["adult"];
                    $genre_ids = $contentArray["genres"];
                    $title = $contentArray["title"];
                    $vote_average = $contentArray["vote_average"];
                    $overview = $contentArray["overview"];
                    $release_date = date($contentArray["release_date"]);
                    $runtime = $contentArray["runtime"];
                    
                    $movie = new Movie($popularity,$vote_count,$poster_path,$id,$adult,$genre_ids,$title,$vote_average,$overview,$release_date, $runtime);
                    
                    return $movie;
            }

            return false;
        }

        
        public function RetrieveDataOutCartelera()
        {
            $this->studentsList = array();
            $movieDAO = new MovieDAO();

            for($i = 1; $i < 15; $i++)
            {
                $jsonContent = file_get_contents($this->apiDirection."&page=$i");
                $contentArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                foreach($contentArray["results"] as $content)
                {   
                                 
                    if($movieDAO->GetOne($content["id"], true))
                    {
                        $popularity = $content["popularity"]; 
                        $vote_count = $content["vote_count"];
                        $poster_path = $content["poster_path"];
                        $id = $content["id"];
                        $adult = $content["adult"];
                        $genre_ids = $content["genre_ids"];
                        $title = $content["title"];
                        $vote_average = $content["vote_average"];
                        $overview = $content["overview"];
                        $release_date = date($content["release_date"]);
                        $runtime = 0;
                        $movie = new Movie($popularity,$vote_count,$poster_path,$id,$adult,$genre_ids,$title,$vote_average,$overview,$release_date, $runtime);

                        array_push($this->studentsList, $movie);
                    }
                    else 
                    {
                        if(!$movieDAO->GetOne($content["id"], false))
                        {
                            $popularity = $content["popularity"]; 
                            $vote_count = $content["vote_count"];
                            $poster_path = $content["poster_path"];
                            $id = $content["id"];
                            $adult = $content["adult"];
                            $genre_ids = $content["genre_ids"];
                            $title = $content["title"];
                            $vote_average = $content["vote_average"];
                            $overview = $content["overview"];
                            $release_date = date($content["release_date"]);
                            $runtime = 0;
                            $movie = new Movie($popularity,$vote_count,$poster_path,$id,$adult,$genre_ids,$title,$vote_average,$overview,$release_date, $runtime);
    
                            array_push($this->studentsList, $movie);
                        }
                    } 
                }
            }   
        }

        public function RetrieveData()
        {
            $response = file_get_contents($this->apiDirection, false, $this->context);
            $arrayToDecode = json_decode($response, true);

            $this->studentsList = array();

            foreach($arrayToDecode as $studentInArray) {

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