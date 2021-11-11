<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use DAO\PostulationDAO as PostulationDAO;
    use Models\Postulation as Postulation;
    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;
    use MeilerTemplates;

    class PostulationController
    {
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;
        private $postulationDAO;
        private $studentDAO;
        private $mail;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
            $this->postulationDAO = new PostulationDAO();
            $this->studentDAO = new StudentDAO();
            $this->mail = new MeilerTemplates();
        }

        public function ShowAddPostulationView() {
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."postulation-add.php");
        }

        public function ShowPostulationView($postulationId) {
            if (!$postulationId) {

            }

            $postulation = $this->postulationDAO->GetOne($postulationId);
            $jobOffer = $this->jobOfferDAO->GetOne($postulation->getJobOfferId());
            $jobPosition = $this->jobPositionDAO->GetOne($jobOffer->getJobPositionId());
            $career = $this->careerDAO->GetOne($jobPosition->getCareerId());
            $company = $this->companyDAO->GetOne($jobOffer->getCompanyId());
            $student = $this->studentDAO->GetOne($postulation->getStudentId());
            require_once(VIEWS_PATH."postulation-info.php");
        }
        
        public function ShowPostulationListView($careerId = "", $jobPositionId = "", $description = "") {
            $careerDAO = $this->careerDAO;
            $jobPositionDAO = $this->jobPositionDAO;
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
            $jobPositionDAO = $this->jobPositionDAO;
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
            $postulation = new Postulation($nuevo_id,$jobOfferId,$studentId,$studentFullName,$postulationDate,false,true);

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
            $this->mail->SendMailDeletedPostulationToStudents($postulationId);
            $this->postulationDAO->Delete($postulationId);

            $this->ShowPostulationListView();
        }

        public function getPostulationList() {
            return $this->postulationDAO->GetAll();
        }
    }
?>