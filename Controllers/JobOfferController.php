<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\PostulationDAO as PostulationDAO;
    use API\ApiJobPositionDAO as ApiJobPositionDAO;
    use API\ApiCareerDAO as ApiCareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;

    class JobOfferController
    {
        private $jobOfferDAO;
        private $companyDAO;
        private $apiJobPositionDAO;
        private $apiCareerDAO;

        public function __construct()
        {
            $this->postulationDAO = new PostulationDAO();
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->apiJobPositionDAO = new ApiJobPositionDAO();
            $this->apiCareerDAO = new ApiCareerDAO();
        }

        public function ShowAddJobOfferView() {
            $jobPositionList = $this->apiJobPositionDAO->GetAll();
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function ShowJobOfferView($jobOfferId) {
            if (!$jobOfferId) {

            }
            $already_post = false;
            if (isset($_SESSION["student"])) {
                $student = $_SESSION["student"];
                $postulationStudentList = $this->postulationDAO->GetAllByStudentId($student->getStudentId());
                if ($postulationStudentList) {
                    foreach ($postulationStudentList as $postulation) {
                        if ($postulation->getJobOfferId() == $jobOfferId) {
                            $already_post = true;
                        }
                    }
                }
            }

            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $jobPosition = $this->apiJobPositionDAO->GetOne($jobOffer->getJobPositionId());
            $career = $this->apiCareerDAO->GetOne($jobPosition->getCareerId());
            $company = $this->companyDAO->GetOne($jobOffer->getCompanyId());
            require_once(VIEWS_PATH."jobOffer-info.php");
        }
        
        public function ShowJobOfferListView($careerId = "", $jobPositionId = "", $description = "") {
            $careerDAO = $this->apiCareerDAO;
            $jobPositionDAO = $this->apiJobPositionDAO;
            $companyDAO = $this->companyDAO;
            
            if ($careerId == "" && $jobPositionId == "" && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAll(true);
                require_once(VIEWS_PATH."jobOffer-list.php");
                return;
            }
            if ($careerId == "" && $jobPositionId == "" && $description) {
                $jobOfferList = $this->jobOfferDAO->SearchJobOffer($description);
                require_once(VIEWS_PATH."jobOffer-list.php");
                return;
            }
            if ($careerId == "" && $jobPositionId && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByJobPositionId($jobPositionId);
                require_once(VIEWS_PATH."jobOffer-list.php");
                return;
            }
            if ($careerId && $jobPositionId == "" && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByCareerId($careerId);
                require_once(VIEWS_PATH."jobOffer-list.php");
                return;
            }
        }

        public function ShowJobOfferListStudentView($careerId = "", $jobPositionId = "", $description = "") {
            $careerDAO = $this->apiCareerDAO;
            $jobPositionDAO = $this->apiJobPositionDAO;
            $companyDAO = $this->companyDAO;
            
            if ($careerId == "" && $jobPositionId == "" && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAll(true);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            if ($careerId == "" && $jobPositionId == "" && $description) {
                $jobOfferList = $this->jobOfferDAO->SearchJobOffer($description);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            if ($careerId == "" && $jobPositionId && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByJobPositionId($jobPositionId);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            if ($careerId && $jobPositionId == "" && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByCareerId($careerId);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
        }

        public function Add($description, $publicationDate, $expirationDate,  $requirements, $workload, $jobPositionId, $companyId) {

            $nuevo_id = rand(100000,999999);
            while($this->jobOfferDAO->GetOne($nuevo_id) != false) {
                $nuevo_id = rand(100000,999999);
            }
            $jobPosition = $this->apiJobPositionDAO->GetOne($jobPositionId);
            $careerId = $jobPosition->getCareerId();
            $jobOffer = new JobOffer($nuevo_id,$description,$publicationDate,$expirationDate,$requirements,$workload,$careerId,$jobPositionId,$companyId,true);

            $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddJobOfferView();
        }

        public function ModifyJobOffer($jobOfferId, $description, $publicationDate, $expirationDate,  $requirements, $workload, $jobPositionId, $companyId) {
            $jobPosition = $this->apiJobPositionDAO->GetOne($jobPositionId);
            $careerId = $jobPosition->getCareerId();
            $jobOffer = new JobOffer();
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);

            $jobOffer->setDescription($description);
            $jobOffer->setPublicationDate($publicationDate);
            $jobOffer->setExpirationDate($expirationDate);
            $jobOffer->setRequirements($requirements);
            $jobOffer->setWorkload($workload);
            $jobOffer->setCareerId($careerId);
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setCompanyId($companyId);

            $this->jobOfferDAO->Modify($jobOffer);

            $this->ShowJobOfferListView();
        }

        public function DeleteJobOffer($jobOfferId) {
            $this->jobOfferDAO->Delete($jobOfferId);

            $this->ShowJobOfferListView();
        }

        public function getJobOfferList() {
            return $this->jobOfferDAO->GetAll();
        }
    }
?>