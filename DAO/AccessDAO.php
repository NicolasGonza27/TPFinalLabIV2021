<?php
    namespace DAO;

    use PDOException;
    use Models\Access as Access;    
    use DAO\Connection as Connection;

    class AccessDAO
    {
        private $connection;
        private $tableName = "access";

        public function Add(Access $access)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (accessId,studentId,password) 
                VALUES (:accessId,:studentId,:password);";

                $parameters["accessId"] = $access->getAccessId();
                $parameters["studentId"] = $access->getStudentId();
                $parameters["password"] = $access->getPassword();

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query,$parameters);
               
            }
            catch(PDOException $e)
            {   
                throw new PDOException($e->getMessage());
            }
        }
        
        public function GetOneByStudentId($studentId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (studentId = :studentId);";

                $this->connection = Connection::GetInstance();

                $parameters['studentId'] = $studentId;
                
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
        
        public function GetOne($accessId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (accessId = :accessId);";

                $this->connection = Connection::GetInstance();
                
                $parameters['accessId'] = $accessId;

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

        protected function mapear($access)
        {   
            $resp = array_map(function($p)
            {
                return new Access($p['accessId'],$p['studentId'],$p['password']);
            }, $access);

            return $resp;
        }
    }
?>