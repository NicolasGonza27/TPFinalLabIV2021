<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\PostulationDAO as PostulationDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;
    use MeilerTemplates;
    use DocumentManager;
    use PdfManager;

class JobOfferController
    {
        private $postulationDAO;
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;
        private $mail;
        private $documentManager;
        private $pdf;

        public function __construct()
        {
            $this->postulationDAO = new PostulationDAO();
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
            $this->mail = new MeilerTemplates();
            $this->documentManager = new DocumentManager();
            $this->pdf = new PdfManager();
        }

        public function ShowAddJobOfferView() {
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function ShowJobOfferView($jobOfferId) {
            $already_post = false;
            $no_post_left = false;
            $postulationsLista = 0;

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
                if (!$already_post) {
                    if (!$this->HasPostulationsLeftByJobOffer($jobOfferId)) {
                        $no_post_left = true;
                    }
                }
            }
            else {
                $postulationsLista = $this->postulationDAO->GetAllByJobOfferId($jobOfferId);
            }

            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $jobPosition = $this->jobPositionDAO->GetOne($jobOffer->getJobPositionId());
            $career = $this->careerDAO->GetOne($jobPosition->getCareerId());
            $company = $this->companyDAO->GetOne($jobOffer->getCompanyId());

            
            $jobPositionDAO = $this->jobPositionDAO;
            $jobOfferDAO = $this->jobOfferDAO;
            $careerDAO = $this->careerDAO;
            $companyDAO = $this->companyDAO;
            require_once(VIEWS_PATH."jobOffer-info.php");
        }

        public function HasPostulationsLeftByJobOffer($jobOfferId) {
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $postulationJobOfferList = $this->postulationDAO->GetAllByJobOfferId($jobOfferId);
            if (!$postulationJobOfferList) {
                return true;
            }
            elseif (count($postulationJobOfferList) < $jobOffer->getMaxPostulations()) {
                return true;
            }
            else {
                return false;
            }
        }
        
        public function ShowJobOfferListView($companyId = "", $careerId = "", $jobPositionId = "", $description = "") {
            $careerDAO = $this->careerDAO;
            $jobPositionDAO = $this->jobPositionDAO;
            $companyDAO = $this->companyDAO;
            if ($companyId != "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByCompanyId($companyId);
                require_once(VIEWS_PATH."jobOffer-list.php");
                return;
            }
            
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
            $careerDAO = $this->careerDAO;
            $jobPositionDAO = $this->jobPositionDAO;
            $companyDAO = $this->companyDAO;
            
            if ($careerId == "" && $jobPositionId == "" && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAll(true);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            elseif ($careerId == "" && $jobPositionId == "" && $description) {
                $jobOfferList = $this->jobOfferDAO->SearchJobOffer($description);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            elseif ($careerId == "" && $jobPositionId && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByJobPositionId($jobPositionId);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            elseif ($careerId && $jobPositionId == "" && $description == "") {
                $jobOfferList = $this->jobOfferDAO->GetAllByCareerId($careerId);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
            else {
                $jobOfferList = $this->jobOfferDAO->GetAll(true);
                require_once(VIEWS_PATH."jobOffer-student-list.php");
                return;
            }
        }

        public function SendMailsToStudents() {
            $jobOfferList = $this->jobOfferDAO->GetAll();
            $thisDay = time();
            foreach ($jobOfferList as $jobOffer) {
                $jobOfferExp = strtotime($jobOffer->getExpirationDate());
                if ($jobOfferExp < $thisDay) {
                    $this->mail->SendMailEndJobOfferToStudents($jobOffer->getJobOfferId());
                }
            }
            $this->ShowJobOfferListView();
        }

        public function ListPostulationsInPdf($jobOfferId) {
            $texto = "Document was successfuly saved!";
            // echo "  <script>
            //             window.open('Pdf/".($jobOfferId)."','_blank');
            //         </script>";
            if (!($this->Pdf($jobOfferId))) {
                $texto = "Can`t download an empty list!";
            }
            echo    ('<script>
                        alert("'.($texto).'");
                    </script>');
            
            $this->ShowJobOfferView($jobOfferId);
        }

        public function Pdf($jobOfferId) {
            return $this->pdf->getPdf($jobOfferId);
        }

        public function Add($description, $publicationDate, $expirationDate,  $requirements, $workload, $maxPostulations, $jobPositionId, $companyId, $flyer) {

            $nuevo_id = rand(100000,999999);
            while($this->jobOfferDAO->GetOne($nuevo_id) != false) {
                $nuevo_id = rand(100000,999999);
            }
            $jobPosition = $this->jobPositionDAO->GetOne($jobPositionId);
            $careerId = $jobPosition->getCareerId();

            if ($flyer["name"] != "") {               
                $flyer = $this->documentManager->setDocument($flyer,"flyer");
            }
            else {
                $flyer = "";
            }

            $jobOffer = new JobOffer($nuevo_id,$description,$publicationDate,$expirationDate,$requirements,$workload,
            $maxPostulations,$careerId,$jobPositionId,$companyId,$flyer,true);

            $this->jobOfferDAO->Add($jobOffer);

            if (isset($_SESSION["employer"])) {
                $this->ShowJobOfferListView($companyId);
                echo    '<script>
                            alert("New job offer saved!");
                        </script>';
                return;
            }
            
            $this->ShowJobOfferListView();
            echo    '<script>
                        alert("New job offer saved!");
                    </script>';
        }

        public function ModifyJobOffer($jobOfferId, $description, $publicationDate, $expirationDate,  $requirements, $workload, $maxPostulations, $jobPositionId, $companyId, $flyer) {
            $jobPosition = $this->jobPositionDAO->GetOne($jobPositionId);
            $careerId = $jobPosition->getCareerId();
            $jobOffer = new JobOffer();
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);

            if ($flyer["name"] != "") {                
                $flyer = $this->documentManager->setDocument($flyer,"flyer");
                $jobOffer->setFlyer($flyer);
            }

            $jobOffer->setDescription($description);
            $jobOffer->setPublicationDate($publicationDate);
            $jobOffer->setExpirationDate($expirationDate);
            $jobOffer->setRequirements($requirements);
            $jobOffer->setWorkload($workload);
            $jobOffer->setMaxPostulations($maxPostulations);
            $jobOffer->setCareerId($careerId);
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setCompanyId($companyId);

            $this->jobOfferDAO->Modify($jobOffer);

            if (isset($_SESSION['employer'])) {
                $this->ShowJobOfferListView($_SESSION['employer']->getCompanyId());
                return;
            }

            $this->ShowJobOfferListView();
        }

        public function DeleteJobOffer($jobOfferId) {
            $this->jobOfferDAO->Delete($jobOfferId);

            if (isset($_SESSION['employer'])) {
                $this->ShowJobOfferListView($_SESSION['employer']->getCompanyId());
                return;
            }

            $this->ShowJobOfferListView();
        }

        public function getJobOfferList() {
            return $this->jobOfferDAO->GetAll();
        }
    }
?>