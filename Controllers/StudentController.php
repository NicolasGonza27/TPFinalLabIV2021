<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use API\ApiStudentDAO as ApiStudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;
        private $apiStudentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->apiStudentDAO = new ApiStudentDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowStudentHomeView()
        {
            require_once(VIEWS_PATH."student-info.php");
        }

        public function ShowStudentSignInView()
        {
            require_once(VIEWS_PATH."student-signIn.php");
        }

        public function checkStudentEmail($email) {
            $student = $this->apiStudentDAO->GetOneByEmail($email);
            if (!$student) {
                $student = $this->studentDAO->GetOneByEmail($email);
            }
            

            if (!$student) {
                require_once(VIEWS_PATH."home.php");
            }
            else {
                $_SESSION["student"] = $student;
                require_once(VIEWS_PATH."student-info.php");
            }
        }

        public function Add($firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber)
        {
            $student = new Student(rand(100000,99999), 0, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, true);
            $error = 0;
            if ($this->studentDAO->GetOneByEmail($email) || $this->apiStudentDAO->GetOneByEmail($email)) {
                $error = 1;
            }
            if ($this->studentDAO->GetOneByDni($dni) || $this->apiStudentDAO->GetOneByDni($dni)) {
                $error = 1;
            }

            if ($error == 0) {
                $this->studentDAO->Add($student);

                $_SESSION["student"] = $student;
                require_once(VIEWS_PATH."student-info.php");
            }
            else {
                require_once(VIEWS_PATH."student-signIn.php");
            }

            
        }
    }
?>