<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }
        
        public function Logout($message = "")
        {
            session_unset();

            require_once(VIEWS_PATH."home.php");
        }
    }
?>