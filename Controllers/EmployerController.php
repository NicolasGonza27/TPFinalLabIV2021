<?php
    namespace Controllers;

    use DAO\EmployerDAO as EmployerDAO;
    use Models\Employer as Employer;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use DAO\AccessDAO as AccessDAO;
    use Models\Access as Access;

class EmployerController
    {
        private $employerDAO;
        private $companyDAO;
        private $accessDAO;

        public function __construct()
        {
            $this->employerDAO = new EmployerDAO();
            $this->companyDAO = new CompanyDAO();
            $this->accessDAO = new AccessDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."employer-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->employerDAO->GetAll();

            require_once(VIEWS_PATH."employer-list.php");
        }

        public function ShowEmployerHomeView()
        {
            require_once(VIEWS_PATH."employer-info.php");
        }

        public function ShowEmployerSignInView()
        {
            require_once(VIEWS_PATH."employer-signIn.php");
        }

        public function checkEmployerEmail($email, $password) {
            $employer = $this->employerDAO->GetOneByEmail($email);
            $access = $this->accessDAO->GetOneByStudentId($employer->getEmployerId());
            
            $error = 0;
            if (!$employer || !$access) {
                $error = 1;
                require_once(VIEWS_PATH."home.php");
                return;
            }
            if ($access->getPassword() == $password) {
                $company = $this->companyDAO->GetOne($employer->getCompanyId());
                $_SESSION["employer"] = $employer;
                $_SESSION["company"] = $company;
                require_once(VIEWS_PATH."employer-info.php");
                return;
            }
            else {
                $error = 1;
                require_once(VIEWS_PATH."home.php");
                return;
            }
        }

        public function Add($firstName, $lastName, $dni, $email, $password, $fantasyName, $cuil, $phoneNumber,  $country, $province, $city, $direction)
        {
            $nuevo_id_employer = rand(100000,999999);
            while($this->employerDAO->GetOne($nuevo_id_employer) != false) {
                $nuevo_id_employer = rand(100000,999999);
            }

            $nuevo_id_company = rand(100000,999999);
            while($this->companyDAO->GetOne($nuevo_id_company) != false) {
                $nuevo_id_company = rand(100000,999999);
            }

            $employer = new Employer($nuevo_id_employer, $nuevo_id_company, $firstName, $lastName, $dni, $email, true);
            $error = 0;
            if ($this->employerDAO->GetOneByEmail($email)) {
                $error = 1;
            }
            if ($this->employerDAO->GetOneByDni($dni)) {
                $error = 1;
            }

            $company = new Company($nuevo_id_company,$fantasyName,$cuil,$phoneNumber,$country,$province,$city,$direction,true);
            if ($this->companyDAO->GetOneByFantasyName($fantasyName)) {
                $error = 1;
            }
            if ($this->companyDAO->GetOneByCuil($cuil)) {
                $error = 1;
            }

            $nuevo_id_access = rand(100000,999999);
            while($this->accessDAO->GetOne($nuevo_id_access) != false) {
                $nuevo_id_access = rand(100000,999999);
            }

            $access = new Access($nuevo_id_access, $employer->getEmployerId(), $password);
            
            if ($error == 0) {
                $this->employerDAO->Add($employer);
                $this->companyDAO->Add($company);
                $this->accessDAO->Add($access);
                
                $_SESSION["employer"] = $employer;
                $_SESSION["company"] = $company;
                require_once(VIEWS_PATH."employer-info.php");
            }
            else {
                require_once(VIEWS_PATH."employer-signIn.php");
            }

            
        }
    }
?>