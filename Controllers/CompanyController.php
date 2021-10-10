<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class StudentController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowCompanyListView() {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowAddComanyView() {
            require_once(VIEWS_PATH."company-add.php");
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

            $this->ShowAddComanyView();
        }
    }
?>