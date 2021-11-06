<?php
    namespace Models;

    class Postulation
    {
        private $postulationId;
        private $jobOfferId;
        private $studentId;
        private $studentFullName;
        private $postulationDate;
        private $active;

        public function __construct($postulationId = null, $jobOfferId = null, $studentId = null, $studentFullName = null, $postulationDate = null, $active = null)
        {
            $this->postulationId = $postulationId;
            $this->jobOfferId = $jobOfferId;
            $this->studentId = $studentId;
            $this->studentFullName = $studentFullName;
            $this->postulationDate = $postulationDate;
            $this->active = $active;
        }

        /**
         * Get the value of postulationId
         */ 
        public function getPostulationId()
        {
                return $this->postulationId;
        }

        /**
         * Set the value of postulationId
         *
         * @return  self
         */ 
        public function setPostulationId($postulationId)
        {
                $this->postulationId = $postulationId;

                return $this;
        }

        /**
         * Get the value of jobOfferId
         */ 
        public function getJobOfferId()
        {
                return $this->jobOfferId;
        }

        /**
         * Set the value of jobOfferId
         *
         * @return  self
         */ 
        public function setJobOfferId($jobOfferId)
        {
                $this->jobOfferId = $jobOfferId;

                return $this;
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
         * Get the value of postulationDate
         */ 
        public function getPostulationDate()
        {
                return $this->postulationDate;
        }

        /**
         * Set the value of postulationDate
         *
         * @return  self
         */ 
        public function setPostulationDate($postulationDate)
        {
                $this->postulationDate = $postulationDate;

                return $this;
        }

        /**
         * Get the value of active
         */ 
        public function getActive()
        {
                return $this->active;
        }

        /**
         * Set the value of active
         *
         * @return  self
         */ 
        public function setActive($active)
        {
                $this->active = $active;

                return $this;
        }

        /**
         * Get the value of studentFullName
         */ 
        public function getStudentFullName()
        {
                return $this->studentFullName;
        }

        /**
         * Set the value of studentFullName
         *
         * @return  self
         */ 
        public function setStudentFullName($studentFullName)
        {
                $this->studentFullName = $studentFullName;

                return $this;
        }
    }
?>
