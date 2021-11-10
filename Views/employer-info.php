<?php
    require_once('employer-nav.php');

    $employer = $_SESSION["employer"];
    $company = $_SESSION["company"];
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Your Employer Information</h2>
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center white-box">
                        <div class="col-lg-6 ">
                            <div class="row">
                                <span class="col-lg-6">First Name:</span>
                                <span class="col-lg-6"><?= $employer->getFirstName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Last Name:</span>
                                <span class="col-lg-6"><?= $employer->getLastName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">DNI:</span>
                                <span class="col-lg-6"><?= $employer->getDni() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Email:</span>
                                <span class="col-lg-6"><?= $employer->getEmail() ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <span class="col-lg-6">Fantasy Name:</span>
                                <span class="col-lg-6"><?= $company->getFantasyName() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Cuil:</span>
                                <span class="col-lg-6"><?= $company->getCuil() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Phone Number:</span>
                                <span class="col-lg-6"><?= $company->getPhoneNumber() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Country:</span>
                                <span class="col-lg-6"><?= $company->getCountry() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Province:</span>
                                <span class="col-lg-6"><?= $company->getProvince() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">City:</span>
                                <span class="col-lg-6"><?= $company->getCity() ?></span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">Direction:</span>
                                <span class="col-lg-6"><?= $company->getDirection() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section>
</main>