<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once('PhpMailer/Exception.php');
    require_once('PhpMailer/PHPMailer.php');
    require_once('PhpMailer/SMTP.php');
    use DAO\StudentDAO as StudentDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\PostulationDAO as PostulationDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;
    use Models\Postulation as Postulation;
           
    class MeilerTemplates 
    {
        private $dir;
        private $mail;
        private $studentDAO;
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->dir = VIEWS_PATH . "temp/";
            $this->mail = new PHPMailer(true);
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

        public function SendMailEndJobOfferToStudents($jobOfferId)
        {
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $postulationList = $this->postulationDAO->GetAllByJobOfferId($jobOfferId);
            $mail = $this->mail;

            foreach ($postulationList as $postulation) {
                if ($postulation->getMailSend()) {
                    continue;
                }
                $student = $this->studentDAO->GetOne($postulation->getStudentId());
                try {

                    $tamaño = 2; //Tamaño de Pixel
                    $level = 'Q'; //Precisión Baja
                    $framSize = 3; //Tamaño en blanco
                    //Server settings
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'niclausegonzalez@gmail.com';                // SMTP username
                    $mail->Password   = '21century';                    // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('moviepass28@gmail.com', 'Administracion');
                    $mail->addAddress($student->getEmail(), $student->getFirstName());        // Name is optional

                    // Attachments
                    // foreach($listEntradas as $entrada) {
                    //     $mail->addAttachment('Views/temp/'.$filename);         // Add attachments
                    // }
                    

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "The Inscription for ".$jobOffer->getDescription()." is finished";
                    $mail->Body = "We are gratefull for your partisipation and we wesh you luck!" ;

                    $mail->send();

                    $postulation->setMailSend(true);
                    $this->postulationDAO->Modify($postulation);
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            
        }
    }
?>