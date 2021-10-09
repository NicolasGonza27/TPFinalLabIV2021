<?php
    namespace DAO;

    use DAO\ICompanyDAO as IStudentDAO;
    use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList;
        private $fileName;


        public function __construct()
        {
            $this->companyList = array();
            $this->fileName = dirname(__DIR__)."/Data/companys.json";
        }


        public function Add(Company $company)
        {
            $this->RetrieveData();
            array_push($this->companyList, $company);
            $this->SaveAll();
        }

        public function Delete($id) 
        {
            $this->RetrieveData();
            $key = $this->returnKeyById($id);    
             
            unset($this->companyList[$key]);            
            $this->SaveAll();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->companyList;
        }

        
        public function returnLastId()
        {
            $this->RetrieveData();

            $id = 0;

            foreach($this->companyList as $company)
            {   
                $id = $company->getCompanyId();
            }

            return $id;
        }

        public function returnKeyById($id)
        {
            $this->RetrieveData();

            foreach($this->companyList as $key=>$company)
            {  
                if($company->getCompanyId() == $id)
                {
                    return $key;
                }
            }
            
            return false;
        }
        
        public function SearchCompany($fantasyName)
        {
            $this->RetrieveData();

            foreach($this->companyList as $company)
            {
                if($company->getFantasyName() == $fantasyName)
                {
                    return $company;
                }
            }
        
            return false;
        }

        public function SearchcompanyBoolean($fantasyName)
        {
            $this->RetrieveData();

            foreach($this->companyList as $company)
            {
                if($company->getFantasyName() == $fantasyName)
                {
                    return true;
                }
            }

            return false;
        }

        private function SaveAll()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["companyId"] = $company->getCompanyId();
                $valuesArray["fantasyName"] = $company->getFantasyName();
                $valuesArray["country"] = $company->getCountry();
                $valuesArray["province"] = $company->getProvince();
                $valuesArray["city"] = $company->getCity();
                $valuesArray["active"] = $company->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }
        
        private function RetrieveData()
        {
            $this->companyList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $companyId = $valuesArray["companyId"];
                    $fantasyName = $valuesArray["fantasyName"];
                    $country = $valuesArray["country"];
                    $province = $valuesArray["province"];
                    $city =  $valuesArray["city"];
                    $active = $valuesArray["active"];

                    $company = new Company($companyId, $fantasyName, $country, $province, $city, $active);
                    array_push($this->companyList, $company);
                }
            }
        }
    }
?>