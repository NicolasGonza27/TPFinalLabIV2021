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

        public function checkStudentEmail($email) {
            $student = $this->apiStudentDAO->GetOneByEmail($email);

            if (!$student) {
                require_once(VIEWS_PATH."home.php");
            }
            else {
                require_once(VIEWS_PATH."student-info.php");
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