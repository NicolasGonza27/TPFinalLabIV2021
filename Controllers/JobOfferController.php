<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use API\ApiJobPositionDAO as ApiJobPositionDAO;
    use API\ApiCareerDAO as ApiCareerDAO;
    use Models\JobOffer as JobOffer;

    class JobOfferController
    {
        private $jobOfferDAO;
        private $companyDAO;
        private $apiJobPositionDAO;
        private $apiCareerDAO;

        public function __construct()
        {
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

            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $jobPosition = $this->apiJobPositionDAO->GetOne($jobOffer->getJobPositionId());
            $career = $this->apiCareerDAO->GetOne($jobPosition->getCareerId());
            $company = $this->companyDAO->GetOne($jobOffer->getCompanyId());
            require_once(VIEWS_PATH."jobOffer-info.php");
        }
        
        public function ShowJobOfferListView($description = null) {
            $jobPositionDAO = $this->apiJobPositionDAO;
            $companyDAO = $this->companyDAO;

            if (!$description) {
                $jobOfferList = $this->jobOfferDAO->GetAll(true);
                require_once(VIEWS_PATH."jobOffer-list.php");
                return;
            }
            
            $jobOfferList = $this->jobOfferDAO->SearchJobOffer($description);
            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function ShowJobOfferListStudentView($jobPositionId = "", $description = "") {
            $jobPositionDAO = $this->apiJobPositionDAO;
            $companyDAO = $this->companyDAO;
            
            if ($description == "" && $jobPositionId == "") {
                $jobOfferList = $this->jobOfferDAO->GetAll(true);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            if ($description && $jobPositionId == "") {
                $jobOfferList = $this->jobOfferDAO->SearchJobOffer($description);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            if ($description == "" && $jobPositionId) {
                $jobOfferList = $this->jobOfferDAO->GetAllByJobPositionId($jobPositionId);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
        }

        public function Add($description, $publicationDate, $expirationDate,  $requirements, $workload, $jobPositionId, $companyId) {

            $nuevo_id = rand(100000,999999);
            while($this->jobOfferDAO->GetOne($nuevo_id) != false) {
                $nuevo_id = rand(100000,999999);
            }
            $jobOffer = new JobOffer($nuevo_id,$description,$publicationDate,$expirationDate,$requirements,$workload,$jobPositionId,$companyId,true);

            $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddJobOfferView();
        }

        public function ModifyJobOffer($jobOfferId, $description, $publicationDate, $expirationDate,  $requirements, $workload, $jobPositionId, $companyId) {
            $jobOffer = new JobOffer();
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);

            $jobOffer->setDescription($description);
            $jobOffer->setPublicationDate($publicationDate);
            $jobOffer->setExpirationDate($expirationDate);
            $jobOffer->setRequirements($requirements);
            $jobOffer->setWorkload($workload);
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