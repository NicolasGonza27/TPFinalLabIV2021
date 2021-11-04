<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddCompanyView() {
            require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowCompanyView($companyId) {
            if (!$companyId) {

            }

            $company = $this->companyDAO->GetOne($companyId);
            require_once(VIEWS_PATH."company-info.php");
        }
        
        public function ShowCompanyListView($fantasyName = null) {
            if (!$fantasyName) {
                $companyList = $this->companyDAO->GetAll(true);
                require_once(VIEWS_PATH."company-list.php");
                return;
            }
            
            $companyList = $this->companyDAO->SearchCompany($fantasyName);
            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowCompanyListStudentView($fantasyName = null) {
            if (!$fantasyName) {
                $companyList = $this->companyDAO->GetAll(true);
                require_once(VIEWS_PATH."company-student-list.php");
                return;
            }
            
            $companyList = $this->companyDAO->SearchCompany($fantasyName);
            require_once(VIEWS_PATH."company-student-list.php");
        }

        public function Add($fantasyName, $cuil, $phoneNumber,  $country, $province, $city, $direction) {

            $nuevo_id = rand(100000,999999);
            while($this->companyDAO->GetOne($nuevo_id) != false) {
                $nuevo_id = rand(100000,999999);
            }
            $company = new Company($nuevo_id,$fantasyName,$cuil,$phoneNumber,$country,$province,$city,$direction,true);

            $this->companyDAO->Add($company);

            $this->ShowAddCompanyView();
        }

        public function ModifyCompany($companyId, $fantasyName, $cuil, $phoneNumber,  $country, $province, $city, $direction) {
            $company = new Company();
            $company = $this->companyDAO->GetOne($companyId);

            $company->setFantasyName($fantasyName);
            $company->setCuil($cuil);
            $company->setPhoneNumber($phoneNumber);
            $company->setCountry($country);
            $company->setProvince($province);
            $company->setCity($city);
            $company->setDirection($direction);

            $this->companyDAO->Modify($company);

            $this->ShowCompanyListView();
        }

        public function DeleteCompany($companyId) {
            $this->companyDAO->Delete($companyId);

            $this->ShowCompanyListView();
        }

        public function getCompanyList() {
            return $this->companyDAO->GetAll();
        }
    }
?>