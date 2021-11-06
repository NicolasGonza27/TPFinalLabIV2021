<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use API\ApiJobPositionDAO as ApiJobPositionDAO;
    use API\ApiCareerDAO as ApiCareerDAO;
    use Models\JobOffer as JobOffer;
    use DAO\PostulationDAO as PostulationDAO;
    use Models\Postulation as Postulation;
    use DAO\StudentDAO as StudentDAO;
    use API\ApiStudentDAO as ApiStudentDAO;
    use Models\Student as Student;

    class PostulationController
    {
        private $jobOfferDAO;
        private $companyDAO;
        private $apiJobPositionDAO;
        private $apiCareerDAO;
        private $postulationDAO;
        private $studentDAO;
        private $apiStudentDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->apiJobPositionDAO = new ApiJobPositionDAO();
            $this->apiCareerDAO = new ApiCareerDAO();
            $this->postulationDAO = new PostulationDAO();
            $this->studentDAO = new StudentDAO();
            $this->apiStudentDAO = new ApiStudentDAO();
        }

        public function ShowAddPostulationView() {
            $jobPositionList = $this->apiJobPositionDAO->GetAll();
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."postulation-add.php");
        }

        public function ShowPostulationView($postulationId) {
            if (!$postulationId) {

            }

            $postulation = $this->postulationDAO->GetOne($postulationId);
            $jobOffer = $this->jobOfferDAO->GetOne($postulation->getJobOfferId());
            $jobPosition = $this->apiJobPositionDAO->GetOne($jobOffer->getJobPositionId());
            $career = $this->apiCareerDAO->GetOne($jobPosition->getCareerId());
            $company = $this->companyDAO->GetOne($jobOffer->getCompanyId());
            $student = $this->studentDAO->GetOne($postulation->getStudentId());
            if (!$student) {
                $student = $this->apiStudentDAO->GetOne($postulation->getStudentId());
            }
            require_once(VIEWS_PATH."postulation-info.php");
        }
        
        public function ShowPostulationListView($careerId = "", $jobPositionId = "", $description = "") {
            $careerDAO = $this->apiCareerDAO;
            $jobPositionDAO = $this->apiJobPositionDAO;
            $jobOfferDAO = $this->jobOfferDAO;
            $companyDAO = $this->companyDAO;
            
            // if ($careerId == "" && $jobPositionId == "" && $description == "") {
                $postulationList = $this->postulationDAO->GetAll(true);
                require_once(VIEWS_PATH."postulation-list.php");
                return;
            // }
            // if ($careerId == "" && $jobPositionId == "" && $description) {
            //     $jobOfferList = $this->jobOfferDAO->SearchPostulation($description);
            //     require_once(VIEWS_PATH."jobOffer-list.php");
            //     return;
            // }
            // if ($careerId == "" && $jobPositionId && $description == "") {
            //     $jobOfferList = $this->jobOfferDAO->GetAllByJobPositionId($jobPositionId);
            //     require_once(VIEWS_PATH."jobOffer-list.php");
            //     return;
            // }
            // if ($careerId && $jobPositionId == "" && $description == "") {
            //     $jobOfferList = $this->jobOfferDAO->GetAllByCareerId($careerId);
            //     require_once(VIEWS_PATH."jobOffer-list.php");
            //     return;
            // }
        }

        public function ShowPostulationListStudentView($studentId = "") {
            $jobPositionDAO = $this->apiJobPositionDAO;
            $jobOfferDAO = $this->jobOfferDAO;
            $companyDAO = $this->companyDAO;
            
            if ($studentId == "") {
                $postulationList = $this->postulationDAO->GetAll(true);
                require_once(VIEWS_PATH."postulation-student-list.php");
                return;
            }
            if ($studentId) {
                $postulationList = $this->postulationDAO->GetAllByStudentId($studentId);
                require_once(VIEWS_PATH."postulation-student-list.php");
                return;
            }
            // if ($careerId == "" && $jobPositionId && $description == "") {
            //     $jobOfferList = $this->jobOfferDAO->GetAllByJobPositionId($jobPositionId);
            //     require_once(VIEWS_PATH."jobOffer-student-list.php");
            //     return;
            // }
            // if ($careerId && $jobPositionId == "" && $description == "") {
            //     $jobOfferList = $this->jobOfferDAO->GetAllByCareerId($careerId);
            //     require_once(VIEWS_PATH."jobOffer-student-list.php");
            //     return;
            // }
        }

        public function Add($jobOfferId, $studentId, $studentFullName,  $postulationDate) {
            
            $nuevo_id = rand(100000,999999);
            while($this->postulationDAO->GetOne($nuevo_id) != false) {
                $nuevo_id = rand(100000,999999);
            }
            $postulation = new Postulation($nuevo_id,$jobOfferId,$studentId,$studentFullName,$postulationDate,true);

            $this->postulationDAO->Add($postulation);

            $this->ShowPostulationListStudentView($studentId);
        }

        public function ModifyPostulation($postulationId, $jobOfferId, $studentId, $studentFullName,  $postulationDate) {
            $postulation = new Postulation();
            $postulation = $this->postulationDAO->GetOne($postulationId);

            $postulation->setJobOfferId($jobOfferId);
            $postulation->setStudentId($studentId);
            $postulation->setStudentFullName($studentFullName);
            $postulation->setPostulationDate($postulationDate);

            $this->postulationDAO->Modify($postulation);

            $this->ShowPostulationListView();
        }

        public function DeletePostulation($postulationId) {
            $this->postulationDAO->Delete($postulationId);

            $this->ShowPostulationListView();
        }

        public function getPostulationList() {
            return $this->postulationDAO->GetAll();
        }
    }
?>