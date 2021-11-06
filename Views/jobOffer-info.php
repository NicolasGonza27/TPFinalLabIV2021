<?php
    if (isset($_SESSION["student"])) {
        require_once('student-nav.php');
    }
    else {
        require_once('admin-nav.php');
    }
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">The Job Offer Information</h2>
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 white-box">
                            <div class="row">
                                <span class="col-lg-6">Description:</span>
                                <span class="col-lg-6"><?= $jobOffer->getDescription() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Publication Date:</span>
                                <span class="col-lg-6"><?= $jobOffer->getPublicationDate() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Expiration Date:</span>
                                <span class="col-lg-6"><?= $jobOffer->getExpirationDate() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Requirements:</span>
                                <span class="col-lg-6"><?= $jobOffer->getRequirements() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Workload:</span>
                                <span class="col-lg-6"><?= $jobOffer->getWorkload() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Job Position:</span>
                                <span class="col-lg-6"><?= $jobPosition->getDescription() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Career:</span>
                                <span class="col-lg-6"><?= $career->getDescription() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Company:</span>
                                <span class="col-lg-6"><?= $company->getFantasyName() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- ACA VA LO BUENOOOOOO   -->
        </div>
    </section>
</main>