<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Employer/ShowEmployerHomeView">
        <span class="navbar-text">
            <strong>Employer</strong>
        </span>
    </a>
    
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowAddJobOfferView">Add Job Offer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferListView/<?= $_SESSION['employer']->getCompanyId() ?>">Job Offer List</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAddCompanyView">Add Comany</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Log Out</a>
        </li>
    </ul>
</nav>