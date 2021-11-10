<?php
    namespace DAO;

    use PDOException;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    class JobOfferDAO
    {
        private $connection;
        private $tableName = "joboffer";

        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobOfferId,description,publicationDate,expirationDate,requirements,workload,maxPostulations,careerId,jobPositionId,companyId,active) 
                VALUES (:jobOfferId,:description,:publicationDate,:expirationDate,:requirements,:workload,:maxPostulations,:careerId,:jobPositionId,:companyId,:active);";
                
                $parameters["jobOfferId"] = $jobOffer->getJobOfferId();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["publicationDate"] = $jobOffer->getPublicationDate();
                $parameters["expirationDate"] = $jobOffer->getExpirationDate();
                $parameters["requirements"] = $jobOffer->getRequirements();
                $parameters["workload"] = $jobOffer->getWorkload();
                $parameters["maxPostulations"] = $jobOffer->getMaxPostulations();
                $parameters["careerId"] = $jobOffer->getCareerId();
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["active"] = $jobOffer->getActive();

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
                $query = "SELECT * FROM ".$this->tableName." WHERE (active = :active);";

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

        public function GetOne($jobOfferId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (jobOfferId = :jobOfferId);";

                $this->connection = Connection::GetInstance();
                
                $parameters['jobOfferId'] = $jobOfferId;

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

        public function GetAllByJobPositionId($jobPositionId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (jobPositionId = :jobPositionId) AND (true=active);";

                $this->connection = Connection::GetInstance();
                
                $parameters['jobPositionId'] = $jobPositionId;

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
        
        public function GetAllByCareerId($careerId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (careerId = :careerId) AND (true=active);";

                $this->connection = Connection::GetInstance();
                
                $parameters['careerId'] = $careerId;

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

        public function GetAllByCompanyId($companyId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (companyId = :companyId) AND (true=active);";

                $this->connection = Connection::GetInstance();
                
                $parameters['companyId'] = $companyId;

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

        public function GetOneByCompanyId($companyId)
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
        
        public function Modify(JobOffer $jobOffer)
        {
            try
            {
                $jobOfferId = $jobOffer->getJobOfferId();
                $query = "UPDATE ".$this->tableName." SET description=:description,publicationDate=:publicationDate,expirationDate=:expirationDate,requirements=:requirements,workload=:workload,maxPostulations=:maxPostulations,careerId=:careerId,jobPositionId=:jobPositionId,companyId=:companyId,active=:active
                
                WHERE (jobOfferId = :jobOfferId);";

                $this->connection = Connection::GetInstance();

                $parameters["jobOfferId"] = $jobOfferId;
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["publicationDate"] = $jobOffer->getPublicationDate();
                $parameters["expirationDate"] = $jobOffer->getExpirationDate();
                $parameters["requirements"] = $jobOffer->getRequirements();
                $parameters["workload"] = $jobOffer->getWorkload();
                $parameters["maxPostulations"] = $jobOffer->getMaxPostulations();
                $parameters["careerId"] = $jobOffer->getCareerId();
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["active"] = $jobOffer->getActive();

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return  $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Delete($jobOfferId)
        {  
            try 
            {
                $query = "UPDATE ".$this->tableName." SET active = :active  WHERE jobOfferId = :jobOfferId;";

                $this->connection = Connection::GetInstance();

                $parameters['active'] = false;
                $parameters['jobOfferId'] = $jobOfferId;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }
        
        public function SearchJobOffer($description)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE LOCATE(:description,description)>0 AND (true=active);";

                $this->connection = Connection::GetInstance();

                $parameters['description'] = $description;
                
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

        protected function mapear($jobOffers)
        {   
            $resp = array_map(function($p)
            {
                return new JobOffer($p['jobOfferId'],$p['description'],$p['publicationDate'],$p['expirationDate'],$p['requirements'],$p['workload'],$p['maxPostulations'],$p['careerId'],$p['jobPositionId'],$p['companyId'],$p['active']);
            }, $jobOffers);

            return $resp;
        }
    }
?>