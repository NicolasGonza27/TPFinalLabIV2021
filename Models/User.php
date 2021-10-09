<?php
    namespace Models;

    abstract class User
    {
        protected $firstName;
        protected $lastName;
        protected $dni;
        protected $email;
        protected $active;
        protected $tipeUser;

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        /**
         * Get the value of dni
         */ 
        public function getDni()
        {
            return $this->dni;
        }

        /**
         * Set the value of dni
         *
         * @return  self
         */ 
        public function setDni($dni)
        {
            $this->dni = $dni;

            return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $email;

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
         * Get the value of tipeUser
         */ 
        public function getTipeUser()
        {
                return $this->tipeUser;
        }

        /**
         * Set the value of tipeUser
         *
         * @return  self
         */ 
        public function setTipeUser($tipeUser)
        {
                $this->tipeUser = $tipeUser;

                return $this;
        }
    }
?>