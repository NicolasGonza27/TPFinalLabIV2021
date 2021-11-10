<?php
    namespace Models;

    use Models\User as User;

    class Employer extends User
    {
        private $employerId;
        private $companyId;
        // private $firstName;
        // private $lastName;
        // private $dni;
        // private $email;
        // private $active;

        public function __construct($employerId = null, $companyId = null, $firstName = null, $lastName = null, $dni = null, $email = null, $active = null)
        {
            $this->employerId = $employerId;
            $this->companyId = $companyId;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->dni = $dni;
            $this->email = $email;
            $this->active = $active;
            $this->tipeUser = TIPE_EMPLOYER;
        }


        /**
         * Get the value of employerId
         */ 
        public function getEmployerId()
        {
                return $this->employerId;
        }

        /**
         * Set the value of employerId
         *
         * @return  self
         */ 
        public function setEmployerId($employerId)
        {
                $this->employerId = $employerId;

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
    }
?>

