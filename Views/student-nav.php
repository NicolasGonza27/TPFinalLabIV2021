<?php

     use Models\Student as Student;

     $student = $_SESSION["student"];
?>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <a class="nav-link" href="<?= FRONT_ROOT ?>Student/ShowStudentHomeView">
          <span class="navbar-text">
               <strong>Student</strong>
          </span>
     </a>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Postulation/ShowPostulationListStudentView/<?= $student->getStudentId() ?>">My Postulations</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferListStudentView">Job Offer List</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowCompanyListStudentView">Companyes List</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Log Out</a>
          </li>     
     </ul>
</nav>