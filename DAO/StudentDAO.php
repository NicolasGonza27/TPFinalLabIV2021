<?php
    namespace DAO;

    use PDOException;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;    
    use DAO\Connection as Connection;

    class StudentDAO implements IStudentDAO
    {
        private $connection;
        private $tableName = "student";

        public function Add(Student $student)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (studentId,careerId,firstName,lastName,dni,fileNumber,gender,birthDate,email,phoneNumber,active) 
                VALUES (:studentId,:careerId,:firstName,:lastName,:dni,:fileNumber,:gender,:birthDate,:email,:phoneNumber,:active);";
                
                $parameters["studentId"] = $student->getStudentId();
                $parameters["careerId"] = $student->getCareerId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["dni"] = $student->getDni();
                $parameters["fileNumber"] = $student->getFileNumber();
                $parameters["gender"] = $student->getGender();
                $parameters["birthDate"] = $student->getBirthDate();
                $parameters["email"] = $student->getEmail();
                $parameters["phoneNumber"] = $student->getPhoneNumber();
                $parameters["active"] = $student->getActive();

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

        public function GetOne($studentId)
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

        public function Remove($studentId)
        {  
            try 
            {
                $query = "UPDATE ".$this->tableName." SET active = :active  WHERE studentId = :studentId;";

                $this->connection = Connection::GetInstance();

                $parameters['active'] = false;
                $parameters['studentId'] = $studentId;

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        public function Modify($studentId, Student $student)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET careerId=:careerId,firstName=:firstName,lastName=:lastName,dni=:dni,fileNumber=:fileNumber,gender=:gender,birthDate=:birthDate,email=:email,phoneNumber=:phoneNumber,active=:active
                
                WHERE (studentId = :studentId);";

                $this->connection = Connection::GetInstance();

                $parameters["studentId"] = $studentId;
                $parameters["careerId"] = $student->getCareerId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["dni"] = $student->getDni();
                $parameters["fileNumber"] = $student->getFileNumber();
                $parameters["gender"] = $student->getGender();
                $parameters["birthDate"] = $student->getBirthDate();
                $parameters["email"] = $student->getEmail();
                $parameters["phoneNumber"] = $student->getPhoneNumber();
                $parameters["active"] = $student->getActive();

                $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

                return  $cantRows;

            }
            catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
        }

        protected function mapear($students)
        {   
            $resp = array_map(function($p)
            {
                return new Student($p['studentId'],$p['careerId'],$p['firstName'],$p['lastName'],
                $p['dni'],$p['fileNumber'],$p['gender'],$p['birthDate'],$p['email'],$p['phoneNumber'],$p['active']);
            }, $students);

            return $resp;
        }
    }
?>