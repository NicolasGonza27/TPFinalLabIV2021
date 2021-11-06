<?php
    namespace DAO;

    use PDOException;
    use Models\Postulation as Postulation;
    use DAO\Connection as Connection;

    class PostulationDAO
    {
        private $connection;
        private $tableName = "postulation";

        public function Add(Postulation $postulation)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (postulationId,jobOfferId,studentId,studentFullName,postulationDate,active) 
                VALUES (:postulationId,:jobOfferId,:studentId,:studentFullName,:postulationDate,:active);";
                
                $parameters["postulationId"] = $postulation->getPostulationId();
                $parameters["jobOfferId"] = $postulation->getJobOfferId();
                $parameters["studentId"] = $postulation->getStudentId();
                $parameters["studentFullName"] = $postulation->getStudentFullName();
                $parameters["postulationDate"] = $postulation->getPostulationDate();
                $parameters["active"] = $postulation->getActive();

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

        public function GetOne($postulationId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (postulationId = :postulationId);";

                $this->connection = Connection::GetInstance();
                
                $parameters['postulationId'] = $postulationId;

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

        public function GetAllByJobOfferId($jobOfferId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (jobOfferId = :jobOfferId) AND (true=active);";

                $this->connection = Connection::GetInstance();
                
                $parameters['jobOfferId'] = $jobOfferId;

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
        
        public function GetAllByStudentId($studentId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (studentId = :studentId) AND (true=active);";

                $this->connection = Connection::GetInstance();
                
                $parameters['studentId'] = $studentId;

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
        
        public function Modify(Postulation $postulation)
        {
            try
            {
                $postulationId = $postulation->getPostulationId();
                $query = "UPDATE ".$this->tableName." SET jobOfferId=:jobOfferId,studentId=:studentId,studentFullName=:studentFullName,postulationDate=:postulationDate,active=:active
                
                WHERE (postulationId = :postulationId);";

                $this->connection = Connection::GetInstance();

                $parameters["postulationId"] = $postulationId;
                $parameters["jobOfferId"] = $postulation->getJobOfferId();
                $parameters["studentId"] = $postulation->getStudentId();
                $parameters["studentFullName"] = $postulation->getStudentFullName();
                $parameters["postulationDate"] = $postulation->getPostulationDate();
                $parameters["active"] = $postulation->getActive();

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return  $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Delete($postulationId)
        {  
            try 
            {
                $query = "UPDATE ".$this->tableName." SET active = :active  WHERE postulationId = :postulationId;";

                $this->connection = Connection::GetInstance();

                $parameters['active'] = false;
                $parameters['postulationId'] = $postulationId;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }
        
        public function SearchPostulationStudentFullName($studentFullName)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE LOCATE(:studentFullName,studentFullName)>0 AND (true=active);";

                $this->connection = Connection::GetInstance();

                $parameters['studentFullName'] = $studentFullName;
                
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

        protected function mapear($postulation)
        {   
            $resp = array_map(function($p)
            {
                return new Postulation($p['postulationId'],$p['jobOfferId'],$p['studentId'],$p['studentFullName'],$p['postulationDate'],$p['active']);
            }, $postulation);

            return $resp;
        }
    }
?>