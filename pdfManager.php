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
                return 0;
            }
            
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $jobPosition = $this->jobPositionDAO->GetOne($jobOffer->getJobPositionId());
            $company = $this->companyDAO->GetOne($jobOffer->getCompanyId());

            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetFont('Arial','',16);
            $this->pdf->Cell(70,10, $jobOffer->getDescription(), '0', '0', 'L', '0');
            $this->pdf->Ln(5);
            $this->pdf->Cell(70,10, "Postulations List", '0', '0', 'L', '0');
            $this->pdf->Ln(20);
            
            $this->pdf->SetFont('Arial','',16);

            $this->pdf->Cell(30,7, "First Name",0, 0 , 'L', 0);
            $this->pdf->Cell(30,7, "Last Name",0, 0 , 'L', 0);
            $this->pdf->Cell(40,7, "Dni",0, 0 , 'L', 0);
            $this->pdf->Cell(60,7, "Email",0, 0 , 'L', 0);
            $this->pdf->Cell(25,7, "Phone",0, 0 , 'L', 0);
            $this->pdf->Ln();

            foreach ($postulationList as $postulation) {
                
                $student = $this->studentDAO->GetOne($postulation->getStudentId());
                

                $this->pdf->Cell(30,8, $student->getFirstName(), '1', '0', 'L', '0');
                $this->pdf->Cell(30,8, $student->getLastName(), '1', '0', 'L', '0');
                $this->pdf->Cell(40,8, $student->getDni(), '1', '0', 'L', '0');
                $this->pdf->Cell(60,8, $student->getEmail(), '1', '0', 'L', '0');
                $this->pdf->Cell(25,8, $student->getPhoneNumber(), '1', '0', 'L', '0');
                $this->pdf->Ln();
            }

            $nuevo_pdf_id = rand(1000000000,9999999999);
            $this->pdf->Output('F','pdfPostulationList/'.$nuevo_pdf_id.'.pdf');

            return 1;
        }
    }
?>