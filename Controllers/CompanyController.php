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

            $company = $this->companyDAO->returnCompanyById($companyId);
            require_once(VIEWS_PATH."company-info.php");
        }
        
        public function ShowCompanyListView($fantasyName = null) {
            if (!$fantasyName) {
                $companyList = $this->companyDAO->GetAll(1);
                require_once(VIEWS_PATH."company-list.php");
                return;
            }
            
            $companyList = $this->companyDAO->SearchCompany($fantasyName);
            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowCompanyListStudentView($fantasyName = null) {
            if (!$fantasyName) {
                $companyList = $this->companyDAO->GetAll(1);
                require_once(VIEWS_PATH."company-student-list.php");
                return;
            }
            
            $companyList = $this->companyDAO->SearchCompany($fantasyName);
            require_once(VIEWS_PATH."company-student-list.php");
        }

        public function Add($fantasyName, $country, $province, $city) {
            $company = new Company();
            $company->setCompanyId($this->companyDAO->returnLastId() + 1);
            $company->setFantasyName($fantasyName);
            $company->setCountry($country);
            $company->setProvince($province);
            $company->setCity($city);
            $company->setActive(true);

            $this->companyDAO->Add($company);

            $this->ShowAddCompanyView();
        }

        public function ModifyCompany($companyId, $fantasyName, $country, $province, $city) {
            $company = new Company();
            $company = $this->companyDAO->returnCompanyById($companyId);

            $company->setFantasyName($fantasyName);
            $company->setCountry($country);
            $company->setProvince($province);
            $company->setCity($city);

            $this->companyDAO->Modify($company);

            $this->ShowCompanyListView();
        }

        public function DeleteCompany($companyId) {
            $this->companyDAO->Delete($companyId);

            $this->ShowCompanyListView();
        }

        public function getCompanyList() {
            return $this->companyDAO->getAll();
        }
    }
?>