<?php
    namespace DAO;

    use PDOException;
    use Models\Employer as Employer;    
    use DAO\Connection as Connection;

    class EmployerDAO
    {
        private $connection;
        private $tableName = "employer";

        public function Add(Employer $employer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (employerId,companyId,firstName,lastName,dni,email,active) 
                VALUES (:employerId,:companyId,:firstName,:lastName,:dni,:email,:active);";
                
                $parameters["employerId"] = $employer->getEmployerId();
                $parameters["companyId"] = $employer->getCompanyId();
                $parameters["firstName"] = $employer->getFirstName();
                $parameters["lastName"] = $employer->getLastName();
                $parameters["dni"] = $employer->getDni();
                $parameters["email"] = $employer->getEmail();
                $parameters["active"] = $employer->getActive();

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

        public function GetOne($employerId)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (employerId = :employerId);";

                $this->connection = Connection::GetInstance();
                
                $parameters['employerId'] = $employerId;

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

        public function GetOneByEmail($email)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (email = :email);";

                $this->connection = Connection::GetInstance();
                
                $parameters['email'] = $email;

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

        public function GetOneByDni($dni)
        {
            try 
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (dni = :dni);";

                $this->connection = Connection::GetInstance();
                
                $parameters['dni'] = $dni;

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

        public function Remove($employerId)
        {  
            try 
            {
                $query = "UPDATE ".$this->tableName." SET active = :active  WHERE employerId = :employerId;";

                $this->connection = Connection::GetInstance();

                $parameters['active'] = false;
                $parameters['employerId'] = $employerId;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Modify($employerId, Employer $employer)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET companyId=:companyId,firstName=:firstName,lastName=:lastName,dni=:dni,email=:email,active=:active
                
                WHERE (employerId = :employerId);";

                $this->connection = Connection::GetInstance();

                $parameters["employerId"] = $employerId;
                $parameters["companyId"] = $employer->getCompanyId();
                $parameters["firstName"] = $employer->getFirstName();
                $parameters["lastName"] = $employer->getLastName();
                $parameters["dni"] = $employer->getDni();
                $parameters["email"] = $employer->getEmail();
                $parameters["active"] = $employer->getActive();

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return  $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        protected function mapear($employers)
        {   
            $resp = array_map(function($p)
            {
                return new Employer($p['employerId'],$p['companyId'],$p['firstName'],$p['lastName'],
                $p['dni'],$p['email'],$p['active']);
            }, $employers);

            return $resp;
        }
    }
?>