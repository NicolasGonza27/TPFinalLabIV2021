<?php
    namespace DAO;

    use PDOException;
    use Models\JobPosition as JobPosition;    
    use DAO\Connection as Connection;

    class JobPositionDAO
    {
        private $connection;
        private $tableName = "jobposition";

        public function Add(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId,careerId,description) 
                VALUES (:jobPositionId,:careerId,:description);";

                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query,$parameters);
               
            }
            catch(PDOException $e)
            {   
                throw new PDOException($e->getMessage());
            }
        }

        public function GetAll()
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

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

        public function GetOne($jobPositionId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (jobPositionId = :jobPositionId);";

                $this->connection = Connection::GetInstance();
                
                $parameters['jobPositionId'] = $jobPositionId;

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

        public function GetAllByDescription($description)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE LOCATE(:description,description)>0;";

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

        public function GetOneByCareer($careerId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (careerId = :careerId);";

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

        protected function mapear($jobPositions)
        {   
            $resp = array_map(function($p)
            {
                return new JobPosition($p['jobPositionId'],$p['careerId'],$p['description']);
            }, $jobPositions);

            return $resp;
        }
    }
?>