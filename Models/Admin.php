<?php
    namespace Models;

    use Models\User as User;

    class Admin extends User
    {
        private $password;
        // private $firstName;
        // private $lastName;
        // private $dni;
        // private $email;
        // private $active;

        public function __construct($password = null, $firstName = null, $lastName = null, $dni = null, $email = null, $active = null)
        {
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->dni = $dni;
            $this->email = $email;
            $this->active = $active;
            $this->tipeUser = TIPE_ADMIN;
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
    }
?>

