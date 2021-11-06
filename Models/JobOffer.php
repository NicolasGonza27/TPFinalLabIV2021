<?php
    namespace Models;

    class JobOffer
    {
        private $jobOfferId;
        private $description;
        private $publicationDate;
        private $expirationDate;
        private $requirements;
        private $workload; //carga horaria
        private $careerId;
        private $jobPositionId;
        private $companyId;
        private $active;

        public function __construct($jobOfferId = null, $description = null, $publicationDate = null, $expirationDate = null, $requirements = null, $workload = null, $careerId = null, $jobPositionId = null, $companyId = null, $active = null)
        {
            $this->jobOfferId = $jobOfferId;
            $this->description = $description;
            $this->publicationDate = $publicationDate;
            $this->expirationDate = $expirationDate;
            $this->requirements = $requirements;
            $this->workload = $workload;
            $this->careerId = $careerId;
            $this->jobPositionId = $jobPositionId;
            $this->companyId = $companyId;
            $this->active = $active;
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
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of publicationDate
         */ 
        public function getPublicationDate()
        {
                return $this->publicationDate;
        }

        /**
         * Set the value of publicationDate
         *
         * @return  self
         */ 
        public function setPublicationDate($publicationDate)
        {
                $this->publicationDate = $publicationDate;

                return $this;
        }

        /**
         * Get the value of expirationDate
         */ 
        public function getExpirationDate()
        {
                return $this->expirationDate;
        }

        /**
         * Set the value of expirationDate
         *
         * @return  self
         */ 
        public function setExpirationDate($expirationDate)
        {
                $this->expirationDate = $expirationDate;

                return $this;
        }

        /**
         * Get the value of requirements
         */ 
        public function getRequirements()
        {
                return $this->requirements;
        }

        /**
         * Set the value of requirements
         *
         * @return  self
         */ 
        public function setRequirements($requirements)
        {
                $this->requirements = $requirements;

                return $this;
        }

        /**
         * Get the value of workload
         */ 
        public function getWorkload()
        {
                return $this->workload;
        }

        /**
         * Set the value of workload
         *
         * @return  self
         */ 
        public function setWorkload($workload)
        {
                $this->workload = $workload;

                return $this;
        }

        /**
         * Get the value of jobPositionId
         */ 
        public function getJobPositionId()
        {
                return $this->jobPositionId;
        }

        /**
         * Set the value of jobPositionId
         *
         * @return  self
         */ 
        public function setJobPositionId($jobPositionId)
        {
                $this->jobPositionId = $jobPositionId;

                return $this;
        }

        /**
         * Get the value of companyId
         */ 
        public function getCompanyId()
        {
                return $this->companyId;
        }

        /**
         * Set the value of companyId
         *
         * @return  self
         */ 
        public function setCompanyId($companyId)
        {
                $this->companyId = $companyId;

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
    }
?>
