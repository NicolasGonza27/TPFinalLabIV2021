<?php
    namespace Models;

    use Models\User as User;

    class Student extends User
    {
        private $studentId;
        private $careerId;
        // private $firstName;
        // private $lastName;
        // private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        // private $email;
        private $phoneNumber;
        // private $active;

        public function __construct($studentId = null, $careerId = null, $firstName = null, $lastName = null, $dni = null, $fileNumber = null, $gender = null, $birthDate = null, $email = null, $phoneNumber = null, $active = null)
        {
            $this->studentId = $studentId;
            $this->careerId = $careerId;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->dni = $dni;
            $this->fileNumber = $fileNumber;
            $this->gender = $gender;
            $this->birthDate = $birthDate;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->active = $active;
            $this->tipeUser = TIPE_USER;
        }

        /**
         * Get the value of studentId
         */ 
        public function getStudentId()
        {
                return $this->studentId;
        }

        /**
         * Set the value of studentId
         *
         * @return  self
         */ 
        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;

                return $this;
        }

        /**
         * Get the value of careerId
         */ 
        public function getCareerId()
        {
                return $this->careerId;
        }

        /**
         * Set the value of careerId
         *
         * @return  self
         */ 
        public function setCareerId($careerId)
        {
                $this->careerId = $careerId;

                return $this;
        }

        /**
         * Get the value of fileNumber
         */ 
        public function getFileNumber()
        {
                return $this->fileNumber;
        }

        /**
         * Set the value of fileNumber
         *
         * @return  self
         */ 
        public function setFileNumber($fileNumber)
        {
                $this->fileNumber = $fileNumber;

                return $this;
        }

        /**
         * Get the value of gender
         */ 
        public function getGender()
        {
                return $this->gender;
        }

        /**
         * Set the value of gender
         *
         * @return  self
         */ 
        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        /**
         * Get the value of birthDate
         */ 
        public function getBirthDate()
        {
                return $this->birthDate;
        }

        /**
         * Set the value of birthDate
         *
         * @return  self
         */ 
        public function setBirthDate($birthDate)
        {
                $this->birthDate = $birthDate;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         *
         * @return  self
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }
    }
?>

