<?php
    namespace Models;

    class Company
    {
        private $companyId;
        private $fantasyName;
        private $cuil;
        private $phoneNumber;
        private $country;
        private $province;
        private $city;
        private $direction;
        private $active;

        public function __construct($companyId = null, $fantasyName = null, $cuil = null, $phoneNumber = null, $country = null, $province = null, $city = null, $direction = null, $active = null)
        {
            $this->companyId = $companyId;
            $this->fantasyName = $fantasyName;
            $this->cuil = $cuil;
            $this->phoneNumber = $phoneNumber;
            $this->country = $country;
            $this->province = $province;
            $this->city = $city;
            $this->direction = $direction;
            $this->active = $active;
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
         * Get the value of fantasyName
         */ 
        public function getFantasyName()
        {
                return $this->fantasyName;
        }

        /**
         * Set the value of fantasyName
         *
         * @return  self
         */ 
        public function setFantasyName($fantasyName)
        {
                $this->fantasyName = $fantasyName;

                return $this;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
                $this->country = $country;

                return $this;
        }

        /**
         * Get the value of province
         */ 
        public function getProvince()
        {
                return $this->province;
        }

        /**
         * Set the value of province
         *
         * @return  self
         */ 
        public function setProvince($province)
        {
                $this->province = $province;

                return $this;
        }

        /**
         * Get the value of city
         */ 
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Set the value of city
         *
         * @return  self
         */ 
        public function setCity($city)
        {
                $this->city = $city;

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
         * Get the value of cuil
         */ 
        public function getCuil()
        {
                return $this->cuil;
        }

        /**
         * Set the value of cuil
         *
         * @return  self
         */ 
        public function setCuil($cuil)
        {
                $this->cuil = $cuil;

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

        /**
         * Get the value of direction
         */ 
        public function getDirection()
        {
                return $this->direction;
        }

        /**
         * Set the value of direction
         *
         * @return  self
         */ 
        public function setDirection($direction)
        {
                $this->direction = $direction;

                return $this;
        }
    }
?>