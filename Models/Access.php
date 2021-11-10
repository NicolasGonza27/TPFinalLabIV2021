<?php
    namespace Models;

    class Access
    {
        private $accessId;
        private $studentId;
        private $password;

        public function __construct($accessId = null, $studentId= null, $password = null)
        {
            $this->accessId = $accessId;
            $this->studentId = $studentId;
            $this->password = $password;
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
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of accessId
         */ 
        public function getAccessId()
        {
                return $this->accessId;
        }

        /**
         * Set the value of accessId
         *
         * @return  self
         */ 
        public function setAccessId($accessId)
        {
                $this->accessId = $accessId;

                return $this;
        }
    }
?>