<?php
    namespace Controllers;

    use Models\Admin as Admin;

    class AdminController
    {
        private $admin;

        public function __construct()
        {
            $this->admin = new Admin("1", "123", "Admin", "Istrador", "12345678", "admin@gmail.com", true);
        }

        public function ShowAdminHomeView($valid = 0) {
            if ($valid = 1) {
                $admin = $this->admin;
            }
            
            require_once(VIEWS_PATH."admin-home.php");
        }

        public function checkAdminLogin($email, $password) {

            if ($email == $this->admin->getEmail() && $password == $this->admin->getPassword()) {
                $admin = $this->admin;
                require_once(VIEWS_PATH."admin-home.php");
            }
            else {
                require_once(VIEWS_PATH."home.php");
            }
        }

        public function Add($recordId, $firstName, $lastName)
        {
            // $student = new Student();
            // $student->setRecordId($recordId);
            // $student->setfirstName($firstName);
            // $student->setLastName($lastName);

            // $this->studentDAO->Add($student);

            // $this->ShowAddView();
        }
    }
?>