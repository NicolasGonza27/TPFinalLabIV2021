<?php
    namespace DAO;

    use PDOException;
    use Models\Career as Career;    
    use DAO\Connection as Connection;

    class CareerDAO
    {
        private $connection;
        private $tableName = "career";

        public function Add(Career $career)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId,description,active) 
                VALUES (:careerId,:description,:active);";

                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();

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

        public function GetOne($careerId)
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

        protected function mapear($careers)
        {   
            $resp = array_map(function($p)
            {
                return new Career($p['careerId'],$p['description'],$p['active']);
            }, $careers);

            return $resp;
        }
    }
?>