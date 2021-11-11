<?php
    require_once('Pdf/fpdf.php');
    use fpdf as FPDF;
    use DAO\StudentDAO as StudentDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\PostulationDAO as PostulationDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;
    use Models\Postulation as Postulation;
           
    class PdfManager 
    {
        private $pdf;
        private $postulationDAO;
        private $studentDAO;
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->postulationDAO = new PostulationDAO();
            $this->studentDAO = new StudentDAO();
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
            $this->pdf = new FPDF();
        }

        public function getPdf($jobOfferId)
        {
            $postulationList = $this->postulationDAO->GetAllByJobOfferId($jobOfferId);

            if (!$postulationList) {
                return;
            }
            
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetFont('Arial','',16);

            foreach ($postulationList as $postulation) {
                $this->pdf->Cell(40, 10, $postulation->getStudentFullName(), '1', '0', 'C', '0');
            }

            $this->pdf->Output();
        }
    }
?>