<?php
    use DAO\StudentDAO as StudentDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\PostulationDAO as PostulationDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;
    use Models\Postulation as Postulation;
           
    class DocumentManager 
    {
        private $dir;
        private $postulationDAO;
        private $studentDAO;
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->dir = VIEWS_PATH . "temp/";
            $this->postulationDAO = new PostulationDAO();
            $this->studentDAO = new StudentDAO();
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();

            if (!file_exists($this->dir)) {
                mkdir($this->dir);
            }
        }

        /**
         * fileArray array $_FILE capturado
         * campo string valor name del campo enviado
         * dir curriculum o flyer
         */
        public function setDocument($fileArray,$dir)
        {
            $target_dir = $this->dir;
            $extension = pathinfo($fileArray["name"], PATHINFO_EXTENSION);

            $nombre_doc = rand(1000000000,9999999999).".".$extension;

            $fichero_subido = $target_dir . $nombre_doc;

            if (!move_uploaded_file($_FILES['flyer']['tmp_name'], $fichero_subido)) {
                return false;
            }
                    
            return $this->dir.$nombre_doc;
        }
    }
?>