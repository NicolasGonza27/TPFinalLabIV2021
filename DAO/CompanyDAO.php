<?php
    namespace DAO;

    use PDOException;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use DAO\Connection as Connection;

    class CompanyDAO implements ICompanyDAO
    {
        private $connection;
        private $tableName = "company";

        public function Add(Company $company)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (companyId,fantasyName,cuil,phoneNumber,country,province,city,direction,active) 
                VALUES (:companyId,:fantasyName,:cuil,:phoneNumber,:country,:province,:city,:direction,:active);";
                
                $parameters["companyId"] = $company->getCompanyId();
                $parameters["fantasyName"] = $company->getFantasyName();
                $parameters["cuil"] = $company->getCuil();
                $parameters["phoneNumber"] = $company->getPhoneNumber();
                $parameters["country"] = $company->getCountry();
                $parameters["province"] = $company->getProvince();
                $parameters["city"] = $company->getCity();
                $parameters["direction"] = $company->getDirection();
                $parameters["active"] = $company->getActive();

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query,$parameters);
               
            }
            catch(PDOException $e)
            {   
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAll(bool $active = true)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName;

                $parameters["active"] = $active;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;
            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetOne($companyId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (companyId = :companyId);";

                $this->connection = Connection::GetInstance();
                
                $parameters['companyId'] = $companyId;

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet[0];
                }
                
                return false;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetOneByCuil($cuil)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (cuil = :cuil);";

                $this->connection = Connection::GetInstance();
                
                $parameters['cuil'] = $cuil;

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet[0];
                }
                
                return false;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function GetOneByFantasyName($fantasyName)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (fantasyName = :fantasyName);";

                $this->connection = Connection::GetInstance();
                
                $parameters['fantasyName'] = $fantasyName;

                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet[0];
                }
                
                return false;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Modify(Company $company)
        {
            try
            {
                $companyId = $company->getCompanyId();
                $query = "UPDATE ".$this->tableName." SET fantasyName=:fantasyName,cuil=:cuil,phoneNumber=:phoneNumber,country=:country,province=:province,city=:city,direction=:direction,active=:active
                
                WHERE (companyId = :companyId);";

                $this->connection = Connection::GetInstance();

                $parameters["companyId"] = $companyId;
                $parameters["fantasyName"] = $company->getFantasyName();
                $parameters["cuil"] = $company->getCuil();
                $parameters["phoneNumber"] = $company->getPhoneNumber();
                $parameters["country"] = $company->getCountry();
                $parameters["province"] = $company->getProvince();
                $parameters["city"] = $company->getCity();
                $parameters["direction"] = $company->getDirection();
                $parameters["active"] = $company->getActive();

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return  $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Delete($companyId)
        {  
            try 
            {
                $query = "UPDATE ".$this->tableName." SET active = :active  WHERE companyId = :companyId;";

                $this->connection = Connection::GetInstance();

                $parameters['active'] = false;
                $parameters['companyId'] = $companyId;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }
        
        public function SearchCompany($fantasyName)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE LOCATE(:fantasyName,fantasyName)>0;";

                $this->connection = Connection::GetInstance();

                $parameters['fantasyName'] = $fantasyName;
                
                $resultSet = $this->connection->Execute($query,$parameters);

                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet;
                }
                
                return false;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        protected function mapear($companyes)
        {   
            $resp = array_map(function($p)
            {
                return new Company($p['companyId'],$p['fantasyName'],$p['cuil'],$p['phoneNumber'],$p['country'],$p['province'],$p['city'],$p['direction'],$p['active']);
            }, $companyes);

            return $resp;
        }
    }
?>