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
        private $postulationDAO;
        private $studentDAO;
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->mail = new PHPMailer(true);
            $this->postulationDAO = new PostulationDAO();
            $this->studentDAO = new StudentDAO();
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function SendMailEndJobOfferToStudents($jobOfferId)
        {
            $jobOffer = $this->jobOfferDAO->GetOne($jobOfferId);
            $postulationList = $this->postulationDAO->GetAllByJobOfferId($jobOfferId);
            $mail = $this->mail;

            if (!$postulationList) {
                return;
            }
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
                    $mail->Username   = 'tpfinallaborato525@gmail.com';                // SMTP username
                    $mail->Password   = '';                    // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('tpfinallaborato525@gmail.com', 'Administration');
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

        public function SendMailDeletedPostulationToStudents($postulationId)
        {
            $postulation = $this->postulationDAO->GetOne($postulationId);
            $student = $this->studentDAO->GetOne($postulation->getStudentId());
            $jobOffer = $this->jobOfferDAO->GetOne($postulation->getJobOfferId());

            $mail = $this->mail;
                
            try {

                $tamaño = 2; //Tamaño de Pixel
                $level = 'Q'; //Precisión Baja
                $framSize = 3; //Tamaño en blanco
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'tpfinallaborato525@gmail.com';                // SMTP username
                $mail->Password   = '';                    // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('tpfinallaborato525@gmail.com', 'Administration');
                $mail->addAddress($student->getEmail(), $student->getFirstName());        // Name is optional

                // Attachments
                // foreach($listEntradas as $entrada) {
                //     $mail->addAttachment('Views/temp/'.$filename);         // Add attachments
                // }
                

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = "Your Inscription for ".$jobOffer->getDescription()." has been eliminated";
                $mail->Body = "The administrators of the program have taken the decision of removing your postulation." ;

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
        }
    }
?>
